<template>
    <div class="main-info-container row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">content_copy</i>
                    </div>
                    <p class="card-category font-weight-bold">Tổng só người dùng</p>
                    <h3 class="card-title">{{tong_user}}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">content_copy</i>
                    </div>
                    <p class="card-category font-weight-bold">Kỹ thuật</p>
                    <h3 class="card-title">{{ky_thuat.length}}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">content_copy</i>
                    </div>
                    <p class="card-category font-weight-bold">Giáo viên</p>
                    <h3 class="card-title">{{giao_vien.length}}</h3>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    created() {
        this.$store.dispatch("user/get_all_user");
    },
    computed: {
        tong_user() {
            return this.$store.state.user.arr_user.length;
        },
        ky_thuat() {
            return this.$store.state.user.arr_user.filter(
                (each) => each.ma_cap_do == 2
            );
        },
        giao_vien() {
            return this.$store.state.user.arr_user.filter(
                (each) => each.ma_cap_do == 3
            );
        },
    },
    data() {
        return {};
    },
};
</script>
<style lang="css" scoped>
</style>
