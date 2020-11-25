<template>
    <div class="main-info-container row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">content_copy</i>
                    </div>
                    <p class="card-category">Số giáo viên nghỉ trong ngày</p>
                    <h3 class="card-title">{{gv_nghi_trong_ngay}}</h3>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    computed: {
        gv_nghi_trong_ngay() {
            return this.$store.state.ngay_nghi.thong_ke_ngay_nghi;
        },
    },
    data() {
        return {};
    },
};
</script>
<style lang="css" scoped>
</style>
