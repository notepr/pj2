import getCookie from "../../customfunc/getCookie.js";
import groupCollection from "../../customfunc/groupCollection";
import Vue from "vue";

export default {
    namespaced: true,

    state: {
        arr_de_xuat: [],
        reset_form: false,
        arr_lich_bo_sung: []
    },

    mutations: {
        reset_arr_de_xuat(state) {
            state.arr_de_xuat = [];
        },
        refresh_arr_lich_bo_sung(state, data) {
            state.arr_lich_bo_sung = state.arr_lich_bo_sung.filter(
                each => each.ma_lich_day_bo_sung != data
            );
        }
    },

    actions: {
        get_de_xuat({ state, commit, rootState }, user_input) {
            state.reset_form = false;
            state.arr_de_xuat = [];
            axios
                .post(`api/lichdaybosung/dexuat`, {
                    key: getCookie("key"),
                    ...user_input
                })
                .then(res => {
                    if (res.data.success) {
                        var clone_arr = [];
                        var result = res.data.data;
                        for (const each in result) {
                            for (let i = 0; i < result[each].length; i++) {
                                result[each][i].ngay = each;
                                clone_arr.push(result[each][i]);
                            }
                        }
                        state.arr_de_xuat = groupCollection(clone_arr, "ngay");
                    } else {
                        Vue.notify({
                            group: "nofi",
                            title: "Thất bại",
                            type: "error",
                            text: res.data.message.ma_lop
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        },
        add_de_xuat({ state, commit, rootState }, user_input) {
            axios
                .post(`api/lichdaybosung/them`, {
                    key: getCookie("key"),
                    ...user_input
                })
                .then(res => {
                    if (res.data.success) {
                        Vue.notify({
                            group: "nofi",
                            title: "Thành công",
                            text: res.data.message
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        },
        get_lich_bo_sung({ state, commit, rootState }, ma_giao_vien) {
            state.arr_lich_bo_sung = [];

            var obj = {
                key: getCookie("key"),
                ma_giao_vien: ma_giao_vien
            };

            axios
                .post(`api/lichdaybosung`, obj)
                .then(res => {
                    state.arr_lich_bo_sung = res.data.data;
                })
                .catch(err => {
                    console.error(err);
                });
        },
        delete_lich_bo_sung({ state, commit, rootState }, data) {
            axios
                .post(`api/lichdaybosung/xoa`, {
                    key: getCookie("key"),
                    ma_lich_day_bo_sung: data
                })
                .then(res => {
                    if (res.data.success) {
                        Vue.notify({
                            group: "nofi",
                            title: "Thành công",
                            text: res.data.message
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                });
            commit("refresh_arr_lich_bo_sung", data);
        }
    }
};
