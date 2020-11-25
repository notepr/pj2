<template>
    <div>
        <router-link
            to="/quan_ly_lich_lam_viec/xem_lich_nghi"
            class="btn btn-info"
            :class="{disabled:isListDayOff}"
        >Xem lịch nghỉ</router-link>
        <router-link
            to="/quan_ly_lich_lam_viec/them_lich_nghi"
            class="btn btn-info"
            :class="{disabled:isDayOff}"
        >Thêm lịch nghỉ</router-link>
        <router-link
            to="/quan_ly_lich_lam_viec/xem_lich_bo_sung"
            class="btn btn-info"
            :class="{disabled:isXemBoSung}"
        >Xem lịch dạy bổ sung</router-link>
        <router-link
            to="/quan_ly_lich_lam_viec/them_lich_day"
            class="btn btn-info"
            :class="{disabled:isAddWork}"
        >Thêm lịch dạy</router-link>
        <router-link
            to="/quan_ly_lich_lam_viec/xem_phan_cong_chi_tiet"
            class="btn btn-info"
            :class="{disabled: isListPcong}"
        >Xem phân công chi tiết</router-link>
        <router-link
            to="/quan_ly_lich_lam_viec/phan_cong_chi_tiet"
            class="btn btn-info"
            :class="{disabled:isPcong}"
        >Phân công chi tiết</router-link>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isDayOff: false,
            isAddWork: false,
            isPcong: false,
            isListPcong: false,
            isListDayOff: false,
            isXemBoSung: false,
        };
    },
    mounted() {
        if (this.$route.path.includes("them_lich_nghi")) {
            this.reset_btn_class();
            this.isDayOff = true;
        } else if (this.$route.path.includes("them_lich_day")) {
            this.reset_btn_class();
            this.isAddWork = true;
        } else if (this.$route.path.includes("xem_phan_cong_chi_tiet")) {
            this.reset_btn_class();
            this.isListPcong = true;
        } else if (this.$route.path.includes("phan_cong_chi_tiet")) {
            this.reset_btn_class();
            this.isPcong = true;
        } else if (this.$route.path.includes("xem_lich_nghi")) {
            this.reset_btn_class();
            this.isListDayOff = true;
        } else if (this.$route.path.includes("xem_lich_bo_sung")) {
            this.reset_btn_class();
            this.isXemBoSung = true;
        } else {
            this.reset_btn_class();
        }
    },
    watch: {
        $route(to, from) {
            if (to.path.includes("them_lich_nghi")) {
                this.reset_btn_class();
                this.isDayOff = true;
            } else if (to.path.includes("them_lich_day")) {
                this.reset_btn_class();
                this.isAddWork = true;
            } else if (to.path.includes("xem_phan_cong_chi_tiet")) {
                this.reset_btn_class();
                this.isListPcong = true;
            } else if (to.path.includes("phan_cong_chi_tiet")) {
                this.reset_btn_class();
                this.isPcong = true;
            } else if (to.path.includes("xem_lich_nghi")) {
                this.reset_btn_class();
                this.isListDayOff = true;
            } else if (this.$route.path.includes("xem_lich_bo_sung")) {
                this.reset_btn_class();
                this.isXemBoSung = true;
            } else {
                this.reset_btn_class();
            }
        },
    },
    methods: {
        reset_btn_class() {
            this.isListDayOff = false;
            this.isAddWork = false;
            this.isDayOff = false;
            this.isListPcong = false;
            this.isPcong = false;
            this.isXemBoSung = false;
        },
    },
};
</script>
<style lang="css" scoped>
</style>
