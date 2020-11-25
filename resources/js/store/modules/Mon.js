import getCookie from "../../customfunc/getCookie.js";

export default {
    namespaced: true,
    state: {
        arr_mon: [],
        arr_mon_by_cau_hinh: []
    },

    mutations: {
        reset_arr_mon(state) {
            state.arr_mon = [];
        },
        reset_arr_mon_by_cau_hinh(state) {
            state.arr_mon_by_cau_hinh = [];
        }
    },

    actions: {
        get_mon({ state, commit, rootState }) {
            state.arr_mon = [];
            axios
                .post("api/monhoc", {
                    key: getCookie("key")
                })
                .then(res => {
                    state.arr_mon = res.data.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        get_mon_by_cau_hinh({ state, commit, rootState }, ma_cau_hinh) {
            state.arr_mon_by_cau_hinh = [];
            axios
                .post(`api/cauhinhmon/mon`, {
                    key: getCookie("key"),
                    ma_cau_hinh: ma_cau_hinh
                })
                .then(res => {
                    var result = res.data.data.list_mon;
                    for (const each in result) {
                        delete result[each].ma_cau_hinh;
                    }
                    state.arr_mon_by_cau_hinh = result;
                })
                .catch(err => {
                    console.error(err);
                });
        }
    }
};
