<template>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-warning">
                <div class="card-icon">
                    <i class="material-icons">error</i>
                </div>
            </div>
            <div class="card-body">
                <h4 class="card-title"><b>Không thể xác định yêu cầu của bạn</b></h4>
                nhấn vào <router-link :to="{name: 'home'}">đây</router-link> để trở về trang chủ hoặc thực hiện yêu cầu hợp lệ.
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        this.$store.commit('content/page_title', '');
    },
    data() {
        return {

        }
    }
}

</script>
<style lang="css" scoped>
</style>
