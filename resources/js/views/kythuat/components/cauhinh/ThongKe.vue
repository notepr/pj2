<template>
    <div class="main-info-container row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">content_copy</i>
                    </div>
                    <p class="card-category font-weight-bold">Tổng số cấu hình</p>
                    <h3 class="card-title">{{sum_cau_hinh}}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">content_copy</i>
                    </div>
                    <p class="card-category font-weight-bold">Cấu hình đã có môn học</p>
                    <h3 class="card-title">{{cau_hinh_da_co_mon}}</h3>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    created() {
        this.$store.dispatch("cau_hinh/get_cau_hinh");
        this.$store.dispatch("cau_hinh/get_cau_hinh_mon");
    },
    computed: {
        sum_cau_hinh() {
            return this.$store.state.cau_hinh.sum_cau_hinh;
        },
        cau_hinh_da_co_mon() {
            return this.$store.state.cau_hinh.cau_hinh_da_co_mon;
        },
    },
    data() {
        return {};
    },
};
</script>
<style lang="css" scoped>
</style>
