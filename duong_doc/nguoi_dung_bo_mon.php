 */**
 * @api {POST} nguoidungbomon 1.1. Hiển thị tông tin các Người Dùng Bộ Môn hoặc một Người Dùng Bộ Môn
 * @apiVersion 0.1.0
 * @apiName Hiện thị thông tin những môn mà một Người Dùng có thể dạy được
 * @apiGroup Người Dùng Bộ Môn
 * @apiDescription Hiện thị thông tin những môn mà một Người Dùng có thể dạy được<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *  <!--     <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Cần lấy mã giáo viên nào có thể truyền mã giáo viên đó.<br>
 *     +Cần lấy nhiều giáo viên hãy truyền nhiều giáo viên.<br>
 *     +Giáo Viên và Môn bắt buộc phải dạng mảng.<br>
 *     +Nếu lấy tất cả thì không truyền gì cả.<br>
 *     +Nếu là giáo viên chỉ có thể lấy thông tin của chính mình.<br>
 *
 * @apiSampleRequest nguoidungbomon
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ma_giao_vien": [25]
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_giao_vien Mã giáo viên cẩn kiểm tra dạng ARRAY.
 *
 *
 * @apiSuccess {String} data Dữ liệu của Người Dùng Bộ Môn.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": [
 *         {
 *             "ma_nguoi_dung": 25,
 *             "ho_ten": "Lê Quang Thắng",
 *             "email": "thang.lequang@hust.edu.vn",
 *             "so_mon_day_duoc": 2,
 *             "nguoi_dung_bo_mon": [
 *                 {
 *                     "ma_nguoi_dung": 25,
 *                     "ma_mon_hoc": "BKA_HAT_CTMT",
 *                     "mon_hoc": {
 *                         "ma_mon_hoc": "BKA_HAT_CTMT",
 *                         "ten_mon_tieng_viet": "Cấu trúc máy tính",
 *                         "ten_mon_tieng_anh": "Cấu trúc máy tính"
 *                     }
 *                 },
 *                 {
 *                     "ma_nguoi_dung": 25,
 *                     "ma_mon_hoc": "BKA_HAT_KTDT",
 *                     "mon_hoc": {
 *                         "ma_mon_hoc": "BKA_HAT_KTDT",
 *                         "ten_mon_tieng_viet": "Kỹ thuật điện tử",
 *                         "ten_mon_tieng_anh": "Kỹ thuật điện tử"
 *                     }
 *                 }
 *             ]
 *         }
 *     ]
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
 *         "ma_giao_vien": "Giáo viên phải là dạng mảng"
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
 *
 */**
 * @api {POST} nguoidungbomon/thongke 1.2. Thống kê những môn dạy của các giáo viên
 * @apiVersion 0.1.0
 * @apiName Đếm số môn
 * @apiGroup Người Dùng Bộ Môn
 * @apiDescription Dùng để đếm số môn mà người dùng dạy được<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!--
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *      -->
 *  </div><br>
 *     +Cần lấy mã giáo viên nào có thể truyền mã giáo viên đó.<br>
 *     +Cần lấy nhiều giáo viên hãy truyền nhiều giáo viên.<br>
 *     +Giáo Viên và Môn bắt buộc phải dạng mảng.<br>
 *     +Lấy tất cả thì không cần truyền gì cả.<br>
 *
 * @apiSampleRequest nguoidungbomon/thongke
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ma_giao_vien": [6,25,30]
 * }
 *
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_giao_vien Mã giáo viên cẩn kiểm tra dạng ARRAY.
 * .
 * @apiSuccess {String} data Dữ liệu của Người Dùng Bộ Môn.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": [
 *         {
 *             "ma_nguoi_dung": 6,
 *             "ho_ten": "Lê Thị Hương Liên",
 *             "email": "yuki.lien85@gmail.com",
 *             "so_mon_day_duoc": 5
 *         },
 *         {
 *             "ma_nguoi_dung": 25,
 *             "ho_ten": "Lê Quang Thắng",
 *             "email": "thang.lequang@hust.edu.vn",
 *             "so_mon_day_duoc": 2
 *         },
 *         {
 *             "ma_nguoi_dung": 30,
 *             "ho_ten": "Thương Thương Trần",
 *             "email": "thuongtt@bkacad.edu.vn",
 *             "so_mon_day_duoc": 0
 *         }
 *     ]
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
 */**
 * @api {POST} nguoidungbomon/themhoacsua 1.3. Cập Nhật Hoặc Lưu Môn Mới Dạy Được Của Người Dùng
 * @apiVersion 0.1.0
 * @apiName Cập Nhật Môn Giáo Viên có thể dạy
 * @apiGroup Người Dùng Bộ Môn
 * @apiDescription Dùng để cập nhật thông tin Người Dùng Bộ Môn<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!--
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *      -->
 *  </div><br>
 *     +Cần mã giáo viên và mã môn để hoạt động.<br>
 *     +Giáo Viên đó có phân công cho môn và phân công còn hiệu lực thì sẽ không được thay đổi hủy dạy môn đó.<br>
 *
 * @apiSampleRequest nguoidungbomon/themhoacsua
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ma_giao_vien": [6,6],
 *     "ma_mon_hoc":["BKA_NA4","BKA_IOT","BKA_HAT_AV1","BKA_ESE"]
 * }
 *
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_giao_vien Mã giáo viên cẩn kiểm tra dạng ARRAY.
 * @apiParam {String} ma_mon_hoc Mã môn học cẩn kiểm tra dạng ARRAY.
 *
 * @apiSuccess {String} data Dữ liệu của Người Dùng Bộ Môn.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Cập nhật thành công , Các môn đang được phân công sẽ tự động được chọn",
 *     "data": {
 *         "create": [
 *             {
 *                 "ma_nguoi_dung": 6,
 *                 "ma_mon_hoc": "BKA_NA4"
 *             },
 *             {
 *                 "ma_nguoi_dung": 6,
 *                 "ma_mon_hoc": "BKA_IOT"
 *             }
 *         ],
 *         "exists": [
 *             {
 *                 "ma_nguoi_dung": 6,
 *                 "ma_mon_hoc": "BKA_ESE"
 *             },
 *             {
 *                 "ma_nguoi_dung": 6,
 *                 "ma_mon_hoc": "BKA_HAT_AV1"
 *             }
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
 *         "ma_giao_vien": "Giáo viên không tồn tại",
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
 *
 *
 */**
 * @api {POST} nguoidungbomon/kiemtra 1.4. Kiểm tra thông tin hợp lệ
 * @apiVersion 0.1.0
 * @apiName Kiểm Tra
 * @apiGroup Người Dùng Bộ Môn
 * @apiDescription Dùng để Kiểm tra thông tin hợp lệ<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!--
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *      -->
 *  </div><br>
 *         +Có thể truyền 1 hay nhiều yếu tố
 *         +Sẽ chỉ trả về lỗi của yếu tố đầu tiên
 *         +Nếu trả về hợp lệ là tất cả đều hợp lệ
 *
 * @apiSampleRequest nguoidungbomon/kiemtra
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ma_giao_vien": [6,699],
 *     "ma_mon_hoc":["BKA_NAs4","BKA_IOT","BKA_HAT_AV1","BKA_ESE"]
 * }
 *
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_giao_vien Mã giáo viên cẩn kiểm tra dạng ARRAY.
 * @apiParam {String} ma_mon_hoc Mã môn học cẩn kiểm tra dạng ARRAY.
 *
 *
 * @apiSuccess {String} data Dữ liệu của Người Dùng Bộ Môn.
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
 *         "ma_giao_vien": "Giáo viên không tồn tại",
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