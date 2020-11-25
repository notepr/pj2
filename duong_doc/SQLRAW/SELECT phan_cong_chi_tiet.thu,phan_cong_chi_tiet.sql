SELECT phan_cong_chi_tiet.thu,phan_cong_chi_tiet.ma_ca,phan_cong_chi_tiet.ma_phong,1 as da_dung
FROM `phan_cong_chi_tiet`
INNER JOIN phan_cong ON
phan_cong_chi_tiet.ma_phan_cong = phan_cong.ma_phan_cong
WHERE (phan_cong_chi_tiet.ma_phong IN (
SELECT thiet_bi_phong.ma_phong FROM thiet_bi_phong
INNER JOIN cau_hinh ON 
cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
INNER JOIN cau_hinh_mon ON 
cau_hinh_mon.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh_mon.ma_mon_hoc = 'BKA_HAT_AV1'
GROUP BY thiet_bi_phong.ma_phong
)
) OR (
(phan_cong.ma_lop = 'BKD01K10' OR phan_cong.ma_nguoi_dung=6)
AND phan_cong.tinh_trang = 0
)

SELECT tb_value.thu,tb_value.ma_phong,tb_value.da_dung,convent_ca.convent FROM
(SELECT tb.thu,c_ma_phong.ma_phong,ca.ma_ca,0 as da_dung
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
INNER JOIN cau_hinh_mon ON cau_hinh_mon.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh_mon.ma_mon_hoc = 'BKA_HAT_AV1') as c_ma_phong
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
) as convent_ca ON convent_ca.ma_ca = tb_value.ma_ca AND convent_ca.gio =4
GROUP BY tb_value.thu,tb_value.ma_phong,tb_value.da_dung,convent_ca.convent



done

SELECT tb_all.thu,tb_all.ma_phong,tb_all.convent,COUNT(*) as dem FROM (
(SELECT tb_pcct.thu,tb_pcct.ma_phong,tb_pcct.da_dung,convent_ca.convent FROM (
SELECT phan_cong_chi_tiet.thu,phan_cong_chi_tiet.ma_ca,phan_cong_chi_tiet.ma_phong,1 as da_dung
FROM `phan_cong_chi_tiet`
INNER JOIN phan_cong ON
phan_cong_chi_tiet.ma_phan_cong = phan_cong.ma_phan_cong
WHERE (phan_cong_chi_tiet.ma_phong IN (
SELECT thiet_bi_phong.ma_phong FROM thiet_bi_phong
INNER JOIN cau_hinh ON 
cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
INNER JOIN cau_hinh_mon ON 
cau_hinh_mon.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh_mon.ma_mon_hoc = 'BKA_HAT_AV1'
GROUP BY thiet_bi_phong.ma_phong
)
) OR (
(phan_cong.ma_lop = 'BKD01K10' OR phan_cong.ma_nguoi_dung=6)
AND phan_cong.tinh_trang = 0
)
) tb_pcct 
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
) as convent_ca ON convent_ca.ma_ca = tb_pcct.ma_ca AND convent_ca.gio =2
GROUP BY tb_pcct.thu,tb_pcct.ma_phong,tb_pcct.da_dung,convent_ca.convent)
UNION
(SELECT tb_value.thu,tb_value.ma_phong,tb_value.da_dung,convent_ca.convent FROM
(SELECT tb.thu,c_ma_phong.ma_phong,ca.ma_ca,0 as da_dung
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
INNER JOIN cau_hinh_mon ON cau_hinh_mon.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh_mon.ma_mon_hoc = 'BKA_HAT_AV1') as c_ma_phong
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
) as convent_ca ON convent_ca.ma_ca = tb_value.ma_ca AND convent_ca.gio =2
GROUP BY tb_value.thu,tb_value.ma_phong,tb_value.da_dung,convent_ca.convent)
) as tb_all
GROUP BY tb_all.thu,tb_all.ma_phong,tb_all.convent
HAVING dem = 1