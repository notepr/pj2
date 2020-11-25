import getCookie from "../../customfunc/getCookie.js";
import formatNgayNghi from "../../customfunc/formatNgayNghi";
import getCurrentDate from "../../customfunc/getCurrentDate";
import Vue from "vue";
import router from "../../routes";

export default {
    namespaced: true,
    state: {
        arr_ngay_nghi: [],
        err_note: "",
        reset_form: false,
        thong_ke_ngay_nghi: 0,
        thong_ke_by_gv: ""
    },

    mutations: {
        reset_arr_ngay_nghi(state) {
            state.arr_ngay_nghi = [];
        },
        refresh_arr_ngay_nghi(state, user_input) {
            console.log(1);
            state.arr_ngay_nghi = state.arr_ngay_nghi.filter(each => {
                return each.btn != user_input.btn;
            });
        },
        refresh_err(state) {
            state.err_note = "";
        }
    },

    actions: {
        get_ngay_nghi({ state, commit, rootState }) {
            axios
                .post(`api/ngaynghi`, {
                    key: getCookie("key")
                })
                .then(res => {
                    if (res.data.success) {
                        for (const each in res.data.data) {
                            if (each.split("-")[2] == getCurrentDate("date")) {
                                state.thong_ke_ngay_nghi =
                                    res.data.data[each].length;
                            }
                        }
                        state.arr_ngay_nghi = formatNgayNghi(res.data.data);
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        },
        get_ngay_nghi_gv({ state, commit, rootState }, ma_gv) {
            state.arr_ngay_nghi = [];
            axios
                .post(`api/ngaynghi`, {
                    key: getCookie("key"),
                    ma_giao_vien: [ma_gv]
                })
                .then(res => {
                    state.arr_ngay_nghi = formatNgayNghi(res.data.data);
                })
                .catch(err => {
                    console.error(err);
                });
        },
        add_ngay_nghi({ state, commit, rootState }, user_input) {
            state.reset_form = false;
            axios
                .post(`api/ngaynghi/them`, {
                    key: getCookie("key"),
                    ...user_input
                })
                .then(res => {
                    if (res.data.success) {
                        if (res.data.message == "Tồn tại 1 ngày nghỉ") {
                            Vue.notify({
                                group: "nofi",
                                type: "error",
                                title: "Thất bại",
                                text: "Đã " + res.data.message
                            });
                            state.reset_form = false;
                        } else {
                            Vue.notify({
                                group: "nofi",
                                title: "Thành công",
                                text: res.data.message
                            });
                            state.reset_form = true;
                        }
                    } else {
                        state.err_note = res.data.message.ghi_chu;
                        state.reset_form = false;
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        },
        delete_ngay_nghi({ state, commit, rootState }, user_input) {
            axios
                .post(`api/ngaynghi/sua`, {
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
                        commit("refresh_arr_ngay_nghi", user_input[1]);
                    } else {
                        Vue.notify({
                            group: "nofi",
                            type: "error",
                            title: "Thất bại",
                            text: "Không thể xóa ngày nghỉ trước ngày hôm nay"
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        },
        get_thong_ke({ state, commit, rootState }) {}
    }
};
