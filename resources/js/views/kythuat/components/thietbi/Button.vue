<template>
    <div>
        <router-link
            to="/quan_ly_thiet_bi/danh_sach_thiet_bi"
            class="btn btn-info"
            :class="{disabled:isListTools}"
        >Danh sách thiết bị</router-link>
        <router-link
            to="/quan_ly_thiet_bi/them_thiet_bi"
            class="btn btn-info"
            :class="{disabled:isthemTools}"
        >Thêm thiết bị</router-link>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isListTools: false,
            isthemTools: false,
        };
    },
    mounted() {
        if (this.$route.path == "/quan_ly_thiet_bi/danh_sach_thiet_bi") {
            this.isListTools = true;
            this.isthemTools = false;
        } else if (this.$route.path == "/quan_ly_thiet_bi/them_thiet_bi") {
            this.isthemTools = true;
            this.isListTools = false;
        } else {
            this.isListTools = false;
            this.isthemTools = false;
        }
    },
    watch: {
        $route(to, from) {
            if (to.path == "/quan_ly_thiet_bi/danh_sach_thiet_bi") {
                this.isListTools = true;
                this.isthemTools = false;
            } else if (to.path == "/quan_ly_thiet_bi/them_thiet_bi") {
                this.isthemTools = true;
                this.isListTools = false;
            } else {
                this.isListTools = false;
                this.isthemTools = false;
            }
        },
    },
};
</script>
<style lang="css" scoped>
</style>
