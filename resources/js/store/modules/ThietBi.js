import getCookie from "../../customfunc/getCookie.js";

export default {
    namespaced: true,
    state: {
        arr_thiet_bi: []
    },

    mutations: {
        reset_arr_thiet_bi(state) {
            state.arr_thiet_bi = [];
        }
    },

    actions: {
        get_thiet_bi({ state, commit, rootState }) {
            state.arr_thiet_bi = [];

            state.arr_thiet_bi = [
                {
                    ma_thiet_bi: 1,
                    ten_thiet_bi: "thiết bị 1",
                    cau_hinh: "cấu hình 1",
                    tinh_trang: "Hoạt động"
                },
                {
                    ma_thiet_bi: 2,
                    ten_thiet_bi: "thiết bị 2",
                    cau_hinh: "cấu hình 2",
                    tinh_trang: "bảo trì"
                }
            ];
        }
    }
};
