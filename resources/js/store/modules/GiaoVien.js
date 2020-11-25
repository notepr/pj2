import getCookie from "../../customfunc/getCookie.js";
import Vue from "vue";
import formatEvents from "../../customfunc/formatEvents";
import getCurrentDate from "../../customfunc/getCurrentDate";

export default {
    namespaced: true,
    state: {
        lich_lam_viec: [],
        lich_ket_thuc: ""
    },
    mutations: {
        reset_lich_lam_viec(state) {
            state.lich_lam_viec = [];
        }
    },
    actions: {
        get_lich_lam_viec(
            { state, commit, dispatch, rootState },
            ma_giao_vien
        ) {
            state.lich_lam_viec = [];
            state.lich_ket_thuc = "";
            var obj = {
                key: getCookie("key")
            };
            if (ma_giao_vien) {
                obj.ma_giao_vien = ma_giao_vien;
            }
            axios
                .post(`api/lichhoc/giaovien`, obj)
                .then(res => {
                    state.lich_lam_viec = formatEvents(res.data.data);
                    dispatch("get_lich_bo_sung", obj);
                })
                .catch(err => {
                    console.error(err);
                });
        },
        get_lich_lam_viec_by_phan_cong(
            { state, commit, rootState },
            ma_phan_cong
        ) {
            state.lich_lam_viec = [];
            state.lich_ket_thuc = "";
            axios
                .post(`api/lichhoc/dukienketthuc`, {
                    key: getCookie("key"),
                    ma_phan_cong: ma_phan_cong
                })
                .then(res => {
                    state.lich_ket_thuc = res.data.message;
                    state.lich_lam_viec = formatEvents(
                        res.data.data.lich_day,
                        true
                    );
                })
                .catch(err => {
                    console.error(err);
                });
        },

        get_lich_bo_sung({ state, commit, rootState }, data) {
            var arr_bo_sung = [];

            axios
                .post(`api/lichdaybosung`, data)
                .then(res => {
                    console.log(res.data);
                    if (res.data.success) {
                        var result = res.data.data;
                        for (const each in result) {
                            var clone_obj = {
                                start:
                                    result[each].ngay +
                                    `T${result[each].ca.gio_bat_dau}`,
                                end:
                                    result[each].ngay +
                                    `T${result[each].ca.gio_ket_thuc}`,
                                title: `${result[each].ma_lop} - ${result[each].ma_mon_hoc}`
                            };
                            var current = Date.parse(getCurrentDate("all"));
                            var check = Date.parse(result[each].ngay);
                            if (check < current) {
                                clone_obj.backgroundColor = "gray";
                            }
                            arr_bo_sung.push(clone_obj);
                        }

                        state.lich_lam_viec = state.lich_lam_viec.concat(
                            arr_bo_sung
                        );
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        }
    }
};
