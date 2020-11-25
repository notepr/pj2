<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <b>Your profile</b>
                        </h3>
                        <p>
                            <b>{{ current_name }}</b>
                        </p>
                    </div>
                    <hr />
                    <div class="card-body">
                        <form @submit="process_user_info">
                            <span
                                v-if="err_validate_global"
                                class="text-danger"
                            >{{err_validate_global}}</span>
                            <div class="form-group">
                                <label for="insertEmail">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="insertEmail"
                                    placeholder="Nhập email"
                                    v-model="current_email"
                                />
                                <span
                                    v-if="err_validate_detail.email"
                                    class="text-danger"
                                >{{err_validate_detail.email}}</span>
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
                                >{{err_validate_detail.tai_khoan}}</span>
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
                                <span
                                    v-if="err_validate_detail.sdt"
                                    class="text-danger"
                                >{{err_validate_detail.sdt}}</span>
                            </div>
                            <br />
                            <div class="form-group">
                                <label for="currentPass">Mật khẩu hiện tại</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="currentPass"
                                    placeholder="Nhập mật khẩu hiện tại"
                                />
                            </div>
                            <br />
                            <div class="form-group">
                                <label for="insertPass">Mật khẩu mới</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="insertPass"
                                    placeholder="Nhập mật khẩu mới"
                                    v-model="new_password"
                                />
                            </div>
                            <br />
                            <div class="form-group">
                                <label for="confirmPass">Nhập lại mật khẩu mới</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="confirmPass"
                                    placeholder="Nhập lại mật khẩu"
                                    v-model="re_password"
                                />
                                <span v-if="err_repass" class="text-danger">
                                    Mật khẩu nhập lại phải trùng với mật
                                    khẩu
                                </span>
                            </div>
                            <br />
                            <button class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    created() {
        this.$store.dispatch("user/get_self_info");
        this.$store.commit("user/reset_err");
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
            email: "",
            account: "",
            sdt: "",
            currnet_password: "",
            new_password: "",
            re_password: "",
            err_repass: false,
        };
    },
    computed: {
        current_name() {
            return this.$store.state.user.self_info.ho_ten;
        },
        current_email: {
            get() {
                return this.$store.state.user.self_info.email;
            },

            set(val) {
                this.email = val;
            },
        },
        current_account: {
            get() {
                return this.$store.state.user.self_info.tai_khoan;
            },

            set(val) {
                this.account = val;
            },
        },
        current_sdt: {
            get() {
                return this.$store.state.user.self_info.sdt;
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
        process_user_info(e) {
            e.preventDefault();
            this.$store.dispatch("user/update_self_info", {
                ma_nguoi_dung: this.$store.state.user.self_info.ma_nguoi_dung,
                email: this.email,
                tai_khoan: this.account,
                sdt: this.sdt,
            });
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
    },
};
</script>
<style lang="css" scoped></style>
