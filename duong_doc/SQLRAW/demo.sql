SELECT p.ma_phong,(
    SELECT thiet_bi_phong.ma_cau_hinh FROM `thiet_bi_phong` 
    INNER JOIN cau_hinh ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
    WHERE ma_phong = p.ma_phong
    GROUP BY ma_cau_hinh
    ORDER BY COUNT(*) DESC
    LIMIT 1
) as ma_cau_hinh FROM phong as p
HAVING ma_cau_hinh = 2