<template>
    <section class="search-bar mt-2 px-0">
        <div class="py-4">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form>
                        <div class="row m-1">
                            <div class="col-md-12 input-group">
                                <input
                                    type="text"
                                    name="q"
                                    class="form-control"
                                    placeholder="Cari Berdasarkan Judul Pekerjaan"
                                    v-model="jobTitle"
                                />
                                <span class="input-group-append">
                                    <button
                                        class="btn btn-success pt-1"
                                        @click="searchByTitle"
                                    >
                                        <span class="icon-search"></span> Cari
                                        Pekerjaan
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div
                    class="col-sm-12 col-md-6 offset-md-3 small text-center my-2"
                >
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <router-link to="/">Semua Pekerjaan</router-link>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <router-link to="/jobs-by-organization"
                                >Berdasarkan Organisasi</router-link
                            >
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <router-link to="/jobs-by-category"
                                >Berdasarkan Kategori Pekerjaan</router-link
                            >
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <router-link to="/jobs-by-title"
                                >Berdasarkan Judul Pekerjaan</router-link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "search-bar",
    data() {
        return {
            jobTitle: null
        };
    },
    mounted() {
        const q = this.getParameterByName("q", window.location.href);
        if (q !== "") {
            this.jobTitle = q;
        }
    },
    methods: {
        searchByTitle() {
            if (this.jobTitle.trim() != "") {
                this.$emit("searchByTitle", this.jobTitle);
            }
        },
        getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return "";
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }
    }
};
</script>

<style scoped>
.search-bar {
    background-color: #f5fdff;
}
</style>
