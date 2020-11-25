import getCookie from "../../customfunc/getCookie.js";

export default {
    namespaced: true,
    state: {
        arr_tang: []
    },
    mutations: {
        reset_arr_tang(state) {
            state.arr_tang = [];
        }
    },
    actions: {
        get_tang({ state, commit, rootState }, ma_toa) {
            state.arr_tang = [];
            axios
                .post("api/tang", {
                    key: getCookie("key"),
                    ma_toa: ma_toa
                })
                .then(res => {
                    state.arr_tang = res.data.data;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
};
