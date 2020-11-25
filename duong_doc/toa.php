 * <?php
/**
 * @api {POST} toa/hienthicactoa 1.1. Hiển thị tông tin các tòa hoặc một tòa
 * @apiVersion 0.1.0
 * @apiName Show
 * @apiGroup Toa
 * @apiDescription Dùng để hiện thị thông tin tòa<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Cần lấy thông tin tòa nào truyền thông tin mã tòa đó<br>
 *     +Nếu lấy tất cả thì không truyền gì cả<br>
 *
 * @apiSampleRequest toa/hienthicactoa
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "1",
 *     "ma_toa":"2"
 * }
 * @apiParam {String} key Mã Key của Giáo Vụ.
 * @apiParam {String} ma_toa mã của tòa cần lấy.
 *
 * @apiSuccess {String} data Dữ liệu của Tòa.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": [
 *         {
 *             "ma_toa": 2,
 *             "ten_toa": "Tòa 2",
 *             "dia_chi": "D5 Trần Đại Nghĩa",
 *             "ma_tinh_trang": 1,
 *             "ten_tinh_trang": "Hoạt Động"
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
 *         "ma_toa": "Tòa không tồn tại"
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
 * @api {POST} toa/capnhat 1.2. Cập nhật thông tin cho một tòa
 * @apiVersion 0.1.0
 * @apiName Update
 * @apiGroup Toa
 * @apiDescription Dùng để cập nhật thông tin cho các tòa<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!--
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *      -->
 *  </div><br>
 * @apiSampleRequest toa/capnhat
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "apikey",
 *     "ma_toa":"2",
 *     "ten_toa" : "Ten toa moi",
 *     "dia_chi" : "dia chi moi",
 *     "ma_tinh_trang": 1
 * }
 *
 * @apiParam {String} key Mã Key của Giáo Vụ.
 * @apiParam {String} ten_toa từ 6-20 kí tự,kí tự bắt đầu phải là chữ (VD nếu Ă thì tính là 2 kí tự).
 * @apiParam {String} dia_chi từ 6-100 kí tự,kí tự bắt đầu phải là chữ (VD nếu Ă thì tính là 2 kí tự).
 * @apiParam {String} tinh_trang +Tình Trạng 1 hoặc 2.
 *
 * @apiSuccess {String} data Dữ liệu của Tòa sau khi chỉnh sửa.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Cập nhật thành công",
 *     "data": {
 *         "ma_toa": 2,
 *         "ten_toa": "Ten toa moi",
 *         "dia_chi": "dia chi moi",
 *         "ma_tinh_trang": 1,
 *         "ten_tinh_trang": "Hoạt Động"
 *     }
 * }
 *
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,dia_chi hay ten_toa không hợp lệ
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "ma_toa": "Tòa không tồn tại",
 *         "ten_toa": "Tên tòa chỉ từ 6-20 kí tự và không chứa kí tự đặc biệt",
 *         "dia_chi": "Địa chỉ chỉ từ 6-100 kí tự và không chứa kí tự đặc biệt",
 *         "ma_tinh_trang": "Tình trạng không tồn tại"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Cập nhật dữ liệu thất bại",
 *     "data": []
 * }
 */
 *
/**
 * @api {POST} toa/kiemtra 1.3. Kiểm tra thông tin hợp lệ
 * @apiVersion 0.1.0
 * @apiName Check
 * @apiGroup Toa
 * @apiDescription Dùng để Kiểm tra thông tin hợp lệ<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *         +Có thể truyền 1 hay nhiều yếu tố
 *         +Sẽ chỉ trả về lỗi của yếu tố đầu tiên
 *         +Nếu trả về hợp lệ là tất cả đều hợp lệ
 *
 * @apiSampleRequest toa/kiemtra
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "1",
 *     "ma_toa":"10",
 *     "ten_toa" : "Ten",
 *     "dia_chi" : "dia ",
 *     "ma_tinh_trang": 0
 * }
 *
 * @apiParam {String} key Mã Key của Giáo Vụ.
 * @apiParam {String} ten_toa từ 6-20 kí tự,kí tự bắt đầu phải là chữ (VD nếu Ă thì tính là 2 kí tự).
 * @apiParam {String} dia_chi từ 6-100 kí tự,kí tự bắt đầu phải là chữ (VD nếu Ă thì tính là 2 kí tự).
 * @apiParam {String} tinh_trang +Tình Trạng 0 hoặc 1.
 *
 * @apiSuccess {String} data Dữ liệu của Tòa sau khi chỉnh sửa.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "",
 *     "data": []
 * }
 *
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,dia_chi hay ten_toa không hợp lệ
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "ma_toa": "Tòa không tồn tại",
 *         "ten_toa": "Tên tòa chỉ từ 6-20 kí tự và không chứa kí tự đặc biệt",
 *         "dia_chi": "Địa chỉ chỉ từ 6-100 kí tự và không chứa kí tự đặc biệt",
 *         "ma_tinh_trang": "Tình trạng không tồn tại"
 *     },
 *     "data": []
 * }
 */