 * <?php
/**
 * @api {POST} cauhinh 1.1. Hiển thị tất cả các Loại
 * @apiVersion 0.1.0
 * @apiName Hiện thị thông tin Loại
 * @apiGroup Cấu Hình
 * @apiDescription Dùng để hiện thị thông tin Cấu Hình<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 * 
 * <!--<button type="button" class="btn btn-info">Giáo Viên</button>-->
 * </div><br>
 * +Cần lấy thông tin Cấu Hình nào truyền thông tin mã Cấu Hình đó<br>
 * +Nếu lấy tất cả thì không truyền gì cả<br>
 * +Nếu lấy theo Loại thì không truyền ma_loai<br>
 * +Có cả ma_loai và ma_cau_hinh sẽ ưu tiên ma_loai<br>
 * 
 * @apiSampleRequest cauhinh
 * 
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 * 	"key" : "1",
 * 	"ma_cau_hinh" : "2",
 * 	"ma_loai":"2"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_cau_hinh mã của Cấu hình.
 * @apiParam {String} ma_loai mã loại.
 * 
 * @apiSuccess {String} data Dữ liệu của Tầng.
 * 
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 * 	"success": true,
 * 	"message": "",
 * 	"data": [
 * 		{
 * 		"ma_cau_hinh": 3,
 * 		"mo_ta": "DELL U2417H",
 * 		"ma_loai": 2,
 * 		"ten_loai": "update_ten_loai",
 * 		"mo_ta_loai": "Update cho loại"
 * 		}
 * 	]
 * }
 * 
 * @apiErrorExample Không Thành Công:
 * HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 * 	"success": false,
 * 	"message": {
 * 		"ma_cau_hinh": "Cấu hình không tồn tại",
 * 		"ma_loai": "Loại không tồn tại"
 * 	},
 * 	"data": []
 * }
 * {
 * 	"success": false,
 * 	"message": "Bạn không có quyền truy cập",
 * 	"data": []
 * }
 */
 * 
/**
 * @api {POST} cauhinh/case 1.2. Hiển thị tất cả Cấu Hình dạng Case
 * @apiVersion 0.1.0
 * @apiName Hiện thị Case
 * @apiGroup Cấu Hình
 * @apiDescription Dùng để hiện thị thông tin Cấu Hình CASE<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 * 
 * <!--<button type="button" class="btn btn-info">Giáo Viên</button>-->
 * </div><br>
 * +Cần lấy thông tin Cấu Hình nào truyền thông tin mã Cấu Hình đó<br>
 * +Chỉ hỗ trợ lấy một cấu hình theo ma_cau_hinh<br>
 * +Chỉ lấy loại case
 * 
 * @apiSampleRequest cauhinh/case
 * 
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" : "1",
 *     "ma_cau_hinh":"1"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_cau_hinh mã của Cấu hình của loại CASE.
 * 
 * @apiSuccess {String} data Dữ liệu của Cấu Hình Case.
 * 
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": {
 *         "ma_cau_hinh": 1,
 *         "ma_loai": 1,
 *         "cpu": "I9-9900XE",
 *         "main": "Z350",
 *         "ram": "8Gb",
 *         "o_cung": "",
 *         "vga": "",
 *         "ten_loai": "case",
 *         "mo_ta_loai": "case"
 *     }
 * }
 * 
 * @apiErrorExample Không Thành Công:
 * HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": "Cấu hình bạn chọn không phải Case",
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": {
 *         "ma_cau_hinh": "Cấu hình không tồn tại"
 *     },
 *     "data": []
 * }
 * {
 * 	"success": false,
 * 	"message": "Bạn không có quyền truy cập",
 * 	"data": []
 * }
 */
/**
 * @api{POST} cauhinh/sua 1.3 . Cập Nhật Thông Tin Của Một Cấu Hình
 * @apiVersion 0.1.0
 * @apiName Cập Nhật Cấu Hình
 * @apiGroup Cấu Hình
 * @apiDescription Dùng để cập nhật thông tin Cấu Hình <br>
 * <h1 class="display-1">-Lưu ý: </h1>
 * <div class="btn-group btn-group-toggle" data-toggle="buttons">
 * <button type="button" class="btn btn-danger">Giáo Vụ</button>
 * <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 * 
 * <!--<button type="button" class="btn btn-info">Giáo Viên</button>-->
 * </div><br>
 * +Nếu loại case cần truyền thêm mã loại
 * +Nếu cập nhật loại Case thì có thể truyền các yếu tố ['cpu', 'ram', 'main', 'o_cung', 'vga'] <br>
 * +Các loại khác chỉ cần truyền mo_ta,ma_loại <br>
 * 
 * @apiSampleRequest cauhinh/sua
 * 
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key":"1",
 *     "ma_cau_hinh":"4",
 *     "mo_ta":"Mo ta da sưa"
 * }
 * {
 *     "key":"1",
 *     "ma_cau_hinh":"2",
 *     "ma_loai":"1",
 *     "cpu":"G-9000K",
 *     "main":"Z100X",
 *     "ram":"16",
 *     "o_cung":"250GB HDD 120GB SSD",
 *     "vga":"1000XXXXX"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_cau_hinh mã của Cấu hình.
 * @apiParam {String} ma_loai Mã loại.
 * @apiParam {String} cpu CPU.
 * @apiParam {String} main Main.
 * @apiParam {String} ram RAM.
 * @apiParam {String} o_cung Ổ Cứng.
 * @apiParam {String} vga VGA.
 * 
 * @apiSuccess {String} data Dữ liệu trả về.
 * 
 * @apiSuccessExample Thành Công:
 * HTTP/1.1 200 OK
 * {
 *     "success":true,
 *     "message":"Cập nhật thành công",
 *     "data":{
 *         "ma_cau_hinh":4,
 *         "mo_ta":"Mo ta da sưa",
 *         "ma_loai":3,
 *         "ten_loai":"chuot",
 *         "mo_ta_loai":"Chuột"
 *     }
 * }
 * {
 *     "success":true,
 *     "message":"Cập nhật thành công",
 *     "data":{
 *         "ma_cau_hinh":2,
 *         "mo_ta":"CPU:G-9000K RAM:16 MAIN:Z100X O_CUNG:250GB HDD 120GB SSD VGA:1000XXXXX",
 *         "ma_loai":"1",
 *         "ten_loai":"case",
 *         "mo_ta_loai":"case"
 *     }
 * }
 * 
 * @apiErrorExample Không Thành Công:
 * HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như key sai,lỗi truy vấn sql
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 *  {
 *     "success":false,
 *     "message":{
 *         "cpu":"CPU không hợp lệ",
 *         "ram":"RAM không hợp lệ",
 *         "main":"Main không hợp lệ",
 *         "o_cung":"Ổ Cứng không hợp lệ"
 *     },
 *     "data":[]
 * }
 * {
 *     "success":false,
 *     "message":"Bạn không có quyền truy cập",
 *     "data":[]
 * }
 */
/**
 * @api {POST} cauhinh/them 1.4. Tạo ra một Cấu Hình Mới
 * @apiVersion 0.1.0
 * @apiName Tạo Cấu Hình
 * @apiGroup Cấu Hình
 * @apiDescription Dùng để tạo ra một Cấu Hình<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <!--<button type="button" class="btn btn-info">Giáo Viên</button>-->
 *  </div><br>
 *     +Cần gửi đủ ma_loai,mo_ta.<br>
 *     +Nếu mô tả là loại case thì truyền thêm các thông tin của case ['cpu', 'ram', 'main', 'o_cung', 'vga']
 *     có thể bỏ trống hoặc không truyền bất cứ yếu tố nào.<br>
 * 
 * @apiSampleRequest cauhinh/them
 * 
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" :"1",
 *     "ma_loai": 1,
 *     "cpu": "I9-9900XE",
 *     "main": "Z350_A",
 *     "ram": "8",
 *     "o_cung": "10000HDD 1520SSF",
 *     "vga": "GTX 1660"
 * }
 * {
 *     "key" :"1",
 *     "ma_loai": 2,
 *     "mo_ta" : "Tao loai 2"
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
 *         "ma_cau_hinh": 5,
 *         "mo_ta": "CPU:I9-9900XE RAM:8 MAIN:Z350_A O_CUNG:10000HDD 1520SSF VGA:GTX 1660",
 *         "ma_loai": 1,
 *         "ten_loai": "case",
 *         "mo_ta_loai": "case"
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
 *         "cpu": "CPU không hợp lệ",
 *         "ram": "RAM không hợp lệ",
 *         "main": "Main không hợp lệ",
 *         "o_cung": "Ổ Cứng không hợp lệ"
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
 * @api {POST} cauhinh/kiemtra 1.5. Kiểm tra thông tin hợp lệ
 * @apiVersion 0.1.0
 * @apiName Kiểm Tra
 * @apiGroup Cấu Hình
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
 *     "ma_loai": 1,
 *     "cpu": "I9-9900XE",
 *     "main": "Z350_A",
 *     "ram": "8",
 *     "o_cung": "10000HDD 1520SSF",
 *     "vga": "GTX 1660"
 * }
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} ma_cau_hinh mã của Cấu hình.
 * @apiParam {String} ma_loai Mã loại.
 * @apiParam {String} cpu CPU.
 * @apiParam {String} main Main.
 * @apiParam {String} ram RAM.
 * @apiParam {String} o_cung Ổ Cứng.
 * @apiParam {String} vga VGA.
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
 *         "cpu": "CPU không hợp lệ",
 *         "ram": "RAM không hợp lệ",
 *         "main": "Main không hợp lệ",
 *         "o_cung": "Ổ Cứng không hợp lệ"
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