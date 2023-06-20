<?php

namespace App\Http\Controllers;

use App\Events\PostViewEvent;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Post;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(20)->with('company')->get();
        $categories = CompanyCategory::take(5)->get();
        $topEmployers = Company::latest()->take(3)->get();
        return view('home')->with([
            'posts' => $posts,
            'categories' => $categories,
            'topEmployers' => $topEmployers
        ]);
    }

    public function about()
    {

        return view('about')->with([]);
    }

    public function create()
    {
        if (!auth()->user()->company) {
            Alert::toast('Anda harus membuat perusahaan terlebih dahulu!', 'info');
            return redirect()->route('company.create');
        }
        return view('post.create');
    }

    public function store(Request $request)
    {
        $this->requestValidate($request);

        $postData = array_merge(['company_id' => auth()->user()->company->id], $request->all());

        $post = Post::create($postData);
        if ($post) {
            Alert::toast('Post terdaftar!', 'success');
            return redirect()->route('account.authorSection');
        }
        Alert::toast('Gagal menyimpan post!', 'warning');
        return redirect()->back();
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        event(new PostViewEvent($post));
        $company = $post->company()->first();

        $similarPosts = Post::whereHas('company', function ($query) use ($company) {
            return $query->where('company_category_id', $company->company_category_id);
        })->where('id', '<>', $post->id)->with('company')->take(5)->get();
        return view('post.show')->with([
            'post' => $post,
            'company' => $company,
            'similarJobs' => $similarPosts
        ]);
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $post)
    {
        $this->requestValidate($request);
        $getPost = Post::findOrFail($post);

        $newPost = $getPost->update($request->all());
        if ($newPost) {
            Alert::toast('Post berhasil diperbarui!', 'success');
            return redirect()->route('account.authorSection');
        }
        return redirect()->route('post.index');
    }

    public function destroy(Post $post)
    {
        if ($post->delete()) {
            Alert::toast('Post berhasil dihapus!', 'success');
            return redirect()->route('account.authorSection');
        }
        return redirect()->back();
    }

    protected function requestValidate($request)
    {
        return $request->validate([
            'job_title' => 'required|min:3',
            'job_level' => 'required',
            'vacancy_count' => 'required|int',
            'employment_type' => 'required',
            'job_location' => 'required',
            'salary' => 'required',
            'deadline' => 'required',
            'education_level' => 'required',
            'experience' => 'required',
            'skills' => 'required',
            'specifications' => 'sometimes|min:5',
        ]);
    }
}
