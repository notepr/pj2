<template>
    <div>
        <form @submit="add_ngay_nghi">
            <label>Giáo viên</label>
            <multiselect
                v-model="user"
                :options="arr_user"
                :close-on-select="true"
                :show-labels="true"
                placeholder="Chọn giáo viên (để trống nếu là lịch nghỉ chung)"
                deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
                selectLabel="Click hoặc nhấn Enter để chọn"
                :searchable="true"
                :custom-label="userLabel"
                :multiple="true"
                :taggable="true"
                track-by="ma_nguoi_dung"
            ></multiselect>
            <br />
            <br />
            <div class="form-group">
                <label>Ngày nghỉ</label>
                <v-date-picker
                    :min-date="new Date()"
                    v-model="ngay_nghi"
                    :input-props="{placeholder: 'Chọn ngày nghỉ', class: 'form-control'}"
                />
            </div>
            <br />
            <label>Ca nghỉ</label>
            <multiselect
                v-model="ca"
                :options="arr_ca"
                :close-on-select="true"
                :show-labels="true"
                placeholder="Chọn ca"
                deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
                selectLabel="Click hoặc nhấn Enter để chọn"
                :searchable="true"
                :custom-label="caLabel"
                :multiple="true"
                :taggable="true"
                track-by="ma_ca"
                @input="filter_select"
            ></multiselect>
            <br />
            <br />
            <div class="form-group">
                <label for="insertNote">Ghi chú</label>
                <input
                    class="form-control"
                    id="insertNote"
                    placeholder="Nhập ghi chú (có thể để trống)"
                    v-model="ghi_chu"
                />
                <span v-if="err_note" class="text-danger">{{err_note}}</span>
            </div>
            <br />
            <button class="btn btn-info">Thêm</button>
        </form>
    </div>
</template>

<script>
export default {
    created() {
        this.$store.dispatch("user/get_all_user");
        this.$store.dispatch("ca/get_ca");
        this.$store.commit("ngay_nghi/refresh_err");
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
    },
    computed: {
        arr_user() {
            return this.$store.state.user.arr_user;
        },
        arr_ca() {
            return this.$store.state.ca.arr_ca;
        },
        err_note() {
            return this.$store.state.ngay_nghi.err_note;
        },
        reset_form() {
            return this.$store.state.ngay_nghi.reset_form;
        },
    },
    data() {
        return {
            ngay_nghi: "",
            user: "",
            ca: "",
            ghi_chu: "",
        };
    },
    methods: {
        filter_select(val) {
            if (val.length != 0) {
                if (val[0].ma_ca == 1 && val.length == 1) {
                    this.ca = val[0];
                } else if (val[0].ma_ca == 1 && val.length > 1) {
                    this.ca = val[1];
                } else if (val[val.length - 1].ma_ca == 1) {
                    this.ca = val[val.length - 1];
                } else if (
                    val[0].ma_ca == 4 &&
                    val.length > 1 &&
                    (val[1].ma_ca == 2 || val[1].ma_ca == 3)
                ) {
                    this.ca = val[1];
                } else if (
                    val[val.length - 1].ma_ca == 4 &&
                    (val[0].ma_ca == 2 || val[0].ma_ca == 3)
                ) {
                    this.ca = val[val.length - 1];
                } else if (
                    val[0].ma_ca == 7 &&
                    val.length > 1 &&
                    (val[1].ma_ca == 2 || val[1].ma_ca == 3)
                ) {
                    this.ca = val[1];
                } else if (
                    val[val.length - 1].ma_ca == 7 &&
                    (val[0].ma_ca == 5 || val[0].ma_ca == 6)
                ) {
                    this.ca = val[val.length - 1];
                }
            }
        },
        userLabel({ ho_ten, email }) {
            return `${ho_ten} - ${email}`;
        },
        caLabel({ ma_ca, gio_bat_dau, gio_ket_thuc }) {
            if (ma_ca == 1) {
                return "Cả ngày";
            } else if (ma_ca == 4) {
                return "Sáng";
            } else if (ma_ca == 7) {
                return "Chiều";
            }
            return `Ca ${ma_ca} - ${gio_bat_dau} - ${gio_ket_thuc}`;
        },
        add_ngay_nghi(e) {
            e.preventDefault();
            var user_input = {
                ngay: this.ngay_nghi
                    ? this.ngay_nghi.getDate() +
                      "-" +
                      (this.ngay_nghi.getMonth() + 1) +
                      "-" +
                      this.ngay_nghi.getFullYear()
                    : "",
                ma_giao_vien: this.user
                    ? this.user.map((each) => {
                          return each.ma_nguoi_dung;
                      })
                    : [0],
                ma_ca: Array.isArray(this.ca)
                    ? this.ca.map((each) => {
                          return each.ma_ca;
                      })
                    : this.ca
                    ? [this.ca.ma_ca]
                    : "",
            };
            if (this.ghi_chu) {
                user_input.ghi_chu = this.ghi_chu;
            }
            this.$store.dispatch("ngay_nghi/add_ngay_nghi", user_input).then(
                setTimeout(() => {
                    this.$router.push("/quan_ly_lich_lam_viec/xem_lich_nghi");
                }, 500)
            );
        },
    },
    watch: {
        reset_form() {
            if (this.reset_form) {
                this.ngay_nghi = "";
                this.user = "";
                this.ca = "";
                this.ghi_chu = "";
            }
        },
    },
};
</script>

<style>
</style>

