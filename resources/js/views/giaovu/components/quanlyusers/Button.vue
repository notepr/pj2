<template>
    <div>
        <router-link
            class="btn btn-info"
            :class="{disabled:isList}"
            to="/quan_ly_user/danh_sach_nguoi_dung"
        >Danh sách người dùng</router-link>
        <router-link
            class="btn btn-info"
            :class="{disabled:isModi}"
            to="/quan_ly_user/update_thong_tin_user"
        >Tùy chỉnh thông tin người dùng</router-link>
    </div>
</template>
<script>
export default {
    mounted() {
        if (this.$route.path.includes("/danh_sach_nguoi_dung")) {
            this.reset_btn_class();
            this.isList = true;
        } else if (this.$route.path.includes("/update_thong_tin_user")) {
            this.reset_btn_class();
            this.isModi = true;
        } else {
            this.reset_btn_class();
        }
    },
    data() {
        return {
            isList: false,
            isModi: false,
        };
    },
    watch: {
        $route(to, from) {
            if (to.path.includes("/danh_sach_nguoi_dung")) {
                this.reset_btn_class();
                this.isList = true;
            } else if (to.path.includes("/update_thong_tin_user")) {
                this.reset_btn_class();
                this.isModi = true;
            } else {
                this.reset_btn_class();
            }
        },
    },
    methods: {
        reset_btn_class() {
            this.isList = false;
            this.isModi = false;
        },
    },
};
</script>
<style lang="css" scoped>
</style>
