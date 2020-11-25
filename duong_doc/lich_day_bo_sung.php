 */**
 * @api {POST} lichdaybosung 1.1. Hiển thị tất cả các Lịch Dạy Bổ Sung
 * @apiVersion 0.1.0
 * @apiName Hiện thị thông tin Lịch Dạy Bổ Sung
 * @apiGroup Lịch Dạy Bổ Sung
 * @apiDescription Dùng để hiện thị thông tin Lịch Dạy Bổ Sung<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Chỉ giáo vụ mới được phép xem lịch của bất cứ giáo viên nào.<br>
 *     +Nếu là giáo viên sẽ tự đồng lấy theo Giáo Viên đó.<br>
 *     +Có thể truyền vào tình trạng nếu không truyền sẽ tự lấy tình trang = 1.<br>
 *     +Sẽ lấy ra Lịch từ >= ngày hôm nay, nếu truyền vào ngày sẽ lấy lịch của ngày đó.<br>
 *     +Có thể truyền vào mã lịch dạy bổ sung sẽ lấy theo mã đó.<br>
 *
 * @apiSampleRequest lichdaybosung
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ma_giao_vien": 6
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_lich_day_bo_sung Mã lịch dạy bổ sung.
 * @apiParam {String} tinh_trang Tình Trạng.
 * @apiParam {String} ma_giao_vien Mã Giáo Viên.
 * @apiParam {String} ngay Ngày cần lấy.
 *
 * @apiSuccess {String} data Dữ liệu của Tầng.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": [
 *         {
 *             "ma_lich_day_bo_sung": 2,
 *             "ngay": "2020-08-25",
 *             "ma_lop": "BIT01K10",
 *             "nguoi_dung": {
 *                 "ma_nguoi_dung": 6,
 *                 "ho_ten": "Lê Thị Hương Liên",
 *                 "tai_khoan": "yuki.lien85",
 *                 "email": "yuki.lien85@gmail.com",
 *                 "sdt": "0989186985"
 *             },
 *             "ma_mon_hoc": "BIT_ECOM1",
 *             "ca": {
 *                 "ma_ca": 2,
 *                 "gio_bat_dau": "08:00:00",
 *                 "gio_ket_thuc": "10:00:00"
 *             },
 *             "phong": {
 *                 "ma_phong": 5,
 *                 "ten_phong": "Lab 5",
 *                 "so_cho_ngoi": 35,
 *                 "ma_tang": 4,
 *                 "ma_tinh_trang": 1,
 *                 "ghi_chu": ""
 *             },
 *             "ghi_chu": "",
 *             "tinh_trang": 1,
 *             "ten_tinh_trang": "Hoạt Động"
 *         }
 *     ]
 * }
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "ma_giao_vien": "Giáo viên không tồn tại",
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
 */**
 * @api {POST} lichdaybosung/dexuat 1.2. Đề Xuất Lịch Dạy Bổ Sung
 * @apiVersion 0.1.0
 * @apiName Đề Xuất Lịch Dạy Bổ Sung
 * @apiGroup Lịch Dạy Bổ Sung
 * @apiDescription Dùng để đề xuất Lịch Dạy Bổ Sung<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 * <button type="button" class="btn btn-info">Giáo Viên</button>
 * </div><br>
 * +Mã giáo viên,mã lớp,mã môn học là nhưng yếu tố bắt buộc phải có.<br>
 * +Ngày truyền vào chỉ có thể truyền ngày hôm nay đến tương lai.<br>
 * +Có thể không truyền số giờ sẽ tự lấy = 2.<br>
 * +Có thể không truyền số ngày sẽ tự lấy = 7.<br>
 * +Có thể không truyền ngày sẽ tự lấy ngày hôm nay.<br>
 * +Nếu người đó là giáo viên sẽ tự lấy mã giáo viên của người dùng đó.<br>
 * +Giáo vụ mới có thể xem đề xuất của tất cả giáo viên.<br>
 *
 * @apiSampleRequest lichdaybosung/dexuat
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ma_giao_vien": 6,
 *     "so_gio": 4,
 *     "ma_lop": "BKD01K10",
 *     "so_ngay": 1,
 *     "ma_mon_hoc": "BKA_ESE"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_giao_vien Mã Giáo Viên.
 * @apiParam {String} so_gio Số giờ kiểm tra 2 hoặc 4.
 * @apiParam {String} ma_lop Mã Lớp .
 * @apiParam {String} so_ngay Số ngày kiểm tra.
 * @apiParam {String} ma_mon_hoc Mã môn học cần kiểm tra.
 * @apiParam {String} ngay Ngày bắt đầu kiểm tra.
 *
 * @apiSuccess {String} data Dữ liệu Lịch Dạy Bổ Sung.
 *
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": {
 *         "2020-08-22": [
 *             {
 *                 "thu": 7,
 *                 "ma_phong": "3",
 *                 "ma_ca": 4,
 *                 "gio_bat_dau": "08:00:00",
 *                 "gio_ket_thuc": "12:00:00",
 *                 "ten_phong": "Lab 202",
 *                 "so_cho_ngoi": 40
 *             },
 *             {
 *                 "thu": 7,
 *                 "ma_phong": "3",
 *                 "ma_ca": 7,
 *                 "gio_bat_dau": "13:30:00",
 *                 "gio_ket_thuc": "17:30:00",
 *                 "ten_phong": "Lab 202",
 *                 "so_cho_ngoi": 40
 *             },
 *             {
 *                 "thu": 7,
 *                 "ma_phong": "4",
 *                 "ma_ca": 4,
 *                 "gio_bat_dau": "08:00:00",
 *                 "gio_ket_thuc": "12:00:00",
 *                 "ten_phong": "Lab 203",
 *                 "so_cho_ngoi": 50
 *             },
 *             {
 *                 "thu": 7,
 *                 "ma_phong": "4",
 *                 "ma_ca": 7,
 *                 "gio_bat_dau": "13:30:00",
 *                 "gio_ket_thuc": "17:30:00",
 *                 "ten_phong": "Lab 203",
 *                 "so_cho_ngoi": 50
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
 *         "ma_lop": "Lớp không tồn tại",
 *         "ma_mon_hoc": "Môn học không tồn tại",
 *         "so_gio": "Số giờ học chỉ có thể là 2 hoặc 4",
 *         "so_ngay": "Số ngày chỉ từ 1 đến 29"
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
 */**
 * @api {POST} lichdaybosung/them 1.3. Thêm Lịch Dạy Bổ Sung
 * @apiVersion 0.1.0
 * @apiName Thêm Lịch Dạy Bổ Sung
 * @apiGroup Lịch Dạy Bổ Sung
 * @apiDescription Dùng để thêm Lịch Dạy Bổ Sung<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 * <!-- <button type="button" class="btn btn-info">Giáo Viên</button> -->
 * </div><br>
 * +<br>
 * +Cần truyển đủ các yếu tố để có thể thêm Lịch Dạy Bổ Sung.<br>
 * +Ghi chú có thể truyền hoặc không.<br>
 * +Tình trạng tự lấy = 1.<br>
 * +Nếu thêm lịch nhưng lịch đã tồn tại nhưng tình trạng khác thì sẽ được cập nhật lại thay vì tạo mới.<br>
 *
 *
 *
 * @apiSampleRequest lichdaybosung/them
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ma_giao_vien": 6,
 *     "ma_lop": "BKD01K10",
 *     "ma_mon_hoc": "BKA_ESE",
 *     "ngay": "22-08-2020",
 *     "ma_phong": 3,
 *     "ma_ca": 4
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_giao_vien Mã Giáo Viên.
 * @apiParam {String} ma_lop Mã Lớp.
 * @apiParam {String} ma_mon_hoc Mã Môn Học.
 * @apiParam {String} ngay Ngày Lịch Học Bổ Sung.
 * @apiParam {String} ma_phong Mã Phòng.
 * @apiParam {String} ma_ca Mã Ca.
 * @apiParam {String} ghi_chu Ghi Chú.
 * @apiParam {String} tinh_trang Tình Trạng.
 *
 * @apiSuccess {String} data Dữ liệu Môn.
 *
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Tạo thành công",
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
 *         "ngay": "Ngày không hợp lệ (ngày/tháng/năm)",
 *         "ma_lop": "Lớp không tồn tại",
 *         "ma_mon_hoc": "Môn học không tồn tại"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Dữ liệu bạn nhập không hợp lệ,không có bất kì đề xuất nào cả",
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */
 */**
 * @api {POST} lichdaybosung/xoa 1.3. Xóa Lịch Dạy Bổ Sung
 * @apiVersion 0.1.0
 * @apiName Xóa Lịch Dạy Bổ Sung
 * @apiGroup Lịch Dạy Bổ Sung
 * @apiDescription Dùng để Xóa Lịch Dạy Bổ Sung<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 * <!-- <button type="button" class="btn btn-info">Giáo Viên</button> -->
 * </div><br>
 * +Chỉ xóa được lịch ở hôm nay hoặc tương lai.<br>
 *
 *
 *
 * @apiSampleRequest lichdaybosung/xoa
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ma_lich_day_bo_sung": 6
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_lich_day_bo_sung Mã Lịch Dạy Bổ Sung.
 *
 * @apiSuccess {String} data Dữ liệu Môn.
 *
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Xóa thành công",
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
 *         "ma_lich_day_bo_sung": "Lịch dạy bổ sung không tồn tại"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không thể xóa lịch dạy bổ sung trong quá khứ",
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */
 */**
 * @api {POST} lichdaybosung/kiemtra 1.4. Kiểm tra thông tin hợp lệ
 * @apiVersion 0.1.0
 * @apiName Kiểm Tra
 * @apiGroup Lịch Dạy Bổ Sung
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
 * @apiSampleRequest lichdaybosung/kiemtra
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ma_giao_vien": "y",
 *     "ma_lop": "BKdD01K10",
 *     "ma_mon_hoc": "BKA_dESE",
 *     "ngay": "22-08-20d20",
 *     "ma_phong": "d",
 *     "ma_ca": "d"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_giao_vien Mã Giáo Viên.
 * @apiParam {String} ma_lop Mã Lớp.
 * @apiParam {String} ma_mon_hoc Mã Môn Học.
 * @apiParam {String} ngay Ngày Lịch Học Bổ Sung.
 * @apiParam {String} ma_phong Mã Phòng.
 * @apiParam {String} ma_ca Mã Ca.
 * @apiParam {String} ghi_chu Ghi Chú.
 * @apiParam {String} tinh_trang Tình Trạng.
 * @apiParam {String} ma_lich_day_bo_sung Mã Lịch Dạy Bổ Sung.
 * @apiParam {String} so_gio Số Giờ.
 * @apiParam {String} so_ngay Số Ngày.
 *
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
 *         "ngay": "Ngày không hợp lệ (ngày/tháng/năm)",
 *         "ma_ca": "Ca không tồn tại",
 *         "ma_phong": "Phòng không tồn tại",
 *         "ma_giao_vien": "Giáo viên không tồn tại",
 *         "ma_lop": "Lớp không tồn tại",
 *         "ma_mon_hoc": "Môn học không tồn tại"
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