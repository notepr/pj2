import getCookie from "../../customfunc/getCookie.js";

export default {
    namespaced: true,

    state: {
        arr_ca: []
    },

    mutations: {},

    actions: {
        get_ca({ state, commit, rootState }) {
            axios
                .post("api/ca", {
                    key: getCookie("key")
                })
                .then(res => {
                    if (res.data.message) {
                        state.arr_ca = res.data.data;
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        }
    }
};
