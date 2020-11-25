import getCookie from "./customfunc/getCookie.js";

// import store
import store from "./store/store.js";

// home
import home from "./views/home/HomeComponent.vue";

// general
import thong_tin_lab from "./views/general/Lab.vue";

// ky thuat
import lab from "./views/kythuat/Lab.vue";
import danh_sach_lab from "./views/kythuat/components/lab/DanhSachLab.vue";
import them_lab from "./views/kythuat/components/lab/ThemLab.vue";
import update_lab from "./views/kythuat/components/lab/UpdateLab.vue";

import cau_hinh from "./views/kythuat/CauHinh.vue";
import danh_sach_cau_hinh from "./views/kythuat/components/cauhinh/DanhSachCauHinh.vue";
import them_cau_hinh from "./views/kythuat/components/cauhinh/ThemCauHinh.vue";
import update_cau_hinh from "./views/kythuat/components/cauhinh/UpdateCauHinh.vue";

import thiet_bi from "./views/kythuat/ThietBi.vue";
import danh_sach_thiet_bi from "./views/kythuat/components/thietbi/DanhSachThietBi.vue";
import them_thiet_bi from "./views/kythuat/components/thietbi/ThemThietBiComponent.vue";

// giao vien
import lich_gv from "./views/giaovien/GiaoVien.vue";

// giao vu
import quan_ly_lich from "./views/giaovu/QuanLyLichLamViec.vue";
import lich_nghi from "./views/giaovu/components/quanlylichlamviec/XemLichNghi.vue";
import them_lich_nghi from "./views/giaovu/components/quanlylichlamviec/themLichNghi";
import them_lich_day from "./views/giaovu/components/quanlylichlamviec/ThemLichDay.vue";
import xem_phan_cong from "./views/giaovu/components/quanlylichlamviec/XemPhanCongChiTiet.vue";
import phan_cong from "./views/giaovu/components/quanlylichlamviec/PhanCongChiTiet.vue";
import xem_lich_bo_sung from "./views/giaovu/components/quanlylichlamviec/XemLichBoSung.vue";

import user from "./views/giaovu/QuanLyUsers.vue";
import danh_sach_user from "./views/giaovu/components/quanlyusers/DanhSachUser.vue";
import update_thong_tin_user from "./views/giaovu/components/quanlyusers/UserProfile.vue";

// user-general
import profile from "./views/nguoidung/Profile.vue";
import quen_mat_khau from "./views/nguoidung/ForgotPassword.vue";

// error
import error_url from "./views/error/CantDirectComponent.vue";
import error_author from "./views/error/AuthorErrComponent.vue";

export default [
    // general
    { path: "/home", name: "home", component: home },

    { path: "/xem_thong_tin_lab", component: thong_tin_lab },

    // ky thuat
    {
        path: "/quan_ly_lab",
        component: lab,
        children: [
            { path: "danh_sach_lab", component: danh_sach_lab },
            { path: "them_lab", component: them_lab },
            { path: "update_lab", component: update_lab },
            { path: "update_lab/:ma_lab", component: update_lab }
        ],
        beforeEnter: (to, from, next) => {
            if (getCookie("level") == 1 || getCookie("level") == 2) {
                next();
            } else {
                next("/err_author");
            }
        }
    },
    {
        path: "/quan_ly_cau_hinh",
        component: cau_hinh,
        children: [
            { path: "danh_sach_cau_hinh", component: danh_sach_cau_hinh },
            { path: "them_cau_hinh", component: them_cau_hinh },
            { path: "update_cau_hinh", component: update_cau_hinh },
            { path: "update_cau_hinh/:ma_cau_hinh", component: update_cau_hinh }
        ],
        beforeEnter: (to, from, next) => {
            if (getCookie("level") == 1 || getCookie("level") == 2) {
                next();
            } else {
                next("/err_author");
            }
        }
    },
    {
        path: "/quan_ly_thiet_bi",
        component: thiet_bi,
        children: [
            { path: "danh_sach_thiet_bi", component: danh_sach_thiet_bi },
            { path: "them_thiet_bi", component: them_thiet_bi }
        ],
        beforeEnter: (to, from, next) => {
            if (getCookie("level") == 1 || getCookie("level") == 2) {
                next();
            } else {
                next("/err_author");
            }
        }
    },

    // giao vien
    {
        path: "/lich_lam_viec",
        component: lich_gv,
        beforeEnter: (to, from, next) => {
            if (getCookie("level") == 1) {
                next();
            } else if (getCookie("level") == 3) {
                store.state.user.is_giao_vien = true;
                next();
            } else {
                next("/err_author");
            }
        }
    },

    // giao vu
    {
        path: "/quan_ly_lich_lam_viec",
        component: quan_ly_lich,
        children: [
            { path: "xem_lich_nghi", component: lich_nghi },
            { path: "them_lich_nghi", component: them_lich_nghi },
            { path: "them_lich_day", component: them_lich_day },
            { path: "xem_phan_cong_chi_tiet", component: xem_phan_cong },
            { path: "phan_cong_chi_tiet", component: phan_cong },
            { path: "xem_lich_bo_sung", component: xem_lich_bo_sung }
        ],
        beforeEnter: (to, from, next) => {
            if (getCookie("level") == 1) {
                next();
            } else {
                next("/err_author");
            }
        }
    },
    {
        path: "/quan_ly_user",
        component: user,
        children: [
            { path: "danh_sach_nguoi_dung", component: danh_sach_user },
            { path: "update_thong_tin_user", component: update_thong_tin_user },
            {
                path: "update_thong_tin_user/:ma_nguoi_dung",
                component: update_thong_tin_user
            }
        ],
        beforeEnter: (to, from, next) => {
            if (getCookie("level") == 1) {
                next();
            } else {
                next("/err_author");
            }
        }
    },

    // user
    { path: "/profile", component: profile },
    { path: "/quen_mat_khau", component: quen_mat_khau },

    // error
    { path: "/err_author", component: error_author },
    { path: "*", component: error_url }
];
