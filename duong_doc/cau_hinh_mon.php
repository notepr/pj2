/**
 * @api {POST} cauhinhmon 1.1. Hiển thị tất cả các Cấu Hình Đã Có Môn
 * @apiVersion 0.1.0
 * @apiName Cấu Hình Đã Có Môn
 * @apiGroup Cấu Hình Môn
 * @apiDescription Dùng để hiện thị Cấu Hình có Môn<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 * <button type="button" class="btn btn-info">Giáo Viên</button>
 * </div><br>
 *
 * @apiSampleRequest cauhinhmon
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" : "keyapi"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 *
 * @apiSuccess {String} data Dữ liệu Cấu Hình.
 *
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": [
 *         {
 *             "ma_cau_hinh": 1,
 *             "mo_ta": "CPU:I9-9900XEMain:Z350Ram:8Gb"
 *         },
 *         {
 *             "ma_cau_hinh": 2,
 *             "mo_ta": "CPU:G-9000K RAM:16 MAIN:Z100X O_CUNG:250GB HDD 120GB SSD VGA:1000XXXXX"
 *         }
 *     ]
 * }
 *
 * @apiErrorExample Không Thành Công:
 * HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 *
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */
 *
/**
 * @api {POST} cauhinhmon/mon 1.2. Hiển thị các môn có thể học được theo cấu hình
 * @apiVersion 0.1.0
 * @apiName Môn của cấu hình
 * @apiGroup Cấu Hình Môn
 * @apiDescription Dùng để trả về môn của Cấu Hình<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 * <button type="button" class="btn btn-info">Giáo Viên</button>
 * </div><br>
 *
 * @apiSampleRequest cauhinhmon/mon
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"keyapi",
 *     "ma_cau_hinh" : "1"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_cau_hinh Mã cấu hình cần lấy danh sách môn.
 *
 * @apiSuccess {String} data Dữ liệu Môn.
 *
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": {
 *         "cau_hinh": {
 *             "ma_cau_hinh": 2,
 *             "mo_ta": "CPU:G-9000K RAM:16 MAIN:Z100X O_CUNG:250GB HDD 120GB SSD VGA:1000XXXXX",
 *             "ma_loai": 1,
 *             "ten_loai": "case",
 *             "mo_ta_loai": "case"
 *         },
 *         "list_mon": [
 *             {
 *                 "ma_cau_hinh": 2,
 *                 "ma_mon_hoc": "BIT_AP",
 *                 "ten_mon_tieng_viet": "Lập trình nâng cao",
 *                 "ten_mon_tieng_anh": "Advanced Programming"
 *             },
 *             {
 *                 "ma_cau_hinh": 2,
 *                 "ma_mon_hoc": "BIT_DB2",
 *                 "ten_mon_tieng_viet": "Nguyên lý cơ sở dữ liệu nâng cao",
 *                 "ten_mon_tieng_anh": "Advanced Database Principle"
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
 *         "ma_cau_hinh": "Cấu hình không phải là Case"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Chưa có môn học được cho cấu hình bạn chọn",
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
 * @api {POST} cauhinhmon/capnhat 1.3. Thêm Cấu Hình Và Môn Học Được Mới Hoặc Cập Nhật
 * @apiVersion 0.1.0
 * @apiName Cập Nhật Hoặc Thêm
 * @apiGroup Cấu Hình Môn
 * @apiDescription Dùng để Thêm Cấu Hình Môn Mới<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 * <!-- <button type="button" class="btn btn-info">Giáo Viên</button> -->
 * </div><br>
 *
 * @apiSampleRequest cauhinhmon/capnhat
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"apikey",
 *     "ma_cau_hinh": "2",
 *     "ma_mon_hoc": ["BIT_ACC","BIT_AP","BIT_CMS"]
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
 *         "ma_mon_hoc": "Môn học không tồn tại",
 *         "ma_cau_hinh": "Cấu hình không phải là Case"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Chưa có môn học được cho cấu hình bạn chọn",
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
 * @api {POST} cauhinhmon/kiemtra 1.4. Kiểm tra thông tin hợp lệ
 * @apiVersion 0.1.0
 * @apiName Kiểm Tra
 * @apiGroup Cấu Hình Môn
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
 *     "ma_cau_hinh": "6",
 *     "ma_mon_hoc": ["BIT_AClC"]
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_cau_hinh Mã cấu hình.
 * @apiParam {String} ma_mon_hoc Là mã môn truyền dạng mảng nếu truyền thường chỉ thu một môn.
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
 *         "ma_mon_hoc": "Môn học không tồn tại",
 *         "ma_cau_hinh": "Cấu hình không phải là Case"
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