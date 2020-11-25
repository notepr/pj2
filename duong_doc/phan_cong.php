/**
 * @api {POST} phancong 1.1. Hiển thị tất cả các Phân Công
 * @apiVersion 0.1.0
 * @apiName Hiện thị thông tin Phân Công
 * @apiGroup Phân Công
 * @apiDescription Dùng để hiện thị thông tin Phân Công<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Chỉ giáo vụ mới được phép lấy mã phân công của bất cứ giáo viên nào.<br>
 *     +Nếu Giáo Vụ không truyền ma_giao_vien sẽ lấy tất cả.<br>
 *     +Nếu là Giáo Viên sẽ tự động lấy phân công theo mã Người Dùng của mình.<br>
 *     +Nếu có gửi ma_phan_cong sẽ lấy theo ma_phan_cong mà không xử lý ma_mon_hoc và ma_lop.<br>
 *     +Chỉ truyền ma_mon_hoc hoặc ma_lop sẽ lấy để tìm kiếm (có thể có 1,2 hoặc không có yếu tố nào).<br>
 *     +Nếu không có tình trạng sẽ tự động lấy tình trạng 0,1 nếu có sẽ tìm theo tinh_trang được truyền.<br>
 *     +Tự động sắp xếp kết quả theo tình trạng.<br>
 *
 * @apiSampleRequest phancong
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"keyapi",
 *     "ma_giao_vien":"10"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_mon_hoc Mã môn học.
 * @apiParam {String} ma_lop Mã lớp.
 * @apiParam {String} ma_phan_cong Mã phân công.
 * @apiParam {String} tinh_trang Mã tình trạng.
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
 *             "ma_phan_cong": 420,
 *             "ma_lop": "BKC12K9",
 *             "ma_mon_hoc": "BKA_HAT_CTMT",
 *             "ma_nguoi_dung": 10,
 *             "ma_tinh_trang": 0,
 *             "ten_tinh_trang": "Đang dạy"
 *         },
 *         {
 *             "ma_phan_cong": 586,
 *             "ma_lop": "BKG02K10N4",
 *             "ma_mon_hoc": "BKA_HAT_THCB",
 *             "ma_nguoi_dung": 10,
 *             "ma_tinh_trang": 0,
 *             "ten_tinh_trang": "Đang dạy"
 *         },
 *         {
 *             "ma_phan_cong": 587,
 *             "ma_lop": "BKG02K10N4",
 *             "ma_mon_hoc": "BKA_HAT_THVP",
 *             "ma_nguoi_dung": 10,
 *             "ma_tinh_trang": 0,
 *             "ten_tinh_trang": "Đang dạy"
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
/**
 * @api {POST} phancong/clone 1.2. Clone Mon Từ DTB VỀ Local
 * @apiVersion 0.1.0
 * @apiName CLone
 * @apiGroup Phân Công
 * @apiDescription Sử dụng để clone môn học<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!--
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *      -->
 *  </div><br>
 *     +Chỉ chạy một lần<br>
 *     +Clone nếu môn không tồn tại sẽ tạo ra môn đó<br>
 * @apiSampleRequest phancong/clone
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "key",
 * }
 * @apiParam {String} key Mã Key của người dùng.
 *
 * @apiSuccess {String} message Báo kết quả xử lý.
 * @apiSuccess {String} data Dữ liệu sau khi xử lý.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Đã tạo mới 2 bản ghi và Cập nhật 1 bản ghi",
 *     "data": {
 *         "create": [
 *             {
 *                 "tinh_trang": 2,
 *                 "ma_nguoi_dung": 33,
 *                 "ma_lop": "BIT02K10",
 *                 "ma_mon_hoc": "BIT_GE",
 *                 "ma_phan_cong": 713
 *             },
 *             {
 *                 "tinh_trang": 2,
 *                 "ma_nguoi_dung": 19,
 *                 "ma_lop": "BIT02K10",
 *                 "ma_mon_hoc": "BIT_PLD",
 *                 "ma_phan_cong": 714
 *             }
 *         ],
 *         "update": [
 *             {
 *                 "ma_lop": "BIT02K10",
 *                 "ma_mon_hoc": "BIT_WEB",
 *                 "changer": {
 *                     "ma_nguoi_dung": 19
 *                 }
 *             }
 *         ]
 *     }
 * }
 *
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */
 *
/**
 * @api {POST} phancong/kiemtra 1.3. Kiểm tra thông tin hợp lệ
 * @apiVersion 0.1.0
 * @apiName Kiểm Tra
 * @apiGroup Phân Công
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
 * @apiSampleRequest phancong/kiemtra
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"keyapi",
 *     "ma_giao_vien":"100",
 *     "tinh_trang": "5",
 *     "ma_mon_hoc":"csdcsd",
 *     "ma_lop":"Sdvsdvd"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_mon_hoc Mã môn học.
 * @apiParam {String} ma_lop Mã lớp.
 * @apiParam {String} ma_phan_cong Mã phân công.
 * @apiParam {String} tinh_trang Mã tình trạng.
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
 *         "ma_lop": "Lớp không tồn tại",
 *         "ma_mon_hoc": "Môn học không tồn tại",
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