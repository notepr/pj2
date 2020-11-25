<template>
    <form @submit="get_de_xuat">
        <label>Chọn giáo viên</label>
        <multiselect
            v-model="giao_vien"
            :options="arr_gv"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn giáo viên"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="true"
            :custom-label="labelUser"
        ></multiselect>
        <br />
        <label>Chọn phân công</label>
        <multiselect
            v-model="phan_cong"
            :options="arr_phan_cong"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn phân công"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="true"
            :custom-label="classLabel"
        >
            <template
                slot="noOptions"
            >Chưa chọn giáo viên hoặc giáo viên đã chọn chưa được phân công</template>
        </multiselect>
        <br />
        <label>Số giờ dạy</label>
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
        <br />
        <br />
        <div class="form-group">
            <label for="insertRange">Số ngày</label>
            <input
                type="number"
                class="form-control"
                id="insertRange"
                v-model="ngay"
                placeholder="Nhập khoảng thời gian muốn thêm lịch (tính từ ngày hôm nay)"
            />
        </div>
        <br />
        <button class="btn btn-info">Xác nhận</button>
        <p class="font-weight-bold" v-if="loading">Đang tải</p>
    </form>
</template>
<script>
export default {
    created() {
        this.$store.dispatch("user/get_all_user");
    },
    mounted() {
        // change label color
        $(".form-group").addClass("bmd-form-group");
        $("label").addClass("bmd-label-static");
        $(".form-group").on("click", function () {
            $(".form-group").removeClass("is-focused");
            $(this).addClass("is-focused");
        });

        // remove color while move out input
        $("input").blur(function () {
            $(".form-group").removeClass("is-focused");
        });

        this.so_gio = this.arr_gio_day[0];
    },
    data() {
        return {
            phan_cong: "",
            giao_vien: "",
            so_gio: "",
            ngay: 7,
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
            loading: false,
        };
    },
    computed: {
        arr_gv() {
            return this.$store.state.user.arr_user.filter((each) => {
                return each.ma_cap_do == 3;
            });
        },
        arr_phan_cong() {
            return this.$store.state.phan_cong.arr_phan_cong.filter((each) => {
                return (
                    each.nguoidung &&
                    each.nguoidung.ma_nguoi_dung == this.giao_vien.ma_nguoi_dung
                );
            });
        },
        reset_form() {
            return this.$store.state.de_xuat.reset_form;
        },
    },
    watch: {
        giao_vien() {
            this.phan_cong = "";
            this.$emit("hide_table");
            if (!this.giao_vien) {
                this.$store.commit("phan_cong/reset_arr_phan_cong");
            } else {
                this.$store.dispatch(
                    "phan_cong/get_phan_cong",
                    this.giao_vien.ma_nguoi_dung
                );
            }
        },
        reset_form() {
            if (this.reset_form) {
                this.phan_cong = "";
                this.giao_vien = "";
                this.so_gio = "";
                this.ngay = "";
            }
        },
    },
    methods: {
        labelUser({ ho_ten, email }) {
            return `${ho_ten} - ${email}`;
        },
        classLabel({ ma_lop, ma_mon_hoc }) {
            return `${ma_lop} - ${ma_mon_hoc}`;
        },
        gioLabel({ title }) {
            return `${title}`;
        },
        get_de_xuat(e) {
            this.$emit("hide_table");
            this.loading = true;
            e.preventDefault();
            var obj = {
                ma_giao_vien: this.giao_vien.ma_nguoi_dung,
                so_gio: this.so_gio.value,
                ma_lop: this.phan_cong.ma_lop,
                so_ngay: this.ngay,
                ma_mon_hoc: this.phan_cong.ma_mon_hoc,
            };
            this.$store.dispatch("de_xuat/get_de_xuat", obj).then(
                setTimeout(() => {
                    this.$emit("show_table");
                    this.loading = false;
                }, 1000)
            );
            this.$emit(
                "data_up",
                this.giao_vien.ma_nguoi_dung,
                this.phan_cong.ma_mon_hoc,
                this.phan_cong.ma_lop
            );
        },
    },
};
</script>
<style lang="css" scoped>
</style>
