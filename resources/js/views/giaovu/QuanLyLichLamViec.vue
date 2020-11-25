<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <dirButton></dirButton>
                        <br />
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import dirButton from "./components/quanlylichlamviec/Button";

export default {
    mounted() {
        if (this.$route.path == "/quan_lich_lam_viec") {
            this.$store.commit("content/page_title", "Quản lý lịch làm việc");
        }
    },
    watch: {
        $route(to, from) {
            this.$store.commit("content/page_title", "Quản lý lịch làm việc");
        },
    },
    components: {
        dirButton,
    },
};
</script>
<style lang="css" scoped>
</style>
