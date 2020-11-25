<?php

namespace App\Rules;

class RegexRule {
    //Nguoi Dung
    const REGEX_EMAIL_RULE     = ['regex:/^[a-z][a-z0-9_\.]{4,32}@[a-z0-9]{4,30}(\.[a-z0-9]{2,4}){1,3}$/', 'unique:nguoi_dung,email'];
    const REGEX_EMAIL_CHECK_IN = ['regex:/^[a-z][a-z0-9_\.]{4,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,3}$/', 'exists:nguoi_dung,email'];
    const REGEX_SDT_RULE       = ['regex:/^(?:09|03|05|07|08|\+84)[0-9]{8}$/', 'unique:nguoi_dung,sdt'];
    const REGEX_SDT_CHECK_IN   = ['regex:/^(?:09|03|05|07|08|\+84)[0-9]{8}$/', 'exists:nguoi_dung,sdt'];
    const REGEX_USER_NAME_RULE = ['regex:/^[a-zA-Z0-9\.\_]{4,30}$/', 'unique:nguoi_dung,tai_khoan'];
    const REGEX_PASSWORD_RULE  = ['regex:/^[a-z0-9]{32}$/'];
    const REGEX_MA_CAP_DO      = ['regex:/^[2,3]$/'];
    const REGEX_HO_TEN         = ['nullable', 'regex:/^\w[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹêếềễệ\ \_\.]{0,100}$/'];
    const REGEX_HO_TEN_C       = ['nullable', 'regex:/^\w[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹêếềễệ\ \_\.\(\)]{0,100}$/'];
    const REGEX_EMAIL_RULE_C   = ['required', 'regex:/^[a-z][a-z0-9_\.]{4,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,3}$/', 'unique:nguoi_dung,email'];
    const REGEX_MA_CAP_DO_C    = ['required', 'regex:/^[1,2,3]$/'];
    //Toa
    const REGEX_TOA_NAME    = ['regex:/^\w[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹêếềễệ\ \_\.]{5,19}$/'];
    const REGEX_TOA_DIA_CHI = ['regex:/^\w[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹêếềễệ\ \_\.]{5,99}$/'];

    //Tầng
    const REGEX_TANG_NAME       = ['regex:/^\w[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹêếềễệ\ \_\.]{5,19}$/'];
    const REGEX_TANG_MA_TOA     = ['exists:toa,ma_toa'];
    const REGEX_TANG_MA_TANG    = ['exists:tang,ma_tang'];
    const REGEX_TANG_TINH_TRANG = ['exists:tinh_trang,ma_tinh_trang'];

    const REGEX_PHONG_NAME        = ['regex:/^\w[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹêếềễệ\ \_\.]{5,19}$/'];
    const REGEX_PHONG_SO_CHO_NGOI = ['regex:/^[0-9][0-9]?$/'];
    ///Loai
    const REGEX_LOAI_MA_LOAI  = ['exists:loai,ma_loai'];
    const REGEX_LOAI_TEN_LOAI = ['regex:/^[a-zA-z0-9\_]{5,100}$/', 'unique:loai,ten_loai'];
    const REGEX_LOAI_MO_TA    = ['regex:/^\w[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹêếềễệ\ \_\.]{5,500}$/'];

    ///Cấu Hình
    const REGEX_CAU_HINH_CPU         = ['regex:/^[a-zA-Z0-9\,\ \_\-\+\/]{5,40}$/'];
    const REGEX_CAU_HINH_RAM         = ['regex:/^[1-9][0-9]?$/'];
    const REGEX_CAU_HINH_MAIN        = ['regex:/^[a-zA-Z0-9\,\ \_\-\+\/]{5,40}$/'];
    const REGEX_CAU_HINH_O_CUNG      = ['regex:/^[a-zA-Z0-9\,\ \_\-\+\/]{5,40}$/'];
    const REGEX_CAU_HINH_MA_CAU_HINH = ['exists:cau_hinh,ma_cau_hinh'];
    const REGEX_CAU_HINH_MO_TA       = ['regex:/^\w[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹêếềễệ\ \_\.]{5,500}$/'];
    const REGEX_CAU_HINH_MA_LOAI     = ['exists:loai,ma_loai'];

