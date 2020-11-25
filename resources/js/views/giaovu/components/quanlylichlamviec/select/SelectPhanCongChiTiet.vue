<template>
    <div>
        <label>Phân công</label>
        <multiselect
            v-model="phan_cong"
            :options="arr_phan_cong"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn phân công"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="true"
            :custom-label="phanCongLabel"
        ></multiselect>
        <br />
        <label>Số giờ dạy mỗi buổi</label>
        <multiselect
            v-model="so_gio"
            :options="arr_gio_day"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn số giờ dạy"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="false"
            :custom-label="gioLabel"
        ></multiselect>
    </div>
</template>

<script>
export default {
    created() {
        this.$store.commit("phan_cong/reset_err");
        this.$store.dispatch("phan_cong/get_phan_cong");
    },
    data() {
        return {
            phan_cong: "",
            so_gio: "",
            arr_gio_day: [
                {
                    value: 2,
                    title: "2 giờ",
                },
                {
                    value: 4,
                    title: "4 giờ",
                },
            ],
        };
    },
    computed: {
        arr_phan_cong() {
            return this.$store.state.phan_cong.arr_phan_cong;
        },
        select() {
            return this.$store.state.phan_cong.reset_select;
        },
    },
    methods: {
        phanCongLabel({ ho_ten, ma_lop, ma_mon_hoc }) {
            return `${ho_ten} - ${ma_lop} - ${ma_mon_hoc}`;
        },
        gioLabel({ title }) {
            return `${title}`;
        },
    },
    watch: {
        so_gio() {
            this.$store.commit("phan_cong/reset_err");
            if (this.so_gio && this.phan_cong) {
                this.$store
                    .dispatch("phan_cong/get_de_xuat_phan_cong_ct", {
                        ma_phan_cong: this.phan_cong.ma_phan_cong,
                        so_gio: this.so_gio.value,
                    })
                    .then(this.$emit("show_loading", 1))
                    .then(
                        this.$emit(
                            "emit_data",
                            this.phan_cong.ma_phan_cong,
                            this.so_gio.value
                        )
                    );
            } else {
                this.$emit("show_loading", 0);
                this.$store.commit("phan_cong/reset_arr_de_xuat_phan_cong_ct");
            }
        },
        phan_cong() {
            this.$store.commit("phan_cong/reset_err");
            if (this.phan_cong && this.so_gio) {
                this.$store
                    .dispatch("phan_cong/get_de_xuat_phan_cong_ct", {
                        ma_phan_cong: this.phan_cong.ma_phan_cong,
                        so_gio: this.so_gio.value,
                    })
                    .then(this.$emit("show_loading", 1))
                    .then(
                        this.$emit(
                            "emit_data",
                            this.phan_cong.ma_phan_cong,
                            this.so_gio.value
                        )
                    );
            } else {
                this.$emit("show_loading", 0);
                this.$store.commit("phan_cong/reset_arr_de_xuat_phan_cong_ct");
            }
        },
        select() {
            if (this.select == true) {
                this.so_gio = "";
                this.phan_cong = "";
            } else {
                return true;
            }
        },
    },
};
</script>

<style>
</style>