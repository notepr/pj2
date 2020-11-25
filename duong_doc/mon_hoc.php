/**
 * @api {POST} monhoc 1.1. Hiển thị tất cả các Môn Học
 * @apiVersion 0.1.0
 * @apiName Hiện thị thông tin Môn Học
 * @apiGroup Môn Học
 * @apiDescription Dùng để hiện thị thông tin Môn Học<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Cần lấy thông tin ca nào truyền thông tin mã Môn Học đó<br>
 *     +Nếu lấy tất cả thì không truyền gì cả<br>
 *
 * @apiSampleRequest monhoc
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"keyapi"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_mon_hoc mã của Môn học.
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
 *             "ma_mon_hoc": "BIT_ACC",
 *             "ten_mon_tieng_viet": "Kế toán doanh nghiệp",
 *             "ten_mon_tieng_anh": "Business Accounting"
 *         },
 *         {
 *             "ma_mon_hoc": "BIT_AP",
 *             "ten_mon_tieng_viet": "Lập trình nâng cao",
 *             "ten_mon_tieng_anh": "Advanced Programming"
 *         }
 *     ]
 * }
 *
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": {
 *         "ma_mon_hoc": "BIT_ACC",
 *         "ten_mon_tieng_viet": "Kế toán doanh nghiệp",
 *         "ten_mon_tieng_anh": "Business Accounting",
 *         "so_gio": "45",
 *         "ma_kieu_thi": 1
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
/**
 * @api {POST} monhoc/clone 1.2. Clone Mon Từ DTB VỀ Local
 * @apiVersion 0.1.0
 * @apiName CLone
 * @apiGroup Môn Học
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
 *     +Clone môn dựa vào mã môn nếu không có sẽ được tạo ra<br>
 * @apiSampleRequest monhoc/clone
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
 *                 "ten_mon_tieng_anh": "Digital Businesss and E-Commerce Management",
 *                 "ten_mon_tieng_viet": "Quản trị thương mại điện tử",
 *                 "so_gio": 45,
 *                 "ma_kieu_thi": 3,
 *                 "ma_mon_hoc": "0"
 *             },
 *             {
 *                 "ten_mon_tieng_anh": "Graduation Dissertation",
 *                 "ten_mon_tieng_viet": "Luận văn tốt nghiệp",
 *                 "so_gio": 100,
 *                 "ma_kieu_thi": 3,
 *                 "ma_mon_hoc": "0"
 *             }
 *         ],
 *         "update": [
 *             {
 *                 "ma_mon_hoc": "BIT_LAW",
 *                 "changer": {
 *                     "ten_mon_tieng_anh": "Business Law",
 *                     "ten_mon_tieng_viet": "Luật kinh tế"
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
 * @api {POST} monhoc/kiemtra 1.3. Kiểm tra thông tin hợp lệ
 * @apiVersion 0.1.0
 * @apiName Kiểm Tra
 * @apiGroup Môn Học
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
 *     "ma_mon_hoc": "BIT_AClC"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_mon_hoc Ma mon.
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