/**
 * @api {POST} ngaynghi 1.1. Hiển thị tất cả Ngày Nghỉ
 * @apiVersion 0.1.0
 * @apiName Tất cả Ngày Nghỉ
 * @apiGroup Ngày Nghỉ
 * @apiDescription Dùng để trả về ngày nào có những ai nghỉ<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 * <button type="button" class="btn btn-info">Giáo Viên</button>
 * </div><br>
 * +Nếu không truyền ngày sẽ lấy tất cả các dữ liệu.<br>
 * +Nếu có truyền ngày sẽ lấy dữ liệu ngày đó.<br>
 * +Nếu truyền thêm tuong_lai (có biến là được) sẽ lấy dữ liệu >= hôm nay.<br>
 * +Nếu giáo vụ được phép lấy về ngày nghỉ của tất cả Người Dùng.<br>
 * +Nếu Giáo Vụ truyền vào ma_giao_vien sẽ lấy theo mã Giáo Viên đó không truyền sẽ lấy tất cả.<br>
 * +Nếu GV hoặc KT chỉ lấy về được ngày nghỉ của chính mình với nhưng tiêu chí như bên trên.<br>
 * +Tự động lấy các ngày nghỉ có tinh_trang  = 1, nếu truyền tinh_trang sẽ lấy theo tinh_trang được truyền .<br>
 *
 * @apiSampleRequest ngaynghi
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" : "keyapi"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_giao_vien Mã của giáo viên hoặc KT.
 * @apiParam {String} tinh_trang Tình trạng của ngày nghỉ.
 * @apiParam {String} tuong_lai Chỉ cần có không cần Value.
 * @apiParam {String} ngay Ngày cần lấy dữ liệu.
 *
 * @apiSuccess {String} data Dữ liệu Ngày Nghỉ.
 *
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": {
 *         "2020-08-29": [
 *             {
 *                 "tinh_trang": 1,
 *                 "nguoidung": {
 *                     "ma_nguoi_dung": 5,
 *                     "ho_ten": null,
 *                     "tai_khoan": "kithuat",
 *                     "email": "kithuat@gmail.com",
 *                     "sdt": "6"
 *                 },
 *                 "ca": [
 *                     {
 *                         "ma_ca": 3,
 *                         "gio_bat_dau": "10:00:00",
 *                         "gio_ket_thuc": "12:00:00",
 *                         "ngay_nghi": [
 *                             {
 *                                 "ma_ca": 3,
 *                                 "ghi_chu": "thích nghỉ"
 *                             }
 *                         ]
 *                     },
 *                     {
 *                         "ma_ca": 5,
 *                         "gio_bat_dau": "13:30:00",
 *                         "gio_ket_thuc": "15:30:00",
 *                         "ngay_nghi": [
 *                             {
 *                                 "ma_ca": 5,
 *                                 "ghi_chu": null
 *                             }
 *                         ]
 *                     },
 *                     {
 *                         "ma_ca": 6,
 *                         "gio_bat_dau": "15:30:00",
 *                         "gio_ket_thuc": "17:30:00",
 *                         "ngay_nghi": [
 *                             {
 *                                 "ma_ca": 6,
 *                                 "ghi_chu": "nghi ddi choiwi"
 *                             }
 *                         ]
 *                     }
 *                 ]
 *             }
 *         ]
 *     }
 * }
 *
 * @apiErrorExample Không Thành Công:
 * HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "tinh_trang": "Tình trạng không hợp lệ"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */
 *
