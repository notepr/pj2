import getCookie from "../../customfunc/getCookie.js";
import Vue from "vue";

export default {
    namespaced: true,
    state: {
        is_giao_vien: false,
        arr_user: [],
        // display user on form
        user_info: {},
        self_info: {},
        // store user
        store_user: {},
        // validate err
        err_validate_detail: {},
        err_validate_global: ""
    },
    mutations: {
        reset_user_info(state) {
            state.user_info = {};
            state.store_user = {};
        },
        reset_err(state) {
            state.err_validate_detail = {};
            state.err_validate_global = "";
        }
    },

    actions: {
        get_all_user({ state, commit, rootState }) {
            state.arr_user = [];
            axios
                .post("api/nguoidung/danhsach", {
                    key: getCookie("key")
                })
                .then(res => {
                    state.arr_user = res.data.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },

        get_user_info({ state, commit, rootState }, ma_nguoi_dung) {
            this.commit("user/reset_user_info");
            axios
                .post("api/nguoidung/thongtin", {
                    key: getCookie("key"),
                    ma: ma_nguoi_dung
                })
                .then(res => {
                    state.user_info = res.data.data;
                    Object.assign(state.store_user, state.user_info);
                })
                .catch(error => {
                    console.error(error);
                });
        },

        update_user_info({ state, commit, rootState }, user) {
            this.commit("user/reset_err");

            for (var m in user) {
                if (!user[m]) {
                    delete user[m];
                }

                if (user[m] == state.store_user[m] && m != "ma_nguoi_dung") {
                    delete user[m];
                }
            }

            axios
                .post(`api/nguoidung/capnhatthongtin/${user.ma_nguoi_dung}`, {
                    key: getCookie("key"),
                    ...user
                })
                .then(res => {
                    if (res.data.success) {
                        this.commit("user/reset_err");
                        this.dispatch("user/get_user_info", user.ma_nguoi_dung);
                        user = { ma_nguoi_dung: user.ma_nguoi_dung };
                        Vue.notify({
                            group: "nofi",
                            title: "Thành công",
                            text: res.data.message,
                            duration: 1500
                        });
                    } else {
                        if (typeof res.data.message === "string") {
                            Object.assign(state.user_info, state.store_user);
                            state.err_validate_global = res.data.message;
                        } else {
                            Object.assign(state.user_info, user);
                            state.err_validate_detail = res.data.message;
                        }
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        },

        get_self_info({ state, commit, rootState }) {
            this.commit("user/reset_user_info");
            axios
                .post("api/nguoidung/thongtin", {
                    key: getCookie("key")
                })
                .then(res => {
                    state.self_info = res.data.data;
                    Object.assign(state.store_user, state.self_info);
                })
                .catch(error => {
                    console.error(error);
                });
        },

        update_self_info({ state, commit, rootState }, user) {
            this.commit("user/reset_err");

            for (var m in user) {
                if (!user[m]) {
                    delete user[m];
                }

                if (user[m] == state.store_user[m] && m != "ma_nguoi_dung") {
                    delete user[m];
                }
            }

            axios
                .post(`api/nguoidung/capnhatthongtin/${user.ma_nguoi_dung}`, {
                    key: getCookie("key"),
                    ...user
                })
                .then(res => {
                    if (res.data.success) {
                        this.commit("user/reset_err");
                        alert(
                            "Đổi thông tin thành công, vui lòng đăng nhập lại."
                        );
                        window.location.href = "logout";
                    } else {
                        if (typeof res.data.message === "string") {
                            state.self_info = Object.assign(
                                state.self_info,
                                state.store_user
                            );
                            state.err_validate_global = res.data.message;
                        } else {
                            state.self_info = Object.assign(
                                state.self_info,
                                user
                            );
                            state.err_validate_detail = res.data.message;
                        }
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        }
    }
};
