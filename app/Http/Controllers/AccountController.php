<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('account.user-account');
    }

    public function becomeEmployerView()
    {
        return view('account.become-employer');
    }



    public function uploadCV(Request $request)
    {
        $user = User::find(auth()->user()->id);

        // Memeriksa apakah cv valid
        try {
            $validatedData = $request->validate([
                'cv' => 'required|mimes:pdf,docx|max:2048',
            ], [
                'cv.required' => 'File CV harus diunggah.',
                'cv.mimes' => 'Format file CV harus PDF atau DOCX.',
                'cv.max' => 'Ukuran file CV maksimal 2048 KB (2MB).',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $errorMessages = $exception->validator->getMessageBag()->all();
            $errorMessage = implode(' ', $errorMessages);
            Alert::toast($errorMessage, 'warning');
            return redirect()->back();
        }

        // Menghapus CV sebelumnya jika ada
        if ($user->cv) {
            Storage::disk('public')->delete($user->cv);
        }

        // Simpan file CV ke folder storage/app/public/cv
        $cvFile = $request->file('cv');
        $cvPath = $cvFile->store('cv', 'public');

        // Simpan URL CV di kolom 'cv' pada tabel 'users'
        $user->cv = 'storage/' . $cvPath;
        $user->save();

        // Memberikan informasi bahwa CV berhasil diunggah
        Alert::toast('CV berhasil diunggah!', 'success');
        return redirect()->route('account.index');
    }
    public function becomeEmployer()
    {
        $user = User::find(auth()->user()->id);
        $user->removeRole('user');
        $user->assignRole('author');
        return redirect()->route('account.authorSection');
    }

    public function applyJobView(Request $request)
    {
        if ($this->hasApplied(auth()->user(), $request->post_id)) {
            Alert::toast('Anda telah melamar pekerjaan ini sebelumnya!', 'success');
            return redirect()->route('post.show', ['job' => $request->post_id]);
        } else if (!auth()->user()->hasRole('user')) {
            Alert::toast('Anda adalah pengusaha! Anda tidak dapat melamar pekerjaan!', 'error');
            return redirect()->route('post.show', ['job' => $request->post_id]);
        }

        $post = Post::find($request->post_id);
        $company = $post->company()->first();
        return view('account.apply-job', compact('post', 'company'));
    }

    public function applyJob(Request $request)
    {
        $application = new JobApplication;
        $user = User::find(auth()->user()->id);

        if ($this->hasApplied($user, $request->post_id)) {
            Alert::toast('Anda telah melamar pekerjaan ini sebelumnya!', 'success');
            return redirect()->route('post.show', ['job' => $request->post_id]);
        }

        if (!$user->cv) {
            Alert::toast('Anda harus mengunggah CV sebelum melamar!', 'warning');
            return redirect()->route('account.index');
        }

        $application->user_id = auth()->user()->id;
        $application->post_id = $request->post_id;
        $application->save();

        Alert::toast('Terima kasih telah melamar! Tunggu tanggapan perusahaan!', 'success');
        return redirect()->route('post.show', ['job' => $request->post_id]);
    }





    public function changePasswordView()
    {
        return view('account.change-password');
    }

    public function changePassword(Request $request)
    {
        if (!auth()->user()) {
            Alert::toast('Tidak terautentikasi!', 'success');
            return redirect()->back();
        }

        // Memeriksa apakah password valid
        $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8'
        ]);

        $authUser = auth()->user();
        $currentP = $request->current_password;
        $newP = $request->new_password;
        $confirmP = $request->confirm_password;

        if (Hash::check($currentP, $authUser->password)) {
            if (Str::of($newP)->exactly($confirmP)) {
                $user = User::find($authUser->id);
                $user->password = Hash::make($newP);
                if ($user->save()) {
                    Alert::toast('Password berhasil diubah!', 'success');
                    return redirect()->route('account.index');
                } else {
                    Alert::toast('Ada kesalahan!', 'warning');
                }
            } else {
                Alert::toast('Password tidak cocok!', 'info');
            }
        } else {
            Alert::toast('Password salah!', 'info');
        }
        return redirect()->back();
    }

    public function deactivateView()
    {
        return view('account.deactivate');
    }

    public function deleteAccount()
    {
        $user = User::find(auth()->user()->id);
        Auth::logout($user->id);
        if ($user->delete()) {
            Alert::toast('Akun Anda berhasil dihapus!', 'info');
            return redirect(route('post.index'));
        } else {
            return view('account.deactivate');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function hasApplied($user, $postId)
    {
        $applied = $user->applied()->where('post_id', $postId)->get();
        if ($applied->count()) {
            return true;
        } else {
            return false;
        }
    }
}
