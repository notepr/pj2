<?php

namespace App\Http\Custom;

use App;
use Illuminate\Http\Response;

class ResponseMau {
    private $success, $message, $data;
    ///VAL
    const RES_KHONG_HOP_LE   = ':attribute không hợp lệ';
    const RES_KHONG_TON_TAI  = ':attribute không tồn tại';
    const RES_DA_TON_TAI     = ':attribute đã tồn tại';
    const RES_PHAI_SAU       = ':attribute phải sau :date';
    const RES_TRUNG_LAP      = ':attribute có dữ liệu bị trùng xin kiểm tra lại';
    const RES_ARRAY          = ':attribute phải là dạng mảng';
    const RES_ARRAY_MIN      = ':attribute phải có tối thiểu :min dữ liệu';
    const RES_AFTER_OR_EQUAL = ':attribute phải là ngày hôm nay hoặc trong tương lai';

    //end Val
    const SUCCESS_DONE_DATA      = 'Lấy dữ liệu thành công';
    const SUCCESS_GET            = 'Lấy dữ liệu thành công';
    const SUCCESS_UPDATE         = 'Cập nhật thành công';
    const SUCCESS_CREATE         = 'Tạo thành công';
    const SUCCESS_DELETE         = 'Xóa thành công';
    const SUCCESS_RUN            = 'Chạy thành công';
    const SUCCESS_NO_DATA_UPDATE = 'Không có dữ liệu nào mới để thay đổi';
    ///success return
    const SUCCESS_USER_CREATE         = 'Tạo tài khoản thành công';
    const SUCCESS_USER_LOGOUT         = 'Đăng xuất thành công';
    const SUCCESS_USER_LOGIN          = 'Đăng nhập thành công';
    const SUCCESS_USER_CHANGEPASSWORD = 'Đổi mật khẩu thành công';
    const SUCCESS_USER_RESETPASSWORD  = '';
    const SUCCESS_USER_UPDATE_INFO    = 'Thay đổi thông tin thành công';
    const SUCCESS_PHONG_CREATE        = 'Tạo phòng thành công';
    const SUCCESS_PHONG_DELETE        = 'Xóa phòng thành công';
    //Loai
    const SUCCESS_LOAI_EDIT   = 'Sửa thông tin loại thành công';
    const SUCCESS_LOAI_CREATE = 'Thêm loại mới thành công';
    //Cấu Hình
    const SUCCESS_CAU_HINH_CREATE = 'Thêm cấu hình thành công !';
    const SUCCESS_CAU_HINH        = 'Lấy thông tin thành công !';
    //Ngay Nghi
    const SUCCESS_NGAY_NGHI_THEM = 'Thêm ngày nghỉ thành công';
    const SUCCESS_NGAY_NGHI_SUA  = 'Sửa ngày nghỉ thành công';
    const SUCCESS_NGAY_NGHI_XOA  = 'Xóa ngày nghỉ thành công';
    ///ERROR RETURN
    //NguoiDung
    const ERROR_NOT_DETERMINED = 'Có lỗi từ hệ thống hãy thực hiện lại hoặc liên hệ kĩ thuật';
    const ERROR_GET            = 'Lấy dữ liệu thất bại';
    const ERROR_RUN            = 'Chạy thất bại';
    const ERROR_UPDATE         = 'Cập nhật dữ liệu thất bại';
    const ERROR_KEY            = 'Bạn không có quyền truy cập';
    const ERROR_CREATE         = 'Tạo thất bại hay kiểm tra lại dữ liệu';
    const ERROR_DELETE         = 'Xóa thất bại hay kiểm tra lại dữ liệu';
    const ERROR_PROPOSED       = 'Dữ liệu bạn nhập không hợp lệ,không có bất kì đề xuất nào cả';

    const ERROR_USER_NAME               = ':attribute cần từ 4-20 kí tự và không có kí tự đặc biệt';
    const ERROR_USER_PASSWORD_ILLEGAL   = ':attribute cần từ 5-32 kí tự và không bao gồm kí tự đặc biệt';
    const ERROR_USER_MA_CAP_DO          = ':attribute chỉ có thể chọn Giáo Viên hoặc Kĩ Thuật';
    const ERROR_USER_CHANGEPASSWORD     = 'Đổi mật khẩu thất bại';
    const ERROR_USER_PASS_DUPLICATE     = 'Đổi thất bại, mật khẩu mới phải khác mật khẩu hiện tại';
    const ERROR_USER_PASS_OLD           = 'Mật khẩu hiện tại bạn nhập không chính xác ';
    const ERROR_USER_RESETPASSWORD      = 'Chức năng chưa phát triển';
    const ERROR_USER_UPDATE_INFO        = 'Thay đổi thông tin không thành công';
    const ERROR_USER_UPDATE_INFO_CAP_DO = 'Bạn không được phép cập nhật thông tin cho Giáo Vụ khác';
    const ERROR_USER_UPDATE_CAP_DO      = 'Bạn không được phép thêm người khác làm giáo vụ';
    const ERROR_USER_KHONG_CO_THAY_DOI  = 'Bạn chưa điền thay đổi gì ';
    const ERROR_USER_LOGIN              = 'Đăng nhập thất bại kiểm tra lại tài khoản hoặc mật khẩu';

    //Tòa
    const ERROR_TOA_TEN_TOA     = ':attribute chỉ từ 6-20 kí tự và không chứa kí tự đặc biệt';
    const ERROR_TOA_DIA_CHI     = ':attribute chỉ từ 6-100 kí tự và không chứa kí tự đặc biệt';
    const ERROR_TOA_UPDATE_INFO = 'Cập nhật thông tin thất bại có lỗi của hệ thống';
    const ERROR_TANG_MA_TOA     = 'Mã tòa bị trùng hoặc không hợp lệ';
    const ERROR_TANG_TINH_TRANG = 'Trạng thái không hợp lệ';
    const ERROR_TOA_MA_TOA      = 'Không có Tòa để update';

    //Tang
    const ERROR_TANG_TEN_TANG    = 'Tên tầng bị trùng hoặc không hợp lệ (4-20 kí tự và không có kí tự đặc biệt)';
    const ERROR_TANG_MA_TANG     = 'Mã tầng bị trùng hoặc không hợp lệ';
    const ERROR_TANG_UPDATE_INFO = 'Thông tin không thay đổi hoặc không tồn tại Tầng';
    //const ERROR_TANG_CREATE      = 'Tao tầng thất bại hãy kiểm tra lại các dữ liệu';
    //Phong
    const ERROR_PHONG_DELETE      = 'Xóa phòng thất bại, Phòng yêu cầu xóa có thể đang được phân công sử dụng hoặc thiết bị chưa được chuyển đi ';
    const ERROR_PHONG_TEN_PHONG   = 'Tên phòng không hợp lệ (4-20 kí tự và không có kí tự đặc biệt)';
    const ERROR_PHONG_TINH_TRANG  = 'Mã tình trạng không hợp lệ';
    const ERROR_PHONG_SO_CHO_NGOI = 'Số chỗ ngồi phải từ 0 đến 99';

    //Loai
    const ERROR_LOAI_MA_LOAI  = 'Mã Loại không tồn tại !';
    const ERROR_LOAI_TEN_LOAI = "Tên Loại đã tồn tại hoặc không hợp lệ (chỉ gồm kí tự thường từ 5-100 kí tự ví dụ 'man_hinh')";
    const ERROR_LOAI_MO_TA    = "Mô Tả có thể không hợp lệ (Từ 5-500 kí tự chỉ gồm tiếng việt có dấu không gồm kí tự đặc biệt như '\/^*')";
    const ERROR_LOAI_EDIT     = "Thay đổi thông tin loại thất bại hãy kiểm tra lại thông tin hoặc liên hệ kĩ thuật !";
    const ERROR_LOAI_CREATE   = "Thêm loại thất bại hãy kiểm tra lại thông tin hoặc liên hệ kĩ thuật ! ";

    //Cấu Hình
    const ERROR_CAU_HINH_CASE          = 'Cấu hình bạn chọn không phải Case';
    const ERROR_CAU_HINH_CPU           = 'CPU không hợp lệ chỉ bao gồm chữ,số và (_,-, ,+,\,/)';
    const ERROR_CAU_HINH_RAM           = 'RAM chỉ có số từ 1-99';
    const ERROR_CAU_HINH_MAIN          = 'MAIN không hợp lệ chỉ bao gồm chữ,số và (_,-, ,+,\,/)';
    const ERROR_CAU_HINH_O_CUNG        = 'CPU không hợp lệ chỉ bao gồm chữ,số và (_,-, ,+,\,/)';
    const ERROR_CAU_HINH_MA_CAU_HINH   = 'Mã cấu hình không tồn tại hoặc không hợp lệ';
    const ERROR_CAU_HINH_MO_TA         = "Mô Tả có thể không hợp lệ (Từ 5-500 kí tự chỉ gồm tiếng việt có dấu không gồm kí tự đặc biệt như '\/^*')";
    const ERROR_CAU_HINH_MA_LOAI       = 'Mã Loại không tồn tại !';
    const ERROR_CAU_HINH_TAO           = 'Tạo thông tin cho thiết bị thất bại !';
    const ERROR_CAU_HINH_GET_INFO_CASE = 'Lấy thông tin thất bại !';
    const ERROR_CAU_HINH_DA_TON_TAI    = 'Cấu hình bạn thêm hiện đã tồn tại';
    const ERROR_CAU_HINH_UPDATE        = 'Cấu hình bạn thêm hiện đã tồn tại';
    const ERROR_GIAO_VIEN_API          = 'Lấy thông tin Giáo Viên thất bại !';

    //Cau Hinh Mon

    const ERROR_CAU_HINH_MON = 'Chưa có môn học được cho cấu hình bạn chọn';

    //Ngay Nghi

    const ERROR_NGAY_NGHI_THEM        = 'Ngày nghỉ đã tồn tại hoặc không hợp lệ !';
    const ERROR_NGAY_NGHI_SUA         = 'Ngày nghỉ không tồn tại , không hợp lệ hoặc không có thay đổi gì cả!';
    const ERROR_NGAY_NGHI_XOA         = 'Ngày nghỉ không tồn tại hoặc không hợp lệ !';
    const ERROR_NGAY_NGHI_TAT_CA      = 'Cả trường nghỉ vào ngày bạn đang chọn !';
    const ERROR_NGAY_NGHI_SUA_QK      = 'Bạn chỉ có thể sửa ngày nghỉ trong hôm nay và tương lai !';
    const ERROR_NGAY_NGHI_TOAN_TRUONG = 'Bạn không thể thêm ngày nghỉ cho cả trường và giáo viên một lần !';
    ///PhanCongChiTiet
    const ERROR_PCCT_PHAN_CONG    = 'Phân công bạn chọn không tồn tại hoặc chưa có giáo viên cho phân công này!';
    const ERROR_PCCT_SO_SINH_VIEN = 'Không thể lấy số sinh viên của lớp hãy thử lại hoặc liên hệ kĩ thuật !';
    const ERROR_PCCT_KHONG_CO_DX  = 'Không có lịch trống phù hợp cho lựa chọn của bạn !';
    const ERROR_PCCT_ADD_PCCT     = 'Bạn hãy chọn phân công theo dữ liệu được đề xuất ! ';

    ///lichhoc
    const ERROR_PCCT_NOT_FOUND = 'Không có phân công chi tiết để thực hiện tính toán !';

    ///lichdaybosung

    const ERROR_LICH_DAY_BO_SUNG_DELETE        = 'Bạn không thể xóa lịch dạy bổ sung trong quá khứ';
    const ERROR_LICH_DAY_BO_SUNG_CREATE_UPDATE = 'Lịch dạy bổ sung đã tồn tại , đã cập nhật lại trạng thái';
    const ERROR_LICH_DAY_BO_SUNG_SO_GIO        = ':attribute chỉ có thể là 2 hoặc 4';
    const ERROR_LICH_DAY_BO_SUNG_SO_NGAY       = ':attribute chỉ từ 1 đến 29';

    public function __construct() {
        $this->success = true;
        $this->message = '';
        $this->data    = [];
    }
    public static function None() {
        $res          = new Response();
        $res->success = true;
        $res->message = '';
        $res->data    = [];
        return $res;
    }
    public static function SusAndMess(bool $success, string $message) {
        $res          = new Response();
        $res->success = $success;
        $res->message = $message;
        $res->data    = [];
        return $res;
    }
    public static function Sus(bool $success) {
        $res          = new Response();
        $res->success = $success;
        $res->message = '';
        $res->data    = [];
        return $res;
    }
    public static function Mess(string $message) {
        $res          = new Response();
        $res->success = true;
        $res->message = $message;
        $res->data    = [];
        return $res;
    }
    public static function Every(bool $success, string $message, object $data) {
        $res          = new Response();
        $res->success = $success;
        $res->message = $message;
        $res->data    = $data;
        return $res;
    }
    public static function Object(Object $data) {
        $res          = new Response();
        $res->success = true;
        $res->message = '';
        $res->data    = $data;
        return $res;
    }
    public static function Store(array $data) {
        $res = (object) ['success' => null, 'message' => null, 'data' => null];
        if (isset($data['bool']) && $data['bool'] == false) {
            $res->success = $data['bool'];
        } else {
            $res->success = true;
        }
        if (isset($data['string']) && !is_null($data['string'])) {
            $res->message = $data['string'];
        } else {
            $res->message = '';
        }
        if (isset($data['data']) && !is_null($data['data'])) {
            $res->data = $data['data'];
        } else {
            $res->data = [];
        }
        if (isset($data['code']) && !is_null($data['code'])) {
            $methob = $data['code'];
        } else {
            if ($res->success) {
                $methob = Response::HTTP_OK;
            } else {
                $methob = Response::HTTP_OK;
            }

        }
        return response()->json($res, $methob);
    }
}
