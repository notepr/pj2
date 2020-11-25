<?php
/**
 * @api {POST} nguoidung/tao 1.1. Tạo Người Dùng
 * @apiVersion 0.1.0
 * @apiName Đăng kí
 * @apiGroup NguoiDung
 * @apiDescription Dùng để tạo người dùng là giáo viên<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!--
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *      -->
 *  </div><br>
 *     +Cần gửi đầy đủ các dữ liệu được yêu cầu.<br>
 *     +Nếu SDT,Họ Tên,Mật Khẩu trống hệ thống sẽ tự tạo ngẫu nhiên.<br>
 * @apiSampleRequest nguoidung/tao
 *
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "kdvkfJxgcd",
 *     "tai_khoan": "demo",
 *     "email": "hdgggvjhg@gmail.com",
 *     "sdt": "0984578452",
 *     "mat_khau": "c4ca4238a0b923820dcc509a6f75849b",
 *     "ho_ten" : "Nguyen Văn Nhất"
 * }
 *
 * @apiParam {String} key Mã Key của Giáo Vụ.
 * @apiParam {String} tai_khoan Tài khoản muốn tạo từ 4-30 kí tự chỉ bao gồm số và chữ.
 * @apiParam {String} email Từ 5-30(không tính @gmail.com).
 * @apiParam {String} sdt Số điện thoại thật.
 * @apiParam {String} mat_khau Mã Has MD5.
 * @apiParam {String} ho_ten Họ tên của Người Dùng từ 0-100 kí tự chỉ bao gồm tiếng việt có dấu không kí tự đặc biệt .
 *
 * @apiSuccess {String} data Dữ liệu của tài khoản mới.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Tạo tài khoản thành công",
 *     "data": {
 *         "ma_nguoi_dung": 56,
 *         "ho_ten": "Nguyen Văn Nhất",
 *         "tai_khoan": "demo",
 *         "email": "hdgggvjhg@gmail.com",
 *         "sdt": "0984578452",
 *         "ma_cap_do": 3,
 *         "ten_cap_do": "Giáo Viên"
 *     }
 * }
 *
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như email,mat_khau,sdt,tai_khoan bị trùng hoặc vi phạm quy tắc
 * + "key" không có quyền tạo người dùng
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": {
 *         "email": "Email không hợp lệ",
 *         "sdt": "Số điện thoại không hợp lệ",
 *         "tai_khoan": "Tài khoản cần từ 4-20 kí tự và không có kí tự đặc biệt",
 *         "mat_khau": "Mật khẩu không hợp lệ"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 */
/**
 * @api {POST} dangnhap/{tai_khoan}/{mat_khau} 1.2. Đăng nhập
 * @apiVersion 0.1.0
 * @apiName Đăng Nhập
 * @apiGroup NguoiDung
 * @apiDescription Sử dụng để đăng nhập vào hệ thông với tài khoản và mật khẩu
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 * @apiSampleRequest dangnhap
 * @apiExample {php} Truy Vấn Mẫu:
 * http://localhost:8080/github/pri/public/api/dangnhap/test/d3d9446802a44259755d38e6d163e820
 * @apiParam {String} tai_khoan Email hoặc Username.
 * @apiParam {String} mat_khau Mật khẩu của người dùng.
 *
 * @apiSuccess {String} key Mã đại diện được cấp.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Đăng nhập thành công",
 *     "data": {
 *         "ma_nguoi_dung": 58,
 *         "ho_ten": "Nguyen Văn Nhất",
 *         "tai_khoan": "test",
 *         "email": "vfbbttrtb@gmail.com",
 *         "sdt": "0369633967",
 *         "ma_cap_do": 3,
 *         "ten_cap_do": "Giáo Viên",
 *         "key": "keyuser"
 *     }
 * }
 *
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": false,
 *     "message": "Đăng nhập thất bại kiểm tra lại tài khoản hoặc mật khẩu",
 *     "data": []
 * }
 */
/**
 * @api {POST} dangxuat 1.3. Đăng Xuất
 * @apiVersion 0.1.0
 * @apiName Đăng Xuất
 * @apiGroup NguoiDung
 * @apiDescription Sử dụng để đăng xuất cho tài khoản
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 * @apiSampleRequest dangxuat
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "KEYAPI",
 * }
 *
 * @apiParam {String} key Mã Key của Người Dùng.
 *
 * @apiSuccess {String} message Báo kết quả xử lý.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Đăng xuất thành công",
 *     "data": []
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
 * @api {POST} /nguoidung/doimatkhau 1.4. Đổi Mật Khẩu
 * @apiVersion 0.1.0
 * @apiName Đổi Mật Khẩu
 * @apiGroup NguoiDung
 * @apiDescription Sử dụng để đổi mật khẩu cho tài khoản
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Cần gửi đầy đủ các dữ liệu được yêu cầu.<br>
 *     +Nếu trùng mật khẩu mới và cũ sẽ không thực hiện đổi.<br>
 * @apiSampleRequest nguoidung/doimatkhau
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "keyapi",
 *     "mat_khau" : "d3d9446802a44259755d38e6d163e820",
 *     "mat_khau_moi" : "d3d9446802a44259755d38e6d163e821"
 * }
 *
 * @apiParam {String} key Mã Key của Người Dùng.
 * @apiParam {String} mat_khau Mật khẩu hiện tại.
 * @apiParam {String} mat_khau_moi Mật khẩu mới cho tài khoản.
 *
 * @apiSuccess {String} message Báo kết quả xử lý.
 * @apiSuccess {String} data Dữ liệu tài khoản sau khi đổi mật khẩu.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Đổi mật khẩu thành công",
 *     "data": {
 *         "key": "newkey"
 *     }
 * }
 *
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * + Có nhiều dạng trả về không thành công như mat_khau trùng,không hợp lệ
 * + "key" không có quyền tạo người dùng
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 * {
 *     "success": false,
 *     "message": "Bạn không có quyền truy cập",
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": {
 *         "mat_khau": "Mật khẩu không hợp lệ",
 *         "mat_khau_moi": "Mật khẩu mới không hợp lệ"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Đổi thất bại, mật khẩu mới phải khác mật khẩu hiện tại",
 *     "data": []
 * }
 */
 *
 *
/**
 * @api {POST} nguoidung/reset 1.5. Khôi Phục Mật Khẩu
 * @apiVersion 0.1.0
 * @apiName Khôi Phục Mật Khẩu
 * @apiGroup NguoiDung
 * @apiDescription Sử dụng để khôi phục mật khẩu cho tài khoản
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 * @apiSampleRequest nguoidung/reset
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "email":"demo@gmail.com",
 * }
 *
 * @apiParam {String} email Email của người dùng.
 *
 * @apiSuccess {String} message Báo kết quả xử lý.
 * @apiSuccess {String} data Dữ liệu sau khi xử lý.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": false,
 *     "message": "Chức năng chưa phát triển",
 *     "data": []
 * }
 *
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": false,
 *     "message": "Chức năng chưa phát triển",
 *     "data": []
 * }
 */
 *
/**
 * @api {POST} nguoidung/capnhatthongtin/{id} 1.6. Thay Đổi Thông Tin Của Tài Khoản
 * @apiVersion 0.1.0
 * @apiName Thay Đổi Thông Tin Của Tài Khoản
 * @apiGroup NguoiDung
 * @apiDescription Sử dụng thay đổi thông tin tài khoản<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Email,Sdt,mat_khau phải tuân thủ quy tắc như khi tạo tài khoản<br>
 *     +Có thể truyền yếu tố thay đổi không bắt buộc truyền tất cả<br>
 *     +Nếu là giáo vụ mới được phép thay đổi thông tin của Giáo Viên hoặc Kĩ Thuật<br>
 *     +Nếu là Giáo Viên hoặc Kĩ Thuật có thể để "id" ngẫu nhiên nhưng vẫn sẽ thay đổi thông tin tài khoản của chính họ<br>
 *     +Giáo Vụ không được đổi thông tin của giáo vụ khác<br>
 *     +Giáo Vụ có thể đổi mật khẩu của KT hoặc GV mà không cần biết mật khẩu cũ<br>
 *     +GV hoặc KT không thể đổi mật khẩu của mình bằng chức năng này <br>
 * @apiSampleRequest nguoidung/capnhatthongtin/{id}
 * @apiExample {php} Truy Vấn Mẫu:
 * http://localhost:8080/github/pri/public/api/nguoidung/capnhatthongtin/58
 * {
 *     "key": "keyapi",
 *     "email" : "vhfjvbfjh@gmail.com",
 *     "tai_khoan" : "changer",
 *     "sdt" : "0854217842"
 * }
 *
 * @apiParam {String} key Mã Key của Giáo Vụ.
 * @apiParam {String} tai_khoan Tài khoản muốn tạo từ 4-20 kí tự chỉ bao gồm số và chữ.
 * @apiParam {String} email Từ 5-32(không tính @gmail.com) kí tự chỉ hỗ trợ @gmail.com.
 * @apiParam {String} sdt Số điện thoại thật.
 * @apiParam {String} mat_khau Mã Has MD5.
 *
 * @apiSuccess {String} message Báo kết quả xử lý.
 * @apiSuccess {String} data Dữ liệu sau khi xử lý.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Thay đổi thông tin thành công",
 *     "data": {
 *         "ma_nguoi_dung": 58,
 *         "ho_ten": "Nguyen Văn Nhất",
 *         "tai_khoan": "changer",
 *         "email": "vhfjvbfjh@gmail.com",
 *         "sdt": "0854217842",
 *         "ma_cap_do": 3,
 *         "ten_cap_do": "Giáo Viên"
 *     }
 * }
 *
 *
 * @apiErrorExample Không Thành Công:
 * + Có nhiều dạng trả về không thành công như email,mat_khau,sdt,tai_khoan bị trùng hoặc vi phạm quy tắc
 * + "key" không hợp lệ
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 *     HTTP/1.1 401 Unauthorized
 * {
 *     "success": false,
 *     "message": {
 *         "email": "Email đã tồn tại",
 *         "sdt": "Số điện thoại đã tồn tại",
 *         "tai_khoan": "Tài khoản đã tồn tại"
 *     },
 *     "data": []
 * }
 * {
 *     "success": false,
 *     "message": "Bạn chưa điền thay đổi gì ",
 *     "data": []
 * }
 */
 *
 *
 *
/**
 * @api {POST} nguoidung/danhsach 1.7. Hiển Thị Danh Sách Kĩ Thuật Và Giáo Viên Trong Hệ Thống
 * @apiVersion 0.1.0
 * @apiName LIST GV KT
 * @apiGroup NguoiDung
 * @apiDescription Sử dụng để hiển thị danh sách Kĩ Thuật Và Giáo Viên<br>
 * -Lưu ý: <br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *         *Nếu là Giáo Vụ : trả về danh sách Giáo Viên và Kĩ Thuật
 *         *Nếu là GV hoặc KT:trả về thông tin của chính mình
 *     +Chưa có phân trang (sẽ update nếu cần)<br>
 * @apiSampleRequest nguoidung/danhsach
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" => "key",
 * }
 *
 * @apiParam {String} key Mã Key của Người Dùng.
 *
 * @apiSuccess {String} message Báo kết quả xử lý.
 * @apiSuccess {String} data Dữ liệu sau khi xử lý.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": [
 *         {
 *             "ma_nguoi_dung": 2,
 *             "ho_ten": null,
 *             "tai_khoan": "user",
 *             "email": "b@gmail.com",
 *             "sdt": "1",
 *             "ma_cap_do": 2,
 *             "ten_cap_do": "Kĩ Thuật"
 *         },
 *         {
 *             "ma_nguoi_dung": 58,
 *             "ho_ten": "Nguyen Văn Nhất",
 *             "tai_khoan": "changer",
 *             "email": "vhfjvbfjh@gmail.com",
 *             "sdt": "0854217842",
 *             "ma_cap_do": 3,
 *             "ten_cap_do": "Giáo Viên"
 *         }
 *     ]
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
 * @api {POST} nguoidung/kiemtra 1.8. Kiểm Tra Quy Tắc
 * @apiVersion 0.1.0
 * @apiName Kiểm Tra Quy Tắc
 * @apiGroup NguoiDung
 * @apiDescription Sử dụng để kiểm tra quy tắc hợp lệ cũng như trong hệ thống đã có chưa: <br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Chức năng dành cho tất cả user phục vụ cho việc đổi thông tin<br>
 *     +Phục vụ cho Giáo Vụ khi tạo tài khoản<br>
 *     +Cần kiểm tra dữ liệu nào thì truyền tương ứng<br>
 *     +Có thể truyền 1,2 hoặc tất cả các dữ liệu<br>
 * @apiSampleRequest nguoidung/kiemtra
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "Keyapi",
 *     "email" :"cds@gmail.com",
 *     "sdt": "1",
 *     "tai_khoan" : "cd",
 *     "mat_khau":"cd",
 *     "mat_khau_moi":"d"
 * }
 * @apiParam {String} key Mã Key của người dùng.
 * @apiParam {String} tai_khoan Dữ liệu cần kiểm tra.
 * @apiParam {String} email Dữ liệu cần kiểm tra.
 * @apiParam {String} sdt Dữ liệu cần kiểm tra.
 * @apiParam {String} mat_khau Dữ liệu cần kiểm tra.
 * @apiParam {String} mat_khau_moi Dữ liệu cần kiểm tra.
 *
 * @apiSuccess {String} message Báo kết quả xử lý.
 * @apiSuccess {String} data Dữ liệu sau khi xử lý.
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
 * + Có nhiều dạng trả về không thành công như email,mat_khau,sdt,tai_khoan bị trùng hoặc vi phạm quy tắc
 * + "key" không có quyền tạo người dùng
 * + Tất cả các lỗi đều có "message" kèm theo như ví dụ bên dưới
 *     HTTP/1.1 401 Unauthorized
 * {
 *     "success": false,
 *     "message": {
 *         "email": "Email không hợp lệ",
 *         "sdt": "Số điện thoại không hợp lệ",
 *         "tai_khoan": "Tài khoản cần từ 4-20 kí tự và không có kí tự đặc biệt",
 *         "mat_khau": "Mật khẩu không hợp lệ",
 *         "mat_khau_moi": "Mật khẩu mới không hợp lệ"
 *     },
 *     "data": []
 * }
 */
 *
 *
/**
 * @api {POST} nguoidung/kiemtrakey 1.9. Kiểm tra KEY của người dùng có hợp lệ không
 * @apiVersion 0.1.0
 * @apiName Kiểm tra KEY
 * @apiGroup NguoiDung
 * @apiDescription Sử dụng để kiểm tra key của người dùng cung cấp
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!--
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *      -->
 *  </div><br>
 * @apiSampleRequest nguoidung/kiemtrakey
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key" => "key",
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
 *     "message": "",
 *     "data": {
 *         "cap_do": 3
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
 * @api {POST} nguoidung/thongtin 2.0. Lấy thông tin Người Dùng
 * @apiVersion 0.1.0
 * @apiName Lấy thông tin
 * @apiGroup NguoiDung
 * @apiDescription Sử dụng để lấy thông tin người dùng<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *  </div><br>
 *     +Chức năng dành cho tất cả user phục vụ cho việc lấy thông tin<br>
 *     +Giáo vụ lấy thông tin các người dùng khác và không lấy được thông tin của Giáo Vụ khác<br>
 *     +GV hoặc KT sẽ trả về thông tin của mình<br>
 *     +Lấy thông tin của chính mình không cần truyền ma<br>
 * @apiSampleRequest nguoidung/thongtin
 * @apiExample {php} Truy Vấn Mẫu:
 * {
 *     "key": "key",
 *     "ma" :"58"
 * }
 * @apiParam {String} key Mã Key của người dùng.
 * @apiParam {String} ma Mã của người dùng cần lấy.
 *
 * @apiSuccess {String} message Báo kết quả xử lý.
 * @apiSuccess {String} data Dữ liệu sau khi xử lý.
 *
 * @apiSuccessExample Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": true,
 *     "message": "Lấy dữ liệu thành công",
 *     "data": {
 *         "ma_nguoi_dung": 58,
 *         "ho_ten": "Nguyen Văn Nhất",
 *         "tai_khoan": "changer",
 *         "email": "vhfjvbfjh@gmail.com",
 *         "sdt": "0854217842",
 *         "ma_cap_do": 3,
 *         "ten_cap_do": "Giáo Viên"
 *     }
 * }
 *
 *
 * @apiErrorExample Không Thành Công:
 *     HTTP/1.1 200 OK
 * {
 *     "success": false,
 *     "message": "Lấy dữ liệu thất bại",
 *     "data": []
 * }
 */
/**
 * @api {POST} nguoidung/clone 2.1. Clone User Từ DTB VỀ Local
 * @apiVersion 0.1.0
 * @apiName CLone
 * @apiGroup NguoiDung
 * @apiDescription Sử dụng để lấy tài khoản cũng như cập nhật thông tin cho tài khoản<br>
 * <h1 class="display-1">-Lưu ý: </h1>
 *  <div class="btn-group btn-group-toggle" data-toggle="buttons">
 *      <button type="button" class="btn btn-danger">Giáo Vụ</button>
 *      <!--
 *      <button type="button" class="btn btn-warning">Kĩ Thuật</button>
 *      <button type="button" class="btn btn-info">Giáo Viên</button>
 *      -->
 *  </div><br>
 *     +Chỉ chạy một lần<br>
 *     +Email thay đổi sẽ tạo user mới<br>
 *     +Lấy thông tin của chính mình không cần truyền ma<br>
 * @apiSampleRequest nguoidung/clone
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
 *     "message": "Đã tạo mới 1 bản ghi và Cập nhật 1 bản ghi",
 *     "data": {
 *         "create": [
 *             {
 *                 "ma_nguoi_dung": 64,
 *                 "ho_ten": "Đào Viết Phương",
 *                 "tai_khoan": "phuongdv",
 *                 "email": "phuongdv@bkacad.edu.vn",
 *                 "sdt": "0305476149",
 *                 "ma_cap_do": 3,
 *                 "ten_cap_do": "Giáo Viên"
 *             }
 *         ],
 *         "update": [
 *             {
 *                 "email": "yuki.lifdv@gmail.com",
 *                 "sdt": "0989154985",
 *                 "changer": {
 *                     "old.ho_ten": "Lê Thị Hương Liên",
 *                     "new.ho_ten": "Cô liên đề mô 2"
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