/**
 * @api {POST} lichhoc/giaovien 1.1. Lịch Dạy Của Giáo Viên
 * @apiVersion 0.1.0
 * @apiName Hiện thị lịch dạy của Giáo Viên
 * @apiGroup Lịch Học
 * @apiDescription Hiện thị lịch dạy của Giáo Viên<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Cần lấy thôn tin của mã giáo viên nào truyền vào mã giáo viên đó.<br>
 *     +Có thể không truyền gì nếu lấy thông tin của chính mình<br>
 *     +ngay_nghi = true là nghỉ = false là lịch <br>
 *
 * @apiSampleRequest lichhoc/giaovien
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "1",
 *     "ma_giao_vien": 6
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_giao_vien mã của Giáo Viên.
 *
 * @apiSuccess {String} data Dữ liệu của Tầng.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": {
 *         "2020-07-11": [
 *             {
 *                 "ngay": "2020-07-11",
 *                 "gio_bat_dau": "13:30:00",
 *                 "gio_ket_thuc": "15:30:00",
 *                 "phong": null,
 *                 "ma_lop": "BKD01K10",
 *                 "ma_mon_hoc": "BKA_ESE",
 *                 "so_gio": "2.0000",
 *                 "nghi": false
 *             }
 *         ],
 *     }
 * }
 *
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "ma_giao_vien": "Người dùng không tồn tại"
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
 * @api {POST} lichhoc/dukienketthuc 1.2. Dự kiến kết thúc một Phân Công
 * @apiVersion 0.1.0
 * @apiName Dự Kiến Kết Thúc
 * @apiGroup Lịch Học
 * @apiDescription Dự kiến kết thúc một Phân Công<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *
 *  </div><br>
 *     +Nếu giáo vụ được kiểm tra ở tất cả các phân công chưa kết thúc<br>
 *     +Nếu giáo viên chỉ xem được phân công của chính mình<br>
 *     +ngay_nghi = true là nghỉ = false là lịch <br>
 *
 *
 * @apiSampleRequest lichhoc/dukienketthuc
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "1",
 *     "ma_phan_cong": 426
 * }
 * @apiParam {String} key Mã Key của người dùng.
 * @apiParam {String} ma_phan_cong Mã phân công.
 *
 * @apiSuccess {String} message Báo kết quả xử lý.
 * @apiSuccess {String} data Dữ liệu sau khi xử lý.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * có nhiều messgae : Đã hoàn thành lịch dạy vào ngày 20-08-2020 hoặc Dự kiến kết thúc vào ngày 01-09-2020 còn cả các message khác nữa
 * {
 *     "success": true,
 *     "message": "Dự kiến kết thúc vào ngày 01-09-2020",
 *     "data": {
 *         "ma_lop": "BKD01K10",
 *         "ma_mon_hoc": "BKA_WEB",
 *         "giao_vien": {
 *             "ma_nguoi_dung": 32,
 *             "ho_ten": "Nguyễn Nam Long",
 *             "tai_khoan": "long.nn",
 *             "email": "long.nn@bkacad.edu.vn",
 *             "sdt": "0378050602"
 *         },
 *         "lich_day": [
 *             {
 *                 "ngay": "2020-07-10",
 *                 "gio_bat_dau": "13:30:00",
 *                 "gio_ket_thuc": "15:30:00",
 *                 "phong": null
 *             },
 *         ]
 *     }
 * }
 *
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "ma_giao_vien": "Người dùng không tồn tại"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 *
 */
 *
/**
 * @api {POST} lichhoc/lichphong 1.3. Lấy ra lịch hoạt động của một phòng nào đó
 * @apiVersion 0.1.0
 * @apiName Lịch Hoạt Động Phòng
 * @apiGroup Lịch Học
 * @apiDescription Lịch Hoạt Động Phòng<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 *      <!-- <button type="button" class="btn btn-info">Giáo Viên</button> -->
 *  </div><br>
 *         +Cần truyền vào mã phòng<br>
 *         +Sẽ trả thêm ngày nghỉ nếu ngày đó cả trường nghỉ<br>
 *         +ngay_nghi = true là nghỉ = false là lịch <br>
 *
 * @apiSampleRequest lichhoc/lichphong
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "1",
 *     "ma_phong": 2
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_phong Ma Phòng.
 *
 * @apiSuccess {String} data Kết quả.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": {
 *         "2020-08-29": [
 *             {
 *                 "ngay": "2020-08-29",
 *                 "gio_bat_dau": "08:00:00",
 *                 "gio_ket_thuc": "10:00:00",
 *                 "ma_lop": "BIT01K10",
 *                 "ma_mon_hoc": "BIT_ECOM1",
 *                 "ma_nguoi_dung": 6,
 *                 "ho_ten": "Lê Thị Hương Liên",
 *                 "so_gio": "2.0000",
 *                 "hoat_dong": "Bất Thường",
 *                 "nghi": false
 *             }
 *         ],
 *     }
 * }
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "ma_phong": "Phòng không tồn tại"
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
 *  /**
 * @api {POST} lichhoc/lichtrong 1.4. Lấy Phòng Còn Trống
 * @apiVersion 0.1.0
 * @apiName Lấy Phòng Còn Trốngg
 * @apiGroup Lịch Học
 * @apiDescription Lấy Phòng Còn Trống<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 *      <!-- <button type="button" class="btn btn-info">Giáo Viên</button> -->
 *  </div><br>
 *         +Truyền vào số ngày xử lý,không truyền sẽ tự lấy = 7<br>
 *         +Truyền vào số giờ 2 hoặc 4 giờ<br>
 *         +Mã phòng không tìm kiếm <br>
 *
 * @apiSampleRequest lichhoc/lichtrong
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "1",
 *     "ma_phong": [5,3],
 *     "so_ngay":1,
 *     "so_gio":4
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_phong Ma Phòng.
 *
 * @apiSuccess {String} data Kết quả.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": {
 *         "2020-08-31": [
 *             {
 *                 "ngay": "2020-08-31",
 *                 "ma_phong": 1,
 *                 "ten_phong": "Kho",
 *                 "ma_ca": 7,
 *                 "gio_bat_dau": "13:30:00",
 *                 "gio_ket_thuc": "17:30:00"
 *             },
 *             {
 *                 "ngay": "2020-08-31",
 *                 "ma_phong": 4,
 *                 "ten_phong": "Lab 203",
 *                 "ma_ca": 7,
 *                 "gio_bat_dau": "13:30:00",
 *                 "gio_ket_thuc": "17:30:00"
 *             }
 *         ]
 *     }
 * }
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "ma_phong": "Phòng không tồn tại"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */