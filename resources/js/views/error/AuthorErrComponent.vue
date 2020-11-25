<template>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-danger">
                <div class="card-icon">
                    <i class="material-icons">error</i>
                </div>
            </div>
            <div class="card-body">
                <h4 class="card-title">
                    <b>Bạn không có quyền truy cập</b>
                </h4>
                nhấn vào <router-link :to="{ name: 'home' }">đây</router-link>để
                trở về trang chủ hoặc thực hiện yêu cầu khác.
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        this.$store.commit("content/page_title", "");
    },
    data() {
        return {};
    }
};
</script>
<style lang="css" scoped></style>
