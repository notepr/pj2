/**
 * @api {POST} phong 1.1. Hiển thị tất cả Phòng
 * @apiVersion 0.1.0
 * @apiName Tất cả Phòng của một Tầng
 * @apiGroup Phòng
 * @apiDescription Dùng để trả về Phòng của một tầng<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 * <button type="button" class="btn btn-info">Giáo Viên</button>
 * </div><br>
 * +Yêu cầu truyền vào mã tầng hoặc mã phòng<br>
 * +Nếu có cả mã tầng và mã phòng thì mã tầng sẽ được ưu tiên và không lấy dữ liệu mã phòng<br>
 *
 * @apiSampleRequest phong
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ma_tang" : 1
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_tang Mã của Tầng.
 * @apiParam {String} ma_phong Mã của Phòng.
 *
 * @apiSuccess {String} data Dữ liệu Phòng.
 *
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": [
 *         {
 *             "ma_phong": 4,
 *             "ten_phong": "Lab 203",
 *             "so_cho_ngoi": 50,
 *             "ma_tang": 1,
 *             "ghi_chu": "",
 *             "tinh_trang": {
 *                 "ma_tinh_trang": 1,
 *                 "ten_tinh_trang": "Hoạt Động"
 *             }
 *         }
 *     ]
 * }
 *
 * @apiErrorExample Không Thành Công:
 * HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
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
 * @api {POST} phong/taohoaccapnhat 1.2. Tạo hoặc cập nhật thông tin Phòng
 * @apiVersion 0.1.0
 * @apiName Tạo hoặc cập nhật thông tin Phòng
 * @apiGroup Phòng
 * @apiDescription Dùng để tạo hoặc cập nhật thông tin Phòng<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 * <button type="button" class="btn btn-info">Giáo Viên</button>
 *  --></div><br>
 * +Nếu có mã phòng thì các thông tin tiếp theo truyền vào sẽ được cập nhật cho mã phòng đó.<br>
 * +Nếu Ghi chú và tình trạng có thể không truyền sẽ tự sử dùng tình trang  = 1 và ghi chú =  NULL.<br>
 * +Khi cập nhật thông tin chỉ cần truyền vào thông tin cần cập nhật.<br>
 *
 * @apiSampleRequest phong/taohoaccapnhat
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ten_phong": "Tao phong",
 *     "so_cho_ngoi": 50,
 *     "ma_tang": 1
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_phong Mã của Phòng.
 * @apiParam {String} ten_phong Tên của Phòng.
 * @apiParam {String} so_cho_ngoi Số chỗ ngồi của Phòng.
 * @apiParam {String} ma_tang Mã Tầng của Phòng.
 * @apiParam {String} ma_tinh_trang Mã tình trạng của Phòng.
 * @apiParam {String} ghi_chu Ghi chú.
 *
 * @apiSuccess {String} data Dữ liệu Phòng.
 *
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Tạo thành công",
 *     "data": {
 *         "ma_phong": 6,
 *         "ten_phong": "Tao phong",
 *         "so_cho_ngoi": 50,
 *         "ma_tang": 1,
 *         "ghi_chu": null,
 *         "tinh_trang": {
 *             "ma_tinh_trang": 1,
 *             "ten_tinh_trang": "Hoạt Động"
 *         }
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
 *         "ma_tang": "Tầng không tồn tại",
 *         "ten_phong": "Tên phòng không hợp lệ (4-20 kí tự và không có kí tự đặc biệt)",
 *         "so_cho_ngoi": "Số chỗ ngồi phải từ 0 đến 99",
 *         "ghi_chu": "ghi chu không hợp lệ (Gồm tiếng việt có thể có dấu hoặc không và từ 0-500 kí tự)"
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
 * @api {POST} phong/xoa 1.3. Xóa Phòng
 * @apiVersion 0.1.0
 * @apiName Xóa Phòng
 * @apiGroup Phòng
 * @apiDescription Dùng để Xóa Phòng<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 * <!-- <button type="button" class="btn btn-info">Giáo Viên</button> -->
 * </div><br>
 * +Nếu phòng đó đang được phân công lịch dạy cố định còn hiệu lực thì sẽ không được phép Xóa.<br>
 * +Nếu phòng đó đang có lịch dạy đột xuất trong tương lai cũng sẽ không được phép Xóa.<br>
 *
 *
 *
 * @apiSampleRequest phong/xoa
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ma_phong": 2
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_phong Mã Phòng.
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
 *         "ma_phong": "Phòng không tồn tại"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Xóa phòng thất bại, Phòng yêu cầu xóa có thể đang được phân công sử dụng hoặc thiết bị chưa được chuyển đi ",
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
 * @api {POST} phong/kiemtra 1.4. Kiểm tra thông tin hợp lệ
 * @apiVersion 0.1.0
 * @apiName Kiểm Tra
 * @apiGroup Phòng
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
 * @apiSampleRequest phong/kiemtra
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": 1,
 *     "ten_phong": "Ta",
 *     "so_cho_ngoi": 150,
 *     "ma_tang": 52,
 *     "ghi_chu": "S####"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_phong Mã của Phòng.
 * @apiParam {String} ten_phong Tên của Phòng.
 * @apiParam {String} so_cho_ngoi Số chỗ ngồi của Phòng.
 * @apiParam {String} ma_tang Mã Tầng của Phòng.
 * @apiParam {String} ma_tinh_trang Mã tình trạng của Phòng.
 * @apiParam {String} ghi_chu Ghi chú.
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
 *         "ma_tang": "Tầng không tồn tại",
 *         "ten_phong": "Tên phòng không hợp lệ (4-20 kí tự và không có kí tự đặc biệt)",
 *         "so_cho_ngoi": "Số chỗ ngồi phải từ 0 đến 99",
 *         "ghi_chu": "ghi chu không hợp lệ (Gồm tiếng việt có thể có dấu hoặc không và từ 0-500 kí tự)"
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