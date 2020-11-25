import getCookie from "../../customfunc/getCookie.js";
import groupCollection from "../../customfunc/groupCollection.js";
import Vue from "vue";

export default {
    namespaced: true,
    state: {
        arr_phan_cong: [],
        arr_de_xuat_phan_cong_ct: [],
        arr_phan_cong_ct: [],
        reset_select: false,
        // err res
        err_de_xuat: ""
    },
    mutations: {
        reset_err(state) {
            state.err_de_xuat = "";
        },
        reset_arr_phan_cong(state) {
            state.arr_phan_cong = [];
        },
        reset_arr_de_xuat_phan_cong_ct(state) {
            state.arr_de_xuat_phan_cong_ct = [];
        },
        reset_select(state) {
            state.reset_select = true;
        },
        delete_arr_phan_cong_ct(state, filter_data) {
            for (let i = 0; i < state.arr_phan_cong_ct.length; i++) {
                if (
                    state.arr_phan_cong_ct[i].thu ==
                        filter_data.user_input.thu &&
                    state.arr_phan_cong_ct[i].ma_ca ==
                        filter_data.user_input.ma_ca
                ) {
                    state.arr_phan_cong_ct.splice(i, 1);
                    return;
                }
            }
        },
        reset_arr_phan_cong_ct(state) {
            state.arr_phan_cong_ct = [];
        }
    },
    actions: {
        get_phan_cong({ state, commit, rootState }, ma_giao_vien) {
            state.arr_phan_cong = [];
            var obj = {
                key: getCookie("key")
            };
            if (ma_giao_vien) {
                obj.ma_giao_vien = ma_giao_vien;
            }
            axios
                .post(`api/phancong`, obj)
                .then(res => {
                    var result = res.data.data;
                    for (const each in result) {
                        var clone_obj = {
                            ...result[each],
                            ho_ten: result[each].nguoidung
                                ? result[each].nguoidung.ho_ten
                                : "demo"
                        };
                        state.arr_phan_cong.push(clone_obj);
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        },

        get_phan_cong_chi_tiet({ state, commit, rootState }, ma_phan_cong) {
            state.arr_phan_cong_ct = [];
            axios
                .post(`api/phancongchitiet`, {
                    key: getCookie("key"),
                    ma_phan_cong: ma_phan_cong
                })
                .then(res => {
                    if (res.data.message) {
                        state.arr_phan_cong_ct =
                            res.data.data.phan_cong_chi_tiet;
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        },

        get_de_xuat_phan_cong_ct({ state, commit, rootState }, phan_cong_info) {
            state.arr_de_xuat_phan_cong_ct = [];
            axios
                .post(`api/phancongchitiet/dexuat`, {
                    key: getCookie("key"),
                    ...phan_cong_info
                })
                .then(res => {
                    if (res.data.success) {
                        res = groupCollection(res.data.data, "thu");
                        commit("reset_err");
                        state.arr_de_xuat_phan_cong_ct = res;
                    } else {
                        state.err_de_xuat = res.data.message;
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        },

        add_phan_cong_chi_tiet({ state, commit, rootState }, phan_cong_ct) {
            axios
                .post(`api/phancongchitiet/tao`, {
                    key: getCookie("key"),
                    ...phan_cong_ct
                })
                .then(res => {
                    if (res.data.success) {
                        Vue.notify({
                            group: "nofi",
                            type: "success",
                            title: "Thành công",
                            text: res.data.message,
                            duration: 1500
                        });
                        commit("reset_arr_de_xuat_phan_cong_ct");
                        commit("reset_select");
                    } else {
                        state.err_de_xuat = res.data.message
                            ? res.data.message.phan_cong_chi_tiet
                            : res.data.message;
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        },

        delete_phan_cong_chi_tiet({ state, commit, rootState }, data) {
            axios
                .post("api/phancongchitiet/xoa", {
                    key: getCookie("key"),
                    ma_phan_cong: data.ma_phan_cong,
                    thu: data.user_input.thu,
                    ma_ca: data.user_input.ma_ca,
                    ma_phong: data.user_input.ma_phong
                })
                .then(res => {
                    if (res.data.message) {
                        Vue.notify({
                            group: "nofi",
                            type: "success",
                            title: "Thành công",
                            text: res.data.message,
                            duration: 1500
                        });
                    }
                })
                .then(commit("delete_arr_phan_cong_ct", data))
                .catch(err => {
                    console.error(err);
                });
        }
    }
};