    //Cấu Hình Môn

    //Ngay nghi

    const REGEX_NGAY                 = ['regex:/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]|(?:Jan|Mar|May|Jul|Aug|Oct|Dec)))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2]|(?:Jan|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec))\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)(?:0?2|(?:Feb))\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9]|(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep))|(?:1[0-2]|(?:Oct|Nov|Dec)))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/', 'after_or_equal:today'];
    const REGEX_NGAY_NGHI_MA_CA      = ['regex:/^[2,3,5,6]$/', 'distinct'];
    const REGEX_GHI_CHU              = ['regex:/^\w[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹêếềễệ\ \_\.]{0,500}$/'];
    const REGEX_NGAY_NGHI_TINH_TRANG = ['regex:/^[1,2]$/'];

    //Mon hoc
    const REGEX_MON_HOC_MA_MON_HOC = ['exists:mon_hoc,ma_mon_hoc'];

    //PhanCong
    const REGEX_PHAN_CONG_MA_MON_HOC    = ['exists:mon_hoc,ma_mon_hoc'];
    const REGEX_PHAN_CONG_MA_PHAN_CONG  = ['exists:phan_cong,ma_phan_cong'];
    const REGEX_PHAN_CONG_MA_NGUOI_DUNG = ['nullable', 'exists:nguoi_dung,ma_nguoi_dung'];
    const REGEX_PHAN_CONG_TINH_TRANG    = ['regex:/^[0,1,2]$/'];
    //Global
    const REGEX_THU                        = ['regex:/^[2-8]$/'];
    const REGEX_EXISTS_MA_CA               = ['exists:ca,ma_ca'];
    const REGEX_EXISTS_MA_PHONG            = ['exists:phong,ma_phong'];
    const REGEX_EXISTS_MA_PHAN_CONG        = ['exists:phan_cong,ma_phan_cong'];
    const REGEX_EXISTS_MA_NGUOI_DUNG       = ['exists:nguoi_dung,ma_nguoi_dung'];
    const REGEX_EXISTS_MA_TANG             = ['exists:tang,ma_tang'];
    const REGEX_EXISTS_MA_TOA              = ['exists:toa,ma_toa'];
    const REGEX_EXISTS_MA_TINH_TRANG       = ['exists:tinh_trang,ma_tinh_trang'];
    const REGEX_EXISTS_MA_LOAI             = ['exists:loai,ma_loai'];
    const REGEX_EXISTS_MA_CAU_HINH         = ['exists:cau_hinh,ma_cau_hinh'];
    const REGEX_EXISTS_MA_MON_HOC          = ['exists:mon_hoc,ma_mon_hoc'];
    const REGEX_EXISTS_MA_LICH_DAY_BO_SUNG = ['exists:lich_day_bo_sung,ma_lich_day_bo_sung'];
    const REGEX_EXISTS_MA_THIET_BI         = ['exists:thiet_bi_phong,ma_thiet_bi'];
    const REGEX_GIO_BAT_DAU                = ['regex:/^(?:[01]\d|2[0-3]):(?:[0-5]\d):(?:[0-5]\d)$/', 'exists:ca,gio_bat_dau'];
    const REGEX_GIO_KET_THUC               = ['regex:/^(?:[01]\d|2[0-3]):(?:[0-5]\d):(?:[0-5]\d)$/', 'exists:ca,gio_ket_thuc', 'after:gio_bat_dau'];
    const REGEX_SO_GIO                     = ['regex:/^[2,4]$/'];
    const REGEX_SO_NGAY                    = ['regex:/^(([1-2][0-9])|([1-9]))$/'];
    const REGEX_ARRAY_MIN_1                = ['array', 'min:1'];
    const REGEX_TEN_LIMIT_100              = ['nullable', 'regex:/^\w[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹêếềễệ\ \_\.]{0,100}$/'];
}