/**
 * @api {POST} ngaynghi/giaovien 1.2. Thống kê ngày nghỉ
 * @apiVersion 0.1.0
 * @apiName Thống kê số buổi nghỉ của tất cả Người Dùng
 * @apiGroup Ngày Nghỉ
 * @apiDescription Dùng để trả về Số Ngày Nghỉ<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 * <button type="button" class="btn btn-info">Giáo Viên</button>
 * </div><br>
 * +Nếu là Giáo Vụ sẽ lấy đếm được ngày nghỉ của tất cả Người Dùng.<br>
 * +Nếu là GV hoặc KT chỉ đếm được ngày nghỉ của chính mình.<br>
 * +Giáo Vụ có thể truyền thêm ma_giao_vien thì sẽ chỉ lấy theo ma_giao_vien đó.<br>
 * +Chỉ đếm tinh_trang = 1.<br>
 *
 * @apiSampleRequest ngaynghi/giaovien
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"keyapi"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_giao_vien Mã của giáo viên hoặc KT.
 *
 * @apiSuccess {String} data Dữ liệu Ngày Nghỉ.
 *
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": [
 *         {
 *             "ma_nguoi_dung": 10,
 *             "ho_ten": "Trần Thị Dung",
 *             "ma_cap_do": 3,
 *             "ten_cap_do": "Giáo Viên",
 *             "ngay_nghi_count": 2,
 *             "ngay_nghi": [
 *                 {
 *                     "ngay": "2020-07-10",
 *                     "ma_giao_vien": 10,
 *                     "ma_ca": 1,
 *                     "ghi_chu": "Đi chơi",
 *                     "tinh_trang": 1
 *                 },
 *                 {
 *                     "ngay": "2020-07-17",
 *                     "ma_giao_vien": 10,
 *                     "ma_ca": 6,
 *                     "ghi_chu": null,
 *                     "tinh_trang": 1
 *                 }
 *             ]
 *         },
 *         {
 *             "ma_nguoi_dung": 1,
 *             "ho_ten": null,
 *             "ma_cap_do": 1,
 *             "ten_cap_do": "Giáo Vụ",
 *             "ngay_nghi_count": 1,
 *             "ngay_nghi": [
 *                 {
 *                     "ngay": "2020-07-09",
 *                     "ma_giao_vien": 1,
 *                     "ma_ca": 3,
 *                     "ghi_chu": null,
 *                     "tinh_trang": 1
 *                 }
 *             ]
 *         }
 *     ]
 * }
 *
 * @apiErrorExample Không Thành Công:
 * HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "ma_giao_vien": "Giáo viên không tồn tại"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */
 *
/**
 * @api {POST} ngaynghi/them 1.3. Thêm Ngày Nghỉ
 * @apiVersion 0.1.0
 * @apiName Thêm Ngày Nghỉ
 * @apiGroup Ngày Nghỉ
 * @apiDescription Dùng để Thêm Ngày Nghỉ Mới<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 * <!-- <button type="button" class="btn btn-info">Giáo Viên</button> -->
 * </div><br>
 * +Có thể truyền mảng ma_giao_vien với tất cả những giáo viên này nghỉ cũng ngày cùng ghi chú.<br>
 * +Truyền thường thì chỉ giáo viên đó.<br>
 * +Có tình trạng sẽ lấy tình trạng nếu không auto tinh_trang = 1. <br>
 * +Có ghi_chu sẽ lấy ghi_chu nếu không auto ghi_chu = null. <br>
 * +Nếu ngày nghỉ đó tồn tại lịch dạy bổ sung sẽ tự hủy lịch dạy bổ sung đó.<br>
 *
 *
 *
 * @apiSampleRequest ngaynghi/them
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ngay": "29-08-2020",
 *     "ma_giao_vien" : [0],
 *     "ma_ca":[2,5]
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_cau_hinh Mã cấu hình.
 * @apiParam {String} ma_mon_hoc Là mã môn truyền dạng mảng nếu truyền thường chỉ thu một môn.
 *
 * @apiSuccess {String} data Dữ liệu Môn.
 *
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Tồn tại 2 ngày nghỉ, Đã cập nhật hủy bỏ 1 Lịch Dạy Bổ Sung",
 *     "data": {
 *         "create": [],
 *         "exists": [],
 *         "update": [],
 *         "lich_day_bo_sung": [
 *             {
 *                 "ma_lich_day_bo_sung": 2,
 *                 "ngay": "2020-08-29",
 *                 "ma_lop": "BIT01K10",
 *                 "nguoi_dung": {
 *                     "ma_nguoi_dung": 6,
 *                     "ho_ten": "Lê Thị Hương Liên",
 *                     "tai_khoan": "yuki.lien85",
 *                     "email": "yuki.lien85@gmail.com",
 *                     "sdt": "0989186985"
 *                 },
 *                 "ma_mon_hoc": "BIT_ECOM1",
 *                 "ca": {
 *                     "ma_ca": 2,
 *                     "gio_bat_dau": "08:00:00",
 *                     "gio_ket_thuc": "10:00:00"
 *                 },
 *                 "phong": {
 *                     "ma_phong": 5,
 *                     "ten_phong": "Lab 5",
 *                     "so_cho_ngoi": 35,
 *                     "ma_tang": 4,
 *                     "ma_tinh_trang": 1,
 *                     "ghi_chu": ""
 *                 },
 *                 "ghi_chu": ""
 *             }
 *         ]
 *     }
 * }
 *
 * @apiErrorExample Không Thành Công:
 * HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "ngay": "Ngày không hợp lệ (ngày/tháng/năm)"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */
 *
