import getCookie from "../../customfunc/getCookie.js";
import formatCauHinh from "../../customfunc/formatCauHinh";
import Vue from "vue";

export default {
    namespaced: true,
    state: {
        arr_cau_hinh: [],
        thong_tin_cau_hinh: {},
        cau_hinh_da_co_mon: "",
        sum_cau_hinh: "",
        err_form: {},
        reset_form: false
    },

    mutations: {
        reset_thong_tin_cau_hinh(state) {
            state.thong_tin_cau_hinh = {};
        },
        reset_form(state) {
            state.reset_form = false;
        }
    },

    actions: {
        get_cau_hinh({ state, commit, rootState }, user_input) {
            state.arr_cau_hinh = [];
            axios
                .post("api/cauhinh", {
                    key: getCookie("key"),
                    ma_loai: 1
                })
                .then(res => {
                    state.arr_cau_hinh = formatCauHinh(res.data.data);
                    state.sum_cau_hinh = res.data.data.length;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        get_cau_hinh_mon({ state, commit, rootState }) {
            state.arr_cau_hinh = [];
            axios
                .post("api/cauhinhmon", {
                    key: getCookie("key")
                })
                .then(res => {
                    state.cau_hinh_da_co_mon = res.data.data.length;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        get_thong_tin_cau_hinh({ state, commit, rootState }, ma_cau_hinh) {
            axios
                .post(`api/cauhinh/case`, {
                    key: getCookie("key"),
                    ma_cau_hinh: ma_cau_hinh
                })
                .then(res => {
                    state.thong_tin_cau_hinh = res.data.data;
                })
                .catch(err => {
                    console.error(err);
                });
        },
        add_cau_hinh({ state, commit, dispatch, rootState }, user_input) {
            state.err_form = [];
            axios
                .post(`api/cauhinh/them`, {
                    key: getCookie("key"),
                    ...user_input[0]
                })
                .then(res => {
                    if (res.data.success) {
                        if (user_input[1]) {
                            dispatch("add_mon_to_cau_hinh", {
                                key: getCookie("key"),
                                ma_cau_hinh: res.data.data.ma_cau_hinh,
                                ma_mon_hoc: user_input[1],
                                nofi: false
                            });
                        }
                        Vue.notify({
                            group: "nofi",
                            title: "Thành công",
                            text: res.data.message
                        });
                        state.reset_form = true;
                    } else {
                        state.err_form = res.data.message;
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        },
        add_mon_to_cau_hinh({ state, commit, rootState }, data) {
            axios
                .post(`api/cauhinhmon/capnhat`, {
                    ...data
                })
                .then(res => {
                    if (res.data.success && data.nofi) {
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
        update_cau_hinh({ state, commit, dispatch, rootState }, user_input) {
            axios
                .post(`api/cauhinh/sua`, {
                    key: getCookie("key"),
                    ...user_input[0]
                })
                .then(res => {
                    if (res.data.success) {
                        Vue.notify({
                            group: "nofi",
                            title: "Thành công",
                            text: res.data.message
                        });
                        dispatch("get_thong_tin_cau_hinh", {
                            ma_cau_hinh: res.data.data.ma_cau_hinh
                        });
                        var mon_obj = {
                            key: getCookie("key"),
                            ma_cau_hinh: user_input[2],
                            ma_mon_hoc: user_input[1],
                            nofi: false
                        };
                        dispatch("add_mon_to_cau_hinh", mon_obj);
                    } else {
                        var mon_obj = {
                            key: getCookie("key"),
                            ma_cau_hinh: user_input[2],
                            ma_mon_hoc: user_input[1],
                            nofi: true
                        };
                        this.err_form = res.data.message;
                        dispatch("add_mon_to_cau_hinh", mon_obj);
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        }
    }
};
