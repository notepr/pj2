 * <?php
/**
 * @api {POST} tang 1.1. Hiển thị tông tin các Tầng hoặc một Tầng
 * @apiVersion 0.1.0
 * @apiName Hiện thị thông tin Tầng
 * @apiGroup Tang
 * @apiDescription Dùng để hiện thị thông tin Tầng<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Cần lấy thông tin tầng nào truyền thông tin mã tầng đó<br>
 *     +Nếu lấy tất cả thì không truyền gì cả<br>
 *     +Nếu lấy tất cả tầng của một tòa thì truyền vào mã tòa<br>
 *     +Có cả mã tầng và mã tòa mã tòa sẽ được ưu tiên hơn<br>
 *     +Nếu không có mã tình trạng tự động trả về những tầng hoạt động<br>
 *
 * @apiSampleRequest tang
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" : "keyapi",
 *     "ma_tang" : "5"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_toa mã của tòa.
 * @apiParam {String} ma_tang mã của tầng
 * .
 * @apiSuccess {String} data Dữ liệu của Tầng.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": [
 *         {
 *             "ma_tang": 5,
 *             "ten_tang": "Tầng 1",
 *             "ma_tinh_trang": 1,
 *             "ten_tinh_trang": "Hoạt Động",
 *             "ma_toa": 2,
 *             "ten_toa": "Tòa 2",
 *             "dia_chi_toa": "D5 Trần Đại Nghĩa"
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
 *         "ma_toa": "Tòa không tồn tại",
 *         "ma_tang": "Tầng không tồn tại"
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
 * @api {POST} tang/capnhat 1.2. Cập Nhật Thông Tin Của Một Tầng
 * @apiVersion 0.1.0
 * @apiName Cập Nhật Tầng
 * @apiGroup Tang
 * @apiDescription Dùng để cập nhật thông tin Tầng<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!--
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *      -->
 *  </div><br>
 *     +Bắt buộc cần có mã tầng để cập nhật<br>
 *     +Cập nhật gì có thể truyền nguyên yếu tố đó<br>
 *
 * @apiSampleRequest tang/capnhat
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" : "keyapi",
 *     "ma_tang" : "1",
 *     "ma_tinh_trang":"1",
 *     "ten_tang": "demo doi"
 * }
 * @apiParam {String} key Mã Key của Giáo Vụ.
 * @apiParam {String} ma_tang mã của tầng.
 * @apiParam {String} ma_tinh_trang mã của tình trạng thay đổi.
 * @apiParam {String} ten_tang Tên tầng thay đổi.
 * @apiParam {String} ma_toa mã của tòa thay đổi.
 * .
 * @apiSuccess {String} data Dữ liệu của Tầng.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Cập nhật thành công",
 *     "data": {
 *         "ma_tang": 1,
 *         "ten_tang": "demo doi",
 *         "ma_tinh_trang": 1,
 *         "ten_tinh_trang": "Hoạt Động",
 *         "ma_toa": 1,
 *         "ten_toa": "Tòa 1",
 *         "dia_chi_toa": "A17 Tạ Quang Bửu"
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
 *         "ma_toa": "Tòa không tồn tại",
 *         "ma_tang": "Tầng không tồn tại"
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
 * @api {POST} tang/tao 1.3. Tạo ra một Tầng mới
 * @apiVersion 0.1.0
 * @apiName Tạo Tầng
 * @apiGroup Tang
 * @apiDescription Dùng để tạo ra một Tầng<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!--
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *      -->
 *  </div><br>
 *     +Cần gửi đủ tên tầng,mã tòa.<br>
 *     +mã tình trạng Có thể không gửi nếu nó Hoạt Động. <br>
 *
 * @apiSampleRequest tang/tao
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" : "keyapi",
 *     "ten_tang" : "Tao Tang Moi",
 *     "ma_toa" : "1"
 * }
 * @apiParam {String} key Mã Key của Giáo Vụ.
 * @apiParam {String} ma_tinh_trang mã của tình trạng.
 * @apiParam {String} ten_tang Tên tầng.
 * @apiParam {String} ma_toa mã của tòa.
 * .
 * @apiSuccess {String} data Dữ liệu của Tầng.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Tạo thành công",
 *     "data": {
 *         "ma_tang": 9,
 *         "ten_tang": "Tao Tang Moi",
 *         "ma_tinh_trang": 1,
 *         "ten_tinh_trang": "Hoạt Động",
 *         "ma_toa": "1",
 *         "ten_toa": "Tòa 1",
 *         "dia_chi_toa": "A17 Tạ Quang Bửu"
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
 *         "ma_toa": "Tòa không tồn tại",
 *         "ten_tang": "Tên tầng không hợp lệ",
 *         "ma_tinh_trang": "Tình trạng không tồn tại"
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
 * @api {POST} tang/kiemtra 1.4. Kiểm tra thông tin hợp lệ
 * @apiVersion 0.1.0
 * @apiName Kiểm Tra
 * @apiGroup Tang
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
 * @apiSampleRequest tang/kiemtra
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" : "keyapi",
 *     "ten_tang" : "đssd",
 *     "ma_toa" : "10",
 *     "ma_tinh_trang" :"3"
 * }
 * @apiParam {String} key Mã Key của Giáo Vụ.
 * @apiParam {String} ma_tinh_trang mã của tình trạng.
 * @apiParam {String} ten_tang Tên tầng.
 * @apiParam {String} ma_toa mã của tòa.
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
 *         "ma_toa": "Tòa không tồn tại",
 *         "ten_tang": "Tên tầng không hợp lệ",
 *         "ma_tinh_trang": "Tình trạng không tồn tại"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */