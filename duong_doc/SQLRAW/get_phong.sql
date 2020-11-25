lấy ra các phòng học được môn này:

SELECT thiet_bi_phong.ma_phong FROM thiet_bi_phong
INNER JOIN cau_hinh ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
INNER JOIN cau_hinh_mon ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh_mon.ma_mon_hoc = "BKA_ESE"
GROUP BY thiet_bi_phong.ma_phong



///lich cua tung phong

SELECT phan_cong_chi_tiet.thu,phan_cong_chi_tiet.ma_phong,phan_cong_chi_tiet.ma_ca,1 as da_dung FROM `phan_cong_chi_tiet`
INNER JOIN (
SELECT thiet_bi_phong.ma_phong FROM thiet_bi_phong
INNER JOIN cau_hinh ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
INNER JOIN cau_hinh_mon ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh_mon.ma_mon_hoc = "BKA_ESE"
GROUP BY thiet_bi_phong.ma_phong
) as tb_hoc_duoc
ON tb_hoc_duoc.ma_phong = phan_cong_chi_tiet.ma_phong


///gop ca 
SELECT tb.thu,c_ma_phong.ma_phong,ca.ma_ca,0 as da_dung 
FROM ca
CROSS JOIN (
    SELECT 2 as thu UNION
    SELECT 3 as thu UNION
    SELECT 4 as thu UNION
    SELECT 5 as thu UNION
    SELECT 6 as thu UNION
    SELECT 7 as thu UNION
    SELECT 8 as thu
) as tb
CROSS JOIN (
SELECT thiet_bi_phong.ma_phong FROM thiet_bi_phong
INNER JOIN cau_hinh ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
INNER JOIN cau_hinh_mon ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh_mon.ma_mon_hoc = "BKA_ESE"
GROUP BY thiet_bi_phong.ma_phong
) as c_ma_phong
WHERE ca.ma_ca !=1



///phong va ca co lich trong

SELECT tb_c_da.thu,tb_c_da.ma_phong,tb_c_da.convent as p_ca_phu_hop,COUNT(*) as dem
FROM (
SELECT tb_value.thu,tb_value.ma_phong,tb_value.da_dung,convent_ca.convent
FROM (
SELECT phan_cong_chi_tiet.thu,phan_cong_chi_tiet.ma_phong,phan_cong_chi_tiet.ma_ca,1 as da_dung FROM `phan_cong_chi_tiet`
INNER JOIN (
SELECT thiet_bi_phong.ma_phong FROM thiet_bi_phong
INNER JOIN cau_hinh ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
INNER JOIN cau_hinh_mon ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh_mon.ma_mon_hoc = "BKA_ESE"
GROUP BY thiet_bi_phong.ma_phong
) as tb_hoc_duoc
ON tb_hoc_duoc.ma_phong = phan_cong_chi_tiet.ma_phong
UNION
SELECT tb.thu,c_ma_phong.ma_phong,ca.ma_ca,0 as da_dung 
FROM ca
CROSS JOIN (
    SELECT 2 as thu UNION
    SELECT 3 as thu UNION
    SELECT 4 as thu UNION
    SELECT 5 as thu UNION
    SELECT 6 as thu UNION
    SELECT 7 as thu UNION
    SELECT 8 as thu
) as tb
CROSS JOIN (
SELECT thiet_bi_phong.ma_phong FROM thiet_bi_phong
INNER JOIN cau_hinh ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
INNER JOIN cau_hinh_mon ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh_mon.ma_mon_hoc = "BKA_ESE"
GROUP BY thiet_bi_phong.ma_phong
) as c_ma_phong
WHERE ca.ma_ca !=1
) as tb_value
INNER JOIN(
SELECT 2 as ma_ca,4 as convent,4 as gio UNION
SELECT 3 as ma_ca,4 as convent,4 as gio UNION
SELECT 4 as ma_ca,4 as convent,4 as gio UNION
SELECT 5 as ma_ca,7 as convent,4 as gio UNION
SELECT 6 as ma_ca,7 as convent,4 as gio UNION
SELECT 7 as ma_ca,7 as convent,4 as gio UNION
SELECT 4 as ma_ca,2 as convent,2 as gio UNION
SELECT 4 as ma_ca,3 as convent,2 as gio UNION
SELECT 7 as ma_ca,5 as convent,2 as gio UNION
SELECT 7 as ma_ca,6 as convent,2 as gio UNION
SELECT 2 as ma_ca,2 as convent,2 as gio UNION
SELECT 3 as ma_ca,3 as convent,2 as gio UNION
SELECT 5 as ma_ca,5 as convent,2 as gio UNION
SELECT 6 as ma_ca,6 as convent,2 as gio
) as convent_ca ON convent_ca.ma_ca = tb_value.ma_ca AND convent_ca.gio = "2"
GROUP BY tb_value.thu,tb_value.ma_phong,tb_value.da_dung,convent_ca.convent
) as tb_c_da
GROUP BY tb_c_da.thu,tb_c_da.ma_phong,tb_c_da.convent
HAVING dem = 1





///////////////////////////////////FIND

SELECT tb_cac_ca_duoc.thu,ca.*,tb_phong_hoc_duoc.ma_phong
FROM (
SELECT thu,convent as ca_phu_hop,COUNT(*) as dem
FROM (
SELECT tb1.thu,tb1.da_dung,convent_ca.convent 
FROM (
SELECT DISTINCT phan_cong_chi_tiet.thu,phan_cong_chi_tiet.ma_ca,1 as da_dung
FROM `phan_cong_chi_tiet`
INNER JOIN phan_cong on phan_cong.ma_phan_cong = phan_cong_chi_tiet.ma_phan_cong
INNER JOIN ca on ca.ma_ca = phan_cong_chi_tiet.ma_ca
WHERE (`phan_cong`.`ma_lop` = 'BKD01K10' OR `phan_cong`.`ma_nguoi_dung` = 6) AND `phan_cong`.`tinh_trang` = 0
UNION
SELECT tb.*,ca.ma_ca,0 as da_dung 
FROM ca
CROSS JOIN (
    SELECT 2 as thu UNION
    SELECT 3 as thu UNION
    SELECT 4 as thu UNION
    SELECT 5 as thu UNION
    SELECT 6 as thu UNION
    SELECT 7 as thu UNION
    SELECT 8 as thu
) as tb
WHERE ca.ma_ca !=1
) as tb1
INNER JOIN(
SELECT 2 as ma_ca,4 as convent,4 as gio UNION
SELECT 3 as ma_ca,4 as convent,4 as gio UNION
SELECT 4 as ma_ca,4 as convent,4 as gio UNION
SELECT 5 as ma_ca,7 as convent,4 as gio UNION
SELECT 6 as ma_ca,7 as convent,4 as gio UNION
SELECT 7 as ma_ca,7 as convent,4 as gio UNION
SELECT 4 as ma_ca,2 as convent,2 as gio UNION
SELECT 4 as ma_ca,3 as convent,2 as gio UNION
SELECT 7 as ma_ca,5 as convent,2 as gio UNION
SELECT 7 as ma_ca,6 as convent,2 as gio UNION
SELECT 2 as ma_ca,2 as convent,2 as gio UNION
SELECT 3 as ma_ca,3 as convent,2 as gio UNION
SELECT 5 as ma_ca,5 as convent,2 as gio UNION
SELECT 6 as ma_ca,6 as convent,2 as gio
) as convent_ca ON convent_ca.ma_ca = tb1.ma_ca AND convent_ca.gio = "4"
GROUP BY tb1.thu,tb1.da_dung,convent_ca.convent )
as tbs
GROUP BY thu,convent
HAVING dem = 1
) as tb_cac_ca_duoc
INNER JOIN (
SELECT tb_c_da.thu,tb_c_da.ma_phong,tb_c_da.convent as p_ca_phu_hop,COUNT(*) as dem
FROM (
SELECT tb_value.thu,tb_value.ma_phong,tb_value.da_dung,convent_ca.convent
FROM (
SELECT phan_cong_chi_tiet.thu,phan_cong_chi_tiet.ma_phong,phan_cong_chi_tiet.ma_ca,1 as da_dung FROM `phan_cong_chi_tiet`
INNER JOIN (
SELECT thiet_bi_phong.ma_phong FROM thiet_bi_phong
INNER JOIN cau_hinh ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
INNER JOIN cau_hinh_mon ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh_mon.ma_mon_hoc = "BKA_ESE"
GROUP BY thiet_bi_phong.ma_phong
) as tb_hoc_duoc
ON tb_hoc_duoc.ma_phong = phan_cong_chi_tiet.ma_phong
UNION
SELECT tb.thu,c_ma_phong.ma_phong,ca.ma_ca,0 as da_dung 
FROM ca
CROSS JOIN (
    SELECT 2 as thu UNION
    SELECT 3 as thu UNION
    SELECT 4 as thu UNION
    SELECT 5 as thu UNION
    SELECT 6 as thu UNION
    SELECT 7 as thu UNION
    SELECT 8 as thu
) as tb
CROSS JOIN (
SELECT thiet_bi_phong.ma_phong FROM thiet_bi_phong
INNER JOIN cau_hinh ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
INNER JOIN cau_hinh_mon ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh_mon.ma_mon_hoc = "BKA_ESE"
GROUP BY thiet_bi_phong.ma_phong
) as c_ma_phong
WHERE ca.ma_ca !=1
) as tb_value
INNER JOIN(
SELECT 2 as ma_ca,4 as convent,4 as gio UNION
SELECT 3 as ma_ca,4 as convent,4 as gio UNION
SELECT 4 as ma_ca,4 as convent,4 as gio UNION
SELECT 5 as ma_ca,7 as convent,4 as gio UNION
SELECT 6 as ma_ca,7 as convent,4 as gio UNION
SELECT 7 as ma_ca,7 as convent,4 as gio UNION
SELECT 4 as ma_ca,2 as convent,2 as gio UNION
SELECT 4 as ma_ca,3 as convent,2 as gio UNION
SELECT 7 as ma_ca,5 as convent,2 as gio UNION
SELECT 7 as ma_ca,6 as convent,2 as gio UNION
SELECT 2 as ma_ca,2 as convent,2 as gio UNION
SELECT 3 as ma_ca,3 as convent,2 as gio UNION
SELECT 5 as ma_ca,5 as convent,2 as gio UNION
SELECT 6 as ma_ca,6 as convent,2 as gio
) as convent_ca ON convent_ca.ma_ca = tb_value.ma_ca AND convent_ca.gio = "4"
GROUP BY tb_value.thu,tb_value.ma_phong,tb_value.da_dung,convent_ca.convent
) as tb_c_da
GROUP BY tb_c_da.thu,tb_c_da.ma_phong,tb_c_da.convent
HAVING dem = 1
) as tb_phong_hoc_duoc ON
tb_phong_hoc_duoc.thu = tb_cac_ca_duoc.thu AND
tb_phong_hoc_duoc.p_ca_phu_hop = tb_cac_ca_duoc.ca_phu_hop
INNER JOIN ca ON tb_cac_ca_duoc.ca_phu_hop = ca.ma_ca  
ORDER BY `tb_cac_ca_duoc`.`thu` ASC