/**
 * @api {POST} ngaynghi/sua 1.4. Sửa Ngày Nghỉ
 * @apiVersion 0.1.0
 * @apiName Sửa Ngày Nghỉ
 * @apiGroup Ngày Nghỉ
 * @apiDescription Dùng để Sửa Ngày Nghỉ Mới<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 * <!-- <button type="button" class="btn btn-info">Giáo Viên</button> -->
 * </div><br>
 * +Cần truyền đầy đủ các dữ liệu cũ<br>
 * +Hiện chưa hỗ trợ cập nhật tình trạng khi tình trang = 2<br>
 *
 *
 * @apiSampleRequest ngaynghi/them
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"1",
 *     "ngay_cu" : "01-07-2020",
 *     "ma_giao_vien_cu" : "10",
 *     "ma_ca_cu" : "3",
 *     "tinh_trang" :"2"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ngay_cu Ngày cũ.
 * @apiParam {String} ma_giao_vien_cu Giáo Viên cũ.
 * @apiParam {String} ngay Ngày mới.
 * @apiParam {String} ma_ca Ca mới.
 * @apiParam {String} tinh_trang Tình trạng mới.
 * @apiParam {String} ma_giao_vien Giáo Viên Mới.
 *
 * @apiSuccess {String} data Dữ liệu Môn.
 *
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Cập nhật thành công",
 *     "data": []
 * }
 *
 * @apiErrorExample Không Thành Công:
 * HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "ngay": "Ngày không hợp lệ (ngày/tháng/năm)"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */
 *
/**
 * @api {POST} ngaynghi/kiemtra 1.5. Kiểm tra thông tin hợp lệ
 * @apiVersion 0.1.0
 * @apiName Kiểm Tra
 * @apiGroup Ngày Nghỉ
 * @apiDescription Dùng để Kiểm tra thông tin hợp lệ<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *         +Có thể truyền 1 hay nhiều yếu tố<br>
 *         +Sẽ chỉ trả về lỗi của yếu tố đầu tiên<br>
 *         +Nếu trả về hợp lệ là tất cả đều hợp lệ<br>
 *
 * @apiSampleRequest cauhinh/kiemtra
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"1",
 *     "ngay_cu" : "01-07-202đ0",
 *     "ma_giao_vien_cu" : "1d0",
 *     "ma_ca_cu" : "d3",
 *     "tinh_trang" :"2d"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ngay_cu Ngày cũ.
 * @apiParam {String} ma_giao_vien_cu Giáo Viên cũ.
 * @apiParam {String} ngay Ngày mới.
 * @apiParam {String} ma_ca Ca mới.
 * @apiParam {String} tinh_trang Tình trạng mới.
 * @apiParam {String} ma_giao_vien Giáo Viên Mới.
 * .
 * @apiSuccess {String} data Kết quả.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "",
 *     "data": []
 * }
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "ngay_cu": "Ngày cũ không hợp lệ",
 *         "ma_ca_cu": "Ca cũ không tồn tại",
 *         "tinh_trang": "Tình trạng không hợp lệ"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */
 *