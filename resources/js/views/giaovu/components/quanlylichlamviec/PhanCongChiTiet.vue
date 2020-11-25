<template>
    <div>
        <selectPhanCongChiTiet @emit_data="pass_data" @show_loading="show_loading"></selectPhanCongChiTiet>
        <br />
        <span class="text-danger" v-if="err_de_xuat">{{err_de_xuat}}</span>
        <span v-if="!err_de_xuat && loading">Đang tải...</span>
        <tableDeXuatPhanCongChiTiet
            v-if="table_phan_cong_ct"
            :ma_phan_cong="ma_phan_cong"
            :so_gio="so_gio"
            :arr_de_xuat_phan_cong_ct="arr_de_xuat_phan_cong_ct"
        ></tableDeXuatPhanCongChiTiet>
    </div>
</template>

<script>
import selectPhanCongChiTiet from "./select/SelectPhanCongChiTiet";
import tableDeXuatPhanCongChiTiet from "./table/TableDeXuatPhanCongChiTiet";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Phân công chi tiết");
    },
    data() {
        return {
            table_phan_cong_ct: false,
            loading: false,
            ma_phan_cong: "",
            so_gio: "",
        };
    },
    computed: {
        err_de_xuat() {
            return this.$store.state.phan_cong.err_de_xuat;
        },
        arr_de_xuat_phan_cong_ct() {
            return this.$store.state.phan_cong.arr_de_xuat_phan_cong_ct;
        },
    },
    methods: {
        pass_data(ma_phan_cong, so_gio) {
            this.ma_phan_cong = ma_phan_cong;
            this.so_gio = so_gio;
        },
        show_loading(show) {
            if (show == 1) {
                this.loading = true;
            } else {
                this.loading = false;
            }
        },
    },
    watch: {
        arr_de_xuat_phan_cong_ct() {
            if (this.arr_de_xuat_phan_cong_ct.length != 0) {
                this.loading = false;
                this.table_phan_cong_ct = true;
            } else {
                this.table_phan_cong_ct = false;
            }
        },
    },
    components: {
        tableDeXuatPhanCongChiTiet,
        selectPhanCongChiTiet,
    },
};
</script>

<style>
</style>