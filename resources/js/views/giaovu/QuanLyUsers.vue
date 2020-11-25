<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <dirButton></dirButton>
                        <br />
                        <thongKe></thongKe>
                        <br />
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import dirButton from "./components/quanlyusers/Button.vue";
import thongKe from "./components/quanlyusers/ThongKe.vue";

export default {
    mounted() {
        if (this.$route.path == "/quan_ly_user") {
            this.$store.commit("content/page_title", "Quản lý người dùng");
        }
    },
    watch: {
        $route(to, from) {
            this.$store.commit("content/page_title", "Quản lý người dùng");
        },
    },
    components: {
        thongKe,
        dirButton,
    },
};
</script>
<style lang="css" scoped>
</style>
