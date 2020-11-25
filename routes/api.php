<?php

use Illuminate\Support\Facades\Route;
//Chưa login cũng được phép truy cập
///NguoiDungController-ALL
Route::any('dangnhap/{tai_khoan}/{mat_khau}', 'Api\NguoiDungController@dangNhap')
    ->name('api.nguoidung.dangNhap');
Route::any('nguoidung/reset', 'Api\NguoiDungController@khoiPhucMatKhau')
    ->name('api.nguoidung.khoiPhucMatKhau');
Route::group(['middleware' => 'CheckLogin'], function () {
    Route::any('dangxuat', 'Api\NguoiDungController@dangXuat')
        ->name('api.nguoidung.dangXuat');
    Route::any('nguoidung/doimatkhau', 'Api\NguoiDungController@doiMatKhau')
        ->name('api.nguoidung.doiMatKhau');
    Route::any('nguoidung/capnhatthongtin/{id}', 'Api\NguoiDungController@capNhatThongTin')
        ->name('api.nguoidung.capNhatThongTin');
    Route::any('nguoidung/kiemtra', 'Api\NguoiDungController@kiemTra')
        ->name('api.nguoidung.view.kiemTra');
    Route::any('nguoidung/kiemtrakey', 'Api\NguoiDungController@kiemTraKey')
        ->name('api.nguoidung.kiemTraKey');
    Route::any('nguoidung/danhsach', 'Api\NguoiDungController@danhSachGiaoVienKiThuat')
        ->name('api.nguoidung.danhSachGiaoVienKiThuat');
    Route::any('nguoidung/thongtin', 'Api\NguoiDungController@thongTin')
        ->name('api.nguoidung.thongTin');
});
//NguoiDungController-Giáo Vụ
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('nguoidung/tao', 'Api\NguoiDungController@taoNguoiDung')
        ->name('api.nguoidung.taoNguoiDung');
    Route::any('nguoidung/danhsachall', 'Api\NguoiDungController@danhSachAll')
        ->name('api.nguoidung.danhSachAll');
    Route::any('nguoidung/clone', 'Api\NguoiDungController@giaoVienClone')
        ->name('api.nguoidung.giaoVienClone');
});
///ToaController--ALL USER
Route::group(['middleware' => ['CheckLogin']], function () {
    Route::any('toa/hienthicactoa', 'Api\ToaController@hienThiTatCaToa')
        ->name('api.toa.hienThiTatCaToa');
});

///ToaController--Giáo Vụ
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('toa/capnhat', 'Api\ToaController@capNhatToa')
        ->name('api.toa.capNhatToa');
    Route::any('toa/kiemtra', 'Api\ToaController@kiemTra')
        ->name('api.toa.kiemTra');
});

//TangController--
//--ALL
Route::group(['middleware' => 'CheckLogin'], function () {
    Route::any('tang', 'Api\TangController@hienthiCacTang')
        ->name('api.tang.hienthiCacTang');
    Route::any('tang/kiemtra', 'Api\TangController@kiemTra')
        ->name('api.tang.kiemTra');
});
//-Giáo Vụ
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('tang/capnhat', 'Api\TangController@capNhatTang')
        ->name('api.tang.update');
    Route::any('tang/tao', 'Api\TangController@taoTang')
        ->name('api.tang.taoTang');
});

//PhongController--Giáo Vụ
Route::group(['middleware' => 'CheckLogin'], function () {
    Route::any('phong', 'Api\PhongController@getPhongTheoTang')
        ->name('api.phong.getPhongTheoTang');
    Route::any('phong/kiemtra', 'Api\PhongController@kiemTra')
        ->name('api.phong.kiemTra');
});
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('phong/taohoaccapnhat', 'Api\PhongController@taoHoacCapNhatPhong')
        ->name('api.phong.taoHoacCapNhatPhong');
    Route::any('phong/xoa', 'Api\PhongController@xoaPhong')
        ->name('api.phong.delete');
    Route::any('phong/chitiet', 'Api\PhongController@hienThiPhong')
        ->name('api.phong.hienThiPhong');
    Route::any('phong/cauhinhphong', 'Api\PhongController@thietBiWithPhong')
        ->name('api.phong.thietBiWithPhong');
});

//ThietBiPhongController

Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('thietbiphong/taohoacsua', 'Api\ThietBiPhongController@taoHoacSua')
        ->name('api.thietbiphong.taoHoacSua');
    Route::any('thietbiphong/xoa', 'Api\ThietBiPhongController@xoaThietBi')
        ->name('api.thietbiphong.xoaThietBi');
});
//LoaiController
//--Giáo Vụ
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('loai/sua', 'Api\LoaiController@suaLoai')
        ->name('api.loai.suaLoai');
    Route::any('loai/them', 'Api\LoaiController@themLoai')
        ->name('api.loai.themLoai');
});
Route::group(['middleware' => ['CheckLogin']], function () {
    Route::any('loai', 'Api\LoaiController@hienThi')
        ->name('api.loai.hienThi');
    Route::any('loai/kiemtra', 'Api\LoaiController@kiemTra')
        ->name('api.loai.kiemTra');
});

//CauHinhController
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVuOrKiThuat']], function () {
    Route::any('cauhinh', 'Api\CauHinhController@hienThi')
        ->name('api.cauhinh.hienThi');
    Route::any('cauhinh/case', 'Api\CauHinhController@hienThiCase')
        ->name('api.cauhinh.hienThiCase');
    Route::any('cauhinh/sua', 'Api\CauHinhController@capNhatCauHinh')
        ->name('api.cauhinh.capNhatCauHinh');
    Route::any('cauhinh/them', 'Api\CauHinhController@themCauHinh')
        ->name('api.cauhinh.themCauHinh');
    Route::any('cauhinh/kiemtra', 'Api\CauHinhController@kiemTra')
        ->name('api.cauhinh.kiemTra');
});

//CauHinhMonController
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVuOrKiThuat']], function () {
    Route::any('cauhinhmon', 'Api\CauHinhMonController@danhSachCauHinhCoCHM')
        ->name('api.cauhinhmon.danhSachCauHinhCoCHM');
    Route::any('cauhinhmon/mon', 'Api\CauHinhMonController@hienThiDanhSachMon')
        ->name('api.cauhinhmon.hienThiDanhSachMon');
    Route::any('cauhinhmon/capnhat', 'Api\CauHinhMonController@monHocDuocTheoCauHinh')
        ->name('api.cauhinhmon.monHocDuocTheoCauHinh');
    Route::any('cauhinhmon/kiemtra', 'Api\CauHinhMonController@kiemTra')
        ->name('api.cauhinhmon.kiemTra');
});
//NgàyNghỉController
//--ALL
Route::group(['middleware' => ['CheckLogin']], function () {
    Route::any('ngaynghi', 'Api\NgayNghiController@hienThiTatCa')
        ->name('api.ngaynghi.hienThiTatCa');
    Route::any('ngaynghi/giaovien', 'Api\NgayNghiController@ngayNghiTheoGiaoVien')
        ->name('api.ngaynghi.ngayNghiTheoGiaoVien');
    Route::any('ngaynghi/kiemtra', 'Api\NgayNghiController@kiemTra')
        ->name('api.ngaynghi.kiemTra');
});
//-Giáo Vụ
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('ngaynghi/them', 'Api\NgayNghiController@themNgayNghi')
        ->name('api.ngaynghi.themNgayNghi');
    Route::any('ngaynghi/sua', 'Api\NgayNghiController@suaNgayNghi')
        ->name('api.ngaynghi.suaNgayNghi');
});
//Ca Controller
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVuOrGiaoVien']], function () {
    Route::any('ca', 'Api\CaController@hienThiTatCa')
        ->name('api.ca.hienThiTatCa');
    Route::any('ca/ngaynghi', 'Api\CaController@caReservedNgayNghi')
        ->name('api.ca.caReservedNgayNghi');
});
//GiáoViênController --Giáo Vụ + Giáo Viên
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVuOrGiaoVien']], function () {
    Route::any('giaovien', 'Api\GiaoVienController@getGiaoVien')
        ->name('api.giaovien.getGiaoVien');
});
//MônHoc Controller
Route::group(['middleware' => ['CheckLogin']], function () {
    Route::any('monhoc', 'Api\MonHocController@hienThiTatCaMon')
        ->name('api.monhoc.hienThiTatCaMon');
    Route::any('monhoc/kiemtra', 'Api\MonHocController@kiemTra')
        ->name('api.monhoc.kiemTra');
});
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('monhoc/clone', 'Api\MonHocController@cloneBKACADToLocal')
        ->name('api.monhoc.cloneBKACADToLocal');
});

