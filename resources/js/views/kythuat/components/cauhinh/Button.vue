<template>
    <div>
        <router-link
            to="/quan_ly_cau_hinh/danh_sach_cau_hinh"
            class="btn btn-info"
            :class="{disabled:isListCh}"
        >Danh sách cấu hình</router-link>
        <router-link
            to="/quan_ly_cau_hinh/them_cau_hinh"
            class="btn btn-info"
            :class="{disabled:isAddCh}"
        >Thêm cấu hình</router-link>
        <router-link
            to="/quan_ly_cau_hinh/update_cau_hinh"
            class="btn btn-info"
            :class="{disabled:isModiCh}"
        >Tùy chỉnh cấu hình</router-link>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isListCh: false,
            isAddCh: false,
            isModiCh: false,
        };
    },
    mounted() {
        if (this.$route.path.includes("/danh_sach_cau_hinh")) {
            this.reset_btn_class();
            this.isListCh = true;
        } else if (this.$route.path.includes("/them_cau_hinh")) {
            this.reset_btn_class();
            this.isAddCh = true;
        } else if (this.$route.path.includes("/update_cau_hinh")) {
            this.reset_btn_class();
            this.isModiCh = true;
        } else {
            this.reset_btn_class();
        }
    },
    watch: {
        $route(to, from) {
            if (to.path.includes("/danh_sach_cau_hinh")) {
                this.reset_btn_class();
                this.isListCh = true;
            } else if (to.path.includes("/them_cau_hinh")) {
                this.reset_btn_class();
                this.isAddCh = true;
            } else if (to.path.includes("/update_cau_hinh")) {
                this.reset_btn_class();
                this.isModiCh = true;
            } else {
                this.reset_btn_class();
            }
        },
    },
    methods: {
        reset_btn_class() {
            this.isListCh = false;
            this.isAddCh = false;
            this.isModiCh = false;
        },
    },
};
</script>
<style lang="css" scoped>
</style>
