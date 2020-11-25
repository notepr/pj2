<?php

namespace App\Http\Requests;

use App\Rules\MaGiaoVienRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use RegexRule;

class NgayNghiRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ma_giao_vien'    => RegexRule::REGEX_ARRAY_MIN_1,
            'ma_giao_vien.*'  => new MaGiaoVienRule(),
            'ma_giao_vien_cu' => new MaGiaoVienRule(),
            'ngay_cu'         => RegexRule::REGEX_NGAY,
            'ngay'            => RegexRule::REGEX_NGAY,
            'gio_bat_dau'     => RegexRule::REGEX_GIO_BAT_DAU,
            'gio_ket_thuc'    => RegexRule::REGEX_GIO_KET_THUC,
            'ma_ca'           => RegexRule::REGEX_ARRAY_MIN_1,
            'ma_ca_cu'        => RegexRule::REGEX_NGAY_NGHI_MA_CA,
            'ma_ca.*'         => RegexRule::REGEX_NGAY_NGHI_MA_CA,
            'ghi_chu'         => RegexRule::REGEX_GHI_CHU,
            'tinh_trang'      => RegexRule::REGEX_NGAY_NGHI_TINH_TRANG,
        ];
    }
    public function attributes() {
        return [
            'ma_giao_vien'    => 'Giáo viên',
            'ma_giao_vien_cu' => 'Giáo viên',
            'ma_giao_vien.*'  => 'Giáo viên',
            'ngay'            => 'Ngày',
            'ngay_cu'         => 'Ngày',
            'gio_bat_dau'     => 'Giờ bắt đầu',
            'gio_ket_thuc'    => 'Giờ kết thúc',
            'ma_ca'           => 'Ca',
            'ma_ca_cu'        => 'Ca',
            'ma_ca.*'         => 'Ca',
            'ghi_chu'         => 'Ghi chú',
            'tinh_trang'      => 'Tình trạng',
        ];
    }
    public function withValidator(Validator $validator) {
        $error = $validator->messages();
        if ($this->request->has('ngay') && !$error->has('ngay')) {
            $this->request->add([
                'ngay' => $this->stringToDate($this->request->get('ngay')),
            ]);
        }
        if ($this->request->has('ngay_cu') && !$error->has('ngay_cu')) {
            $this->request->add([
                'ngay_cu' => $this->stringToDate($this->request->get('ngay_cu')),
            ]);
            if ($this->request->has('ma_giao_vien') && is_array($this->request->get('ma_giao_vien'))) {
                $this->request->add([
                    'ma_giao_vien' => $this->request->get('ma_giao_vien')[0],
                ]);
            }
        }
        if ($this->request->has('ma_giao_vien') && is_array($this->request->get('ma_giao_vien'))) {
            $this->request->add([
                'ma_giao_vien' => array_unique($this->request->get('ma_giao_vien')),
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
