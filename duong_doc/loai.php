 * <?php
/**
 * @api {POST} loai 1.1. Hiển thị tất cả các Loại
 * @apiVersion 0.1.0
 * @apiName Hiện thị thông tin Loại
 * @apiGroup Loai
 * @apiDescription Dùng để hiện thị thông tin Loại<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Cần lấy thông tin Loại nào truyền thông tin mã loại đó<br>
 *     +Nếu lấy tất cả thì không truyền gì cả<br>
 *
 * @apiSampleRequest loai
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" : "1",
 *     "ma_loai" : "2"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_loai mã của Loại.
 *
 * @apiSuccess {String} data Dữ liệu của Tầng.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "",
 *     "data": [
 *         {
 *             "ma_loai": 2,
 *             "ten_loai": "ma_hinh",
 *             "mo_ta": "Màn Hình"
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
 *         "ma_loai": "Loại không tồn tại"
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
 * @api {POST} loai/sua 1.2. Cập Nhật Thông Tin Của Một Loại
 * @apiVersion 0.1.0
 * @apiName Cập Nhật Loại
 * @apiGroup Loai
 * @apiDescription Dùng để cập nhật thông tin Loại<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!--
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *      -->
 *  </div><br>
 *     +Cần có mã loại<br>
 *     +Chỉnh sửa thông tin nào truyền thông tin đó<br>
 *
 * @apiSampleRequest loai/sua
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" : "keyapi",
 *     "ma_loai" : "2",
 *     "ten_loai" :"update_ten_loai",
 *     "mo_ta":"Update cho loại"
 * }
 * @apiParam {String} key Mã Key của Giáo Vụ.
 * @apiParam {String} ma_loai mã của Loại.
 * @apiParam {String} ten_loai Tên Loại thay đổi.
 * @apiParam {String} mo_ta mô tả của Loại thay đổi.
 * .
 * @apiSuccess {String} data Dữ liệu của Tầng.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Cập nhật thành công",
 *     "data": {
 *         "ma_loai": 2,
 *         "ten_loai": "update_ten_loai",
 *         "mo_ta": "Update cho loại"
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
 *         "mo_ta": "Mô tả loại không hợp lệ"
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
 * @api {POST} loai/them 1.3. Tạo ra một Loại mới
 * @apiVersion 0.1.0
 * @apiName Tạo Loại
 * @apiGroup Loai
 * @apiDescription Dùng để tạo ra một Loại<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!--
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *      -->
 *  </div><br>
 *     +Cần gửi đủ tên loại,mô tả.<br>
 *     +Nếu mo_ta không tồn tại sẽ auto null<br>
 *
 * @apiSampleRequest loai/them
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" : "1",
 *     "ten_loai" :"demo_create_loaic",
 *     "mo_ta":"mo ta loai"
 * }
 * @apiParam {String} key Mã Key của Giáo Vụ.
 * @apiParam {String} ten_loai Tên Loại.
 * @apiParam {String} mo_ta mô tả của Loại.
 * .
 * @apiSuccess {String} data Dữ liệu của Tầng.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Tạo thành công",
 *     "data": {
 *         "ma_loai": 6,
 *         "ten_loai": "demo_create_loaic",
 *         "mo_ta": "mo ta loai"
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
 *         "mo_ta": "Mô tả loại không hợp lệ"
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
 * @api {POST} loai/kiemtra 1.4. Kiểm tra thông tin hợp lệ
 * @apiVersion 0.1.0
 * @apiName Kiểm Tra
 * @apiGroup Loai
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
 * @apiSampleRequest loai/kiemtra
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" : "1",
 *     "ten_loai" :"demo_create_loaic",
 *     "mo_ta":"mo ta loai",
 *     "ma_loai" : "20"
 * }
 * @apiParam {String} key Mã Key .
 * @apiParam {String} ma_loai mã của loại.
 * @apiParam {String} ten_loai Tên Loại.
 * @apiParam {String} mo_ta mô tả của Loại.
 * .
 * @apiSuccess {String} data Dữ liệu của Tầng.
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
 *         "ma_loai": "Loại không tồn tại",
 *         "ten_loai": "Tên loại đã tồn tại"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */