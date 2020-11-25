<?php

namespace App\Http\Requests;

use App\Rules\MaLopRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use RegexRule;

class LichDayBoSungRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ngay'                => RegexRule::REGEX_NGAY,
            'ma_ca'               => RegexRule::REGEX_EXISTS_MA_CA,
            'ma_phong'            => RegexRule::REGEX_EXISTS_MA_PHONG,
            'ma_giao_vien'        => RegexRule::REGEX_EXISTS_MA_NGUOI_DUNG,
            'ma_lich_day_bo_sung' => RegexRule::REGEX_EXISTS_MA_LICH_DAY_BO_SUNG,
            'ma_lop'              => new MaLopRule(),
            'ghi_chu'             => RegexRule::REGEX_GHI_CHU,
            'tinh_trang'          => RegexRule::REGEX_NGAY_NGHI_TINH_TRANG,
            'ma_mon_hoc'          => RegexRule::REGEX_EXISTS_MA_MON_HOC,
            'so_gio'              => RegexRule::REGEX_SO_GIO,
            'so_ngay'             => RegexRule::REGEX_SO_NGAY,
        ];
    }
    public function attributes() {
        return [
            'ngay'                => 'Ngày',
            'ma_ca'               => 'Ca',
            'ma_phong'            => 'Phòng',
            'ma_giao_vien'        => 'Giáo viên',
            'ma_lich_day_bo_sung' => 'Lịch dạy bổ sung',
            'ma_lop'              => 'Lớp',
            'ghi_chu'             => 'Ghi chú',
            'tinh_trang'          => 'Tình trạng',
            'ma_mon_hoc'          => 'Môn học',
            'so_gio'              => 'Số giờ học',
            'so_ngay'             => 'Số ngày',
        ];
    }
    public function withValidator(Validator $validator) {
        $error = $validator->messages();
        if ($this->request->has('ngay') && !$error->has('ngay')) {
            $this->request->add([
                'ngay' => $this->stringToDate($this->request->get('ngay')),
            ]);
        }
    }
    public function stringToDate($string) {
        $string = str_replace('/', '-', $string);
        $create = date_create($string);
        $format = date_format($create, "Y-m-d");
        return $format;
    }
}
