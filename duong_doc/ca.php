/**
 * @api {POST} ca 1.1. Hiển thị tất cả các Ca
 * @apiVersion 0.1.0
 * @apiName Hiện thị thông tin Ca
 * @apiGroup Ca
 * @apiDescription Dùng để hiện thị thông tin Ca<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Cần lấy thông tin ca nào truyền thông tin mã ca đó<br>
 *     +Nếu lấy tất cả thì không truyền gì cả<br>
 *
 * @apiSampleRequest https://notepr.xyz/api/ca
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"1",
 *     "ma_ca" : "1"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_ca mã của Loại.
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
 *             "ma_ca": 1,
 *             "gio_bat_dau": "08:00:00",
 *             "gio_ket_thuc": "17:30:00"
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
 *         "ma_ca": "Ca không tồn tại"
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