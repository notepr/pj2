/**
 * @api {POST} thietbiphong/taohoacsua 1.1. Tạo hoặc cập nhật thông tin Thiết Bị Phòng
 * @apiVersion 0.1.0
 * @apiName Tạo Hoặc Sửa
 * @apiGroup Thiết Bị Phòng
 * @apiDescription Tạo hoặc cập nhật thông tin Thiết Bị Phòng<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 * <button type="button" class="btn btn-info">Giáo Viên</button>
 *  --></div><br>
 * +Truyền vào mã cấu hình và mã phong.<br>
 *
 * @apiSampleRequest thietbiphong/taohoacsua
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "1",
 *     "ma_cau_hinh": 1,
 *     "ma_phong": 2
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_cau_hinh Mã Cấu Hình.
 * @apiParam {String} ma_phong Mã của Phòng.
 *
 * @apiSuccess {String} data Dữ liệu Phòng.
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
 *         "ma_phong": "Phòng không tồn tại",
 *         "ma_cau_hinh": "Cấu hình không tồn tại"
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
 * @api {POST} thietbiphong/xoa 1.2. Xóa Thiết Bị Phòng
 * @apiVersion 0.1.0
 * @apiName Xóa
 * @apiGroup Thiết Bị Phòng
 * @apiDescription Dùng để Xóa Thiết Bị Phòng<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <!-- <button type="button" class="btn btn-warning">Kĩ Thuật</button> -->
 * <!-- <button type="button" class="btn btn-info">Giáo Viên</button> -->
 * </div><br>
 * +Truyền vào đầy đủ các thông tin để có thể xóa.<br>
 *
 *
 *
 * @apiSampleRequest thietbiphong/xoa
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "1",
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
 *         "ma_phong": "Phòng không tồn tại",
 *         "ma_cau_hinh": "Cấu hình không tồn tại"
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