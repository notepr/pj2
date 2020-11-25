/**
 * @api {POST} phancongchitiet 1.1. Hiển thị Phân Công Chi Tiết
 * @apiVersion 0.1.0
 * @apiName Hiện thị thông tin Phân Công Chi Tiết
 * @apiGroup Phân Công Chi Tiết
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
 * @apiSampleRequest phancongchitiet
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
 * @api {POST} phancongchitiet/dexuat 1.2. Hiển thị Đề Xuất Phù Hợp
 * @apiVersion 0.1.0
 * @apiName Hiển thị Đề Xuất Phù Hợp
 * @apiGroup Phân Công Chi Tiết
 * @apiDescription Dùng để Hiển thị Đề Xuất Phù Hợp<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 *      <!-- <button type="button" class="btn btn-info">Giáo Viên</button> -->
 *  </div><br>
 *     +Đây là chức năng đề xuất ra các lịch Phân công chi tiết phù hợp.<br>
 *     +Cần có mã phân công để xử lý.<br>
 *     +Nếu mã phân công có ma_nguoi_dung Null hoặc tinh_trang khác 1 sẽ từ chối tìm đề xuất.<br>
 *     +Sẽ tự động tìm phòng học học được môn đó,Tự lấy số sinh viên để học được theo lớp.<br>
 *     +Sẽ tự động bỏ qua các tòa tầng phong có tình trạng Đóng.<br>
 *     +Truyền vào số giờ thể hiện học mấy giờ (4 hoặc 2) nếu khác 4 tự quy ước = 2.<br>
 *
 * @apiSampleRequest phancongchitiet/dexuat
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"keyapi",
 *     "ma_phan_cong" : "425",
 *     "so_gio":"2"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_phan_cong Mã phân công.
 * @apiParam {String} so_gio Số giờ.
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
 *             "ma_phong": 3,
 *             "thu": 3,
 *             "ma_ca": 4,
 *             "gio_bat_dau": "08:00:00",
 *             "gio_ket_thuc": "12:00:00",
 *             "ten_phong": "Lab 202",
 *             "so_cho_ngoi": 40,
 *             "ma_tang": 4,
 *             "ten_tang": "Tầng 4",
 *             "ma_toa": 1,
 *             "ten_toa": "Tòa 1"
 *         },
 *         {
 *             "ma_phong": 3,
 *             "thu": 7,
 *             "ma_ca": 4,
 *             "gio_bat_dau": "08:00:00",
 *             "gio_ket_thuc": "12:00:00",
 *             "ten_phong": "Lab 202",
 *             "so_cho_ngoi": 40,
 *             "ma_tang": 4,
 *             "ten_tang": "Tầng 4",
 *             "ma_toa": 1,
 *             "ten_toa": "Tòa 1"
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
 *     "message": "Không có lịch trống phù hợp cho lựa chọn của bạn !",
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
/**
 * @api {POST} phancongchitiet/tao 1.3. Thêm Phân Công Chi Tiết
 * @apiVersion 0.1.0
 * @apiName Thêm Phân Công Chi Tiết
 * @apiGroup Phân Công Chi Tiết
 * @apiDescription Dùng để Thêm Phân Công Chi Tiết<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 *      <!-- <button type="button" class="btn btn-info">Giáo Viên</button> -->
 *  </div><br>
 *     +Đây là chức năng thêm phân công chi tiết.<br>
 *     +Phân công chi tiết được thêm phải tồn tại trong đề xuất bên trên.<br>
 *     +Phân công chi tiết truyển vào phải đủ yếu tố nếu không sẽ không được thêm.<br>
 *
 *
 * @apiSampleRequest phancongchitiet/tao
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"keyapi",
 *     "ma_phan_cong" : "425",
 *     "so_gio":"2",
 *     "phan_cong_chi_tiet" : [
 *         {
 *             "ma_phong" : 3,
 *             "thu" : 2,
 *             "ma_ca" : 5
 *         },
 *         {
 *             "ma_phong" : 3,
 *             "thu" : 3,
 *             "ma_ca" : 6
 *         }
 *     ]
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_phan_cong Mã phân công.
 * @apiParam {String} so_gio Số giờ.
 * @apiParam {String} phan_cong_chi_tiet Hãy truyền dạng mảng kể cả với một phần tử.
 *
 * @apiSuccess {String} data Dữ liệu của Tầng.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Tạo thành công",
 *     "data": [
 *         {
 *             "ma_phong": 3,
 *             "thu": 2,
 *             "ma_ca": 5,
 *             "ma_phan_cong": "425"
 *         },
 *         {
 *             "ma_phong": 3,
 *             "thu": 3,
 *             "ma_ca": 6,
 *             "ma_phan_cong": "425"
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
 *         "phan_cong_chi_tiet": "Bạn hãy chọn phân công theo dữ liệu được đề xuất ! "
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
 * @api {POST} phancongchitiet/xoa 1.3. Xóa Phân Công Chi Tiết
 * @apiVersion 0.1.0
 * @apiName Xóa Phân Công Chi Tiết
 * @apiGroup Phân Công Chi Tiết
 * @apiDescription Dùng để Xóa Phân Công Chi Tiết<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 *      <!-- <button type="button" class="btn btn-info">Giáo Viên</button> -->
 *  </div><br>
 *     +Đây là chức năng xóa phân công chi tiết.<br>
 *     +Khi xóa bắt buộc cần có ma_phan_cong.<br>
 *     +Các yếu tố ma_ca,thu,ma_phong có thể truyền vào hoặc không.<br>
 *
 *
 * @apiSampleRequest phancongchitiet/xoa
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"1",
 *     "ma_phan_cong" : "425",
 *     "thu" : 2,
 *     "ma_ca" : 3,
 *     "ma_phong" : 2
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_phan_cong Mã phân công.
 * @apiParam {String} thu Thứ của phân công.
 * @apiParam {String} ma_ca Ca phân công.
 * @apiParam {String} ma_phong Phong phân công.
 *
 * @apiSuccess {String} data Dữ liệu của Tầng.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Xóa thành công",
 *     "data": []
 * }
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": "Xóa thất bại hay kiểm tra lại dữ liệu",
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
 * @api {POST} phancongchitiet/kiemtra 1.4. Kiểm tra thông tin hợp lệ
 * @apiVersion 0.1.0
 * @apiName Kiểm Tra
 * @apiGroup Phân Công Chi Tiết
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
 * @apiSampleRequest phancongchitiet/kiemtra
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"1",
 *     "ma_phan_cong" : "1000",
 *     "thu" : 10,
 *     "ma_ca" : 10,
 *     "ma_phong" : 10
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
 *         "ma_phan_cong": "Phân công không tồn tại",
 *         "thu": "Thứ không hợp lệ",
 *         "ma_ca": "Ca học không tồn tại",
 *         "ma_phong": "Phòng học không tồn tại"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */