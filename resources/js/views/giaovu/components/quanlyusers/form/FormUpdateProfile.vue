<template>
    <div>
        <form @submit="process_info_user" id="form_update_profile">
            <div>
                <label>Người dùng</label>
                <multiselect
                    v-model="current_user"
                    :options="arr_user"
                    :close-on-select="true"
                    :show-labels="true"
                    placeholder="Chọn người dùng"
                    deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
                    selectLabel="Click hoặc nhấn Enter để chọn"
                    :searchable="true"
                    :custom-label="userLabel"
                ></multiselect>
            </div>
            <br />
            <br />
            <span v-if="err_validate_global" class="text-danger">
                {{
                err_validate_global
                }}
            </span>
            <div class="form-group">
                <label for="insertEmail">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="insertEmail"
                    placeholder="Nhập email"
                    v-model="current_email"
                />
                <span v-if="err_validate_detail.email" class="text-danger">
                    {{
                    err_validate_detail.email
                    }}
                </span>
            </div>
            <br />
            <div class="form-group">
                <label for="insertAccount">Tài khoản</label>
                <input
                    type="text"
                    class="form-control"
                    id="insertAccount"
                    placeholder="Nhập tài khoản"
                    v-model="current_account"
                />
                <span
                    v-if="err_validate_detail.tai_khoan"
                    class="text-danger"
                >{{ err_validate_detail.tai_khoan }}</span>
            </div>
            <br />
            <div class="form-group">
                <label for="insertSDT">Số điện thoại</label>
                <input
                    type="text"
                    class="form-control"
                    id="insertSDT"
                    placeholder="Nhập số điện thoại"
                    v-model="current_sdt"
                />
                <span v-if="err_validate_detail.sdt" class="text-danger">{{err_validate_detail.sdt}}</span>
            </div>
            <br />
            <div class="form-group">
                <label for="insertPass">Mật khẩu</label>
                <input
                    type="password"
                    class="form-control"
                    id="insertPass"
                    placeholder="Mật khẩu mới"
                    v-model="new_password"
                />
            </div>
            <br />
            <div class="form-group">
                <label for="confirmPass">Nhập lại mật khẩu</label>
                <input
                    type="password"
                    class="form-control"
                    id="confirmPass"
                    placeholder="Nhập lại mật khẩu"
                    v-model="re_password"
                />
                <span
                    v-if="err_repass"
                    class="text-danger"
                >Mật khẩu nhập lại phải trùng với mật khẩu</span>
            </div>
            <br />
            <button class="btn btn-info">Submit</button>
        </form>
    </div>
</template>
<script>
export default {
    created() {
        if (this.$route.params.ma_nguoi_dung) {
            this.$store.dispatch(
                "user/get_user_info",
                this.$route.params.ma_nguoi_dung
            );
        } else {
            this.$store.commit("user/reset_user_info");
        }

        this.$store.commit("user/reset_err");

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
    },
    data() {
        return {
            user: "",
            email: "",
            account: "",
            sdt: "",
            new_password: "",
            re_password: "",
            err_repass: false,
        };
    },
    computed: {
        arr_user() {
            return this.$store.state.user.arr_user;
        },
        current_user: {
            get() {
                return this.$store.state.user.arr_user.filter(
                    (each) =>
                        each.ma_nguoi_dung == this.$route.params.ma_nguoi_dung
                );
            },
            set(val) {
                this.user = val;
            },
        },
        current_email: {
            get() {
                return this.$store.state.user.user_info.email;
            },
            set(val) {
                this.email = val;
            },
        },
        current_account: {
            get() {
                return this.$store.state.user.user_info.tai_khoan;
            },
            set(val) {
                this.account = val;
            },
        },
        current_sdt: {
            get() {
                return this.$store.state.user.user_info.sdt;
            },
            set(val) {
                this.sdt = val;
            },
        },
        err_validate_detail() {
            return this.$store.state.user.err_validate_detail;
        },
        err_validate_global() {
            return this.$store.state.user.err_validate_global;
        },
    },
    methods: {
        userLabel({ ho_ten, email }) {
            return `${ho_ten} - ${email}`;
        },
        process_info_user(e) {
            e.preventDefault();
            this.$store.dispatch("user/update_user_info", {
                ma_nguoi_dung: this.$route.params.ma_nguoi_dung,
                email: this.email,
                tai_khoan: this.account,
                sdt: this.sdt,
                mat_khau: this.new_password ? $.MD5(this.new_password) : "",
            });

            this.new_password = "";
            this.re_password = "";
        },
    },
    watch: {
        new_password() {
            if (!this.re_password || this.re_password == this.new_password) {
                this.err_repass = false;
            } else {
                this.err_repass = true;
            }
        },

        re_password() {
            if (!this.re_password) {
                this.err_repass = false;
            } else if (this.re_password != this.new_password) {
                this.err_repass = true;
            } else {
                this.err_repass = false;
            }
        },

        user() {
            if (this.user) {
                this.$store.commit("user/reset_err");
                this.$router.push(
                    `/quan_ly_user/update_thong_tin_user/${this.user.ma_nguoi_dung}`
                );
                this.$store.dispatch(
                    "user/get_user_info",
                    this.$route.params.ma_nguoi_dung
                );
            } else {
                this.$router.push(`/quan_ly_user/update_thong_tin_user`);
                this.$store.commit("user/reset_user_info");
            }
        },
    },
};
</script>
<style lang="css"></style>