//PhanCongController
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('phancong/clone', 'Api\PhanCongController@cloneBKACADToLocal')
        ->name('api.phancong.cloneBKACADToLocal');
});
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVuOrGiaoVien']], function () {
    Route::any('phancong', 'Api\PhanCongController@phanCongWithTtGv')
        ->name('api.phancong.phanCongWithTtGv');
    Route::any('phancong/kiemtra', 'Api\PhanCongController@kiemTra')
        ->name('api.phancong.kiemTra');
});
//CallAPIController
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVuOrGiaoVien']], function () {
    Route::any('khoa', 'Api\ShowCallController@khoa')
        ->name('api.khoa.all');
    Route::any('ctdt', 'Api\ShowCallController@ctdt')
        ->name('api.khoa.ctdt');
});

//PhanCongChiTiet Controller
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVuOrGiaoVien']], function () {
    Route::any('phancongchitiet', 'Api\PhanCongChiTietController@hienThi')
        ->name('api.phancongchitiet.hienThi');
    Route::any('phancongchitiet/kiemtra', 'Api\PhanCongChiTietController@kiemTra')
        ->name('api.phancongchitiet.kiemTra');
});
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('phancongchitiet/dexuat', 'Api\PhanCongChiTietController@deXuatPcct')
        ->name('api.phancongchitiet.deXuatPcct');
    Route::any('phancongchitiet/tao', 'Api\PhanCongChiTietController@taoPcct')
        ->name('api.phancongchitiet.taoPcct');
    Route::any('phancongchitiet/xoa', 'Api\PhanCongChiTietController@xoaPCCT')
        ->name('api.phancongchitiet.xoaPCCT');
});
//NguoiDungBoMonController
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVuOrGiaoVien']], function () {
    Route::any('nguoidungbomon', 'Api\NguoiDungBoMonController@hienThi')
        ->name('api.nguoidungbomon.hienThi');
    Route::any('nguoidungbomon/kiemtra', 'Api\NguoiDungBoMonController@kiemTra')
        ->name('api.nguoidungbomon.kiemTra');
    // Route::any('nguoidungbomon/demo', 'Api\NguoiDungBoMonController@cloneWithPhanCong')
    //     ->name('api.nguoidungbomon.cloneWithPhanCong');
});
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('nguoidungbomon/themhoacsua', 'Api\NguoiDungBoMonController@themHoacSua')
        ->name('api.nguoidungbomon.themHoacSua');
    Route::any('nguoidungbomon/thongke', 'Api\NguoiDungBoMonController@giaoVienSoMon')
        ->name('api.nguoidungbomon.giaoVienSoMon');
});
//LichDayBoSungController
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVuOrGiaoVien']], function () {
    Route::any('lichdaybosung', 'Api\LichDayBoSungController@hienThi')
        ->name('api.lichdaybosung.hienThi');
    Route::any('lichdaybosung/dexuat', 'Api\LichDayBoSungController@deXuatLich')
        ->name('api.lichdaybosung.deXuatLich');
    Route::any('lichdaybosung/kiemtra', 'Api\LichDayBoSungController@kiemTra')
        ->name('api.lichdaybosung.kiemTra');
});
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('lichdaybosung/them', 'Api\LichDayBoSungController@themLich')
        ->name('api.lichdaybosung.themLich');
    Route::any('lichdaybosung/sua', 'Api\LichDayBoSungController@suaLich')
        ->name('api.lichdaybosung.suaLich');
    Route::any('lichdaybosung/xoa', 'Api\LichDayBoSungController@xoaLich')
        ->name('api.lichdaybosung.xoaLich');
});
//LichHoc Controller
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVu']], function () {
    Route::any('lichhoc/lichphong', 'Api\LichHocController@lichPhong')
        ->name('api.lichhoc.lichPhong');
});
Route::group(['middleware' => ['CheckLogin', 'CheckGiaoVuOrGiaoVien']], function () {
    Route::any('lichhoc/giaovien', 'Api\LichHocController@lichDayCuaGiaoVien')
        ->name('api.lichhoc.lichDayCuaGiaoVien');
    Route::any('lichhoc/dukienketthuc', 'Api\LichHocController@lichDuKienKetThuc')
        ->name('api.lichhoc.lichDuKienKetThuc');
    Route::any('lichhoc/bosungdexuat', 'Api\LichHocController@lichDayBoSungDeXuat')
        ->name('api.lichhoc.lichDayBoSungDeXuat');
    Route::any('lichhoc/lichtrong', 'Api\LichHocController@lichPhongTrong')
        ->name('api.lichhoc.lichPhongTrong');
});

///Run Artisan

Route::any('artisan/run', 'Api\ArtisanController@runArtisan')
    ->name('api.artisan.runArtisan');