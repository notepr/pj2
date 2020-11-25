<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- button -->
                        <dirButton></dirButton>
                        <br />
                        <!-- <thongKe></thongKe> -->
                        <!-- <br /> -->
                        <!-- main view -->
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import dirButton from "./components/lab/Button.vue";
import thongKe from "./components/lab/ThongKe.vue";

export default {
    mounted() {
        if (this.$route.path == "/quan_ly_lab") {
            this.$store.commit("content/page_title", "Quản lý phòng lab");
        }
    },
    data() {
        return {};
    },
    watch: {
        $route(to, from) {
            this.$store.commit("content/page_title", "Quản lý phòng lab");
        },
    },
    components: {
        dirButton,
        thongKe,
    },
};
</script>
<style scoped>
</style>
