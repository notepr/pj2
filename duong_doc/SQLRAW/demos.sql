SET @ngay = '2020-08-15',@ma_gv = 6,@ma_lop='BKD01K10',@gio=4,@ma_mon = 'BKA_ESE';
/*Lấy ra các ca có đã dùng =0 không bị trùng với đã dùng = 1 */
SELECT * FROM (
/*Lấy ra lịch bận của lớp cũng như giáo viên*/
SELECT DISTINCT tbs.thu,tbs.convent as ma_ca,p_phu_hop.ma_phong,1 as da_dung FROM (
SELECT DISTINCT tb1.thu,tb1.ma_nguoi_dung,convent_ca.convent,convent_ca.gio,tb1.da_dung FROM (
SELECT phan_cong_chi_tiet.thu,phan_cong_chi_tiet.ma_ca,phan_cong.ma_nguoi_dung,1 as da_dung FROM `phan_cong_chi_tiet` 
INNER JOIN phan_cong ON phan_cong.ma_phan_cong = phan_cong_chi_tiet.ma_phan_cong 
AND phan_cong.tinh_trang = 0
AND(
phan_cong.ma_lop = @ma_lop OR phan_cong.ma_nguoi_dung = @ma_gv
)
WHERE phan_cong_chi_tiet.thu = WEEKDAY(@ngay)+2
UNION
SELECT DISTINCT WEEKDAY(ngay_nghi.ngay)+2 as thu,ngay_nghi.ma_ca,
CASE
    WHEN ngay_nghi.ma_giao_vien = 0 THEN @ma_gv
    ELSE ngay_nghi.ma_giao_vien
END as ma_giao_vien
,2 as da_dung FROM `ngay_nghi`
WHERE ngay_nghi.ma_giao_vien IN (
    SELECT phan_cong.ma_nguoi_dung FROM phan_cong
    WHERE phan_cong.tinh_trang = 0
    AND(
    phan_cong.ma_lop = @ma_lop OR phan_cong.ma_nguoi_dung = @ma_gv
    )
    UNION SELECT 0
) AND ngay_nghi.tinh_trang = 1 AND ngay_nghi.ngay = @ngay
UNION
/*Lấy ra lịch dạy bổ sung của giáo viên hoặc lớp nếu có theo ngày*/
SELECT WEEKDAY(lich_day_bo_sung.ngay)+2 as thu,lich_day_bo_sung.ma_ca,lich_day_bo_sung.ma_nguoi_dung as ma_giao_vien,1 as da_dung
FROM `lich_day_bo_sung` WHERE (lich_day_bo_sung.ma_lop = @ma_lop OR lich_day_bo_sung.ma_nguoi_dung = @ma_gv)
AND lich_day_bo_sung.tinh_trang = 1
AND lich_day_bo_sung.ngay = @ngay
) as tb1
/*JOIN để chuyển đổi ca*/
INNER JOIN(
    SELECT 1 as ma_ca,4 as convent,4 as gio UNION
    SELECT 1 as ma_ca,7 as convent,4 as gio UNION
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
    SELECT 1 as ma_ca,2 as convent,2 as gio UNION
    SELECT 1 as ma_ca,3 as convent,2 as gio UNION
    SELECT 1 as ma_ca,5 as convent,2 as gio UNION
    SELECT 1 as ma_ca,6 as convent,2 as gio UNION
    SELECT 6 as ma_ca,6 as convent,2 as gio
) as convent_ca ON convent_ca.ma_ca = tb1.ma_ca AND convent_ca.gio = @gio
GROUP BY tb1.ma_nguoi_dung,convent_ca.convent
/*Lấy ra lịch bận phù hợp*/
HAVING COUNT(*) = 2 OR (COUNT(*) = 1 AND (tb1.da_dung = 1 OR tb1.ma_nguoi_dung = @ma_gv))
) as tbs
/*Tiến hành join vì nếu giáo viên bận hoặc lớp có học thì sẽ không thể dạy ở bất kì phòng nào khác*/
CROSS JOIN (
    /*lay ra cac phong hoc duoc mon */
    SELECT p.ma_phong
    FROM phong as p
    HAVING (
    SELECT cau_hinh_mon.ma_mon_hoc FROM cau_hinh_mon WHERE cau_hinh_mon.ma_cau_hinh = (
        /*Trả về cấu hình của phòng học tương ứng*/
        SELECT thiet_bi_phong.ma_cau_hinh FROM `thiet_bi_phong`
        INNER JOIN cau_hinh ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
        WHERE ma_phong = p.ma_phong
        GROUP BY ma_cau_hinh
        ORDER BY COUNT(*) DESC
        LIMIT 1
    ) AND cau_hinh_mon.ma_mon_hoc = @ma_mon
    ) = @ma_mon
) as p_phu_hop
UNION
/*Lấy ra lịch học của từng phòng loại trừ nếu giáo viên đã nghỉ*/
SELECT DISTINCT tb2.thu,convent_ca.convent as ma_ca,tb2.ma_phong,tb2.da_dung FROM (
SELECT phan_cong_chi_tiet.thu,phan_cong_chi_tiet.ma_ca,phan_cong.ma_nguoi_dung as ma_giao_vien,phan_cong_chi_tiet.ma_phong,1 as da_dung FROM phan_cong_chi_tiet
INNER JOIN phan_cong ON phan_cong.ma_phan_cong = phan_cong_chi_tiet.ma_phan_cong 
AND phan_cong.tinh_trang = 0 AND phan_cong.ma_lop <> @ma_lop AND phan_cong.ma_nguoi_dung <> @ma_gv
WHERE phan_cong_chi_tiet.thu = WEEKDAY(@ngay)+2
UNION
SELECT WEEKDAY(lich_day_bo_sung.ngay)+2 as thu,lich_day_bo_sung.ma_ca,lich_day_bo_sung.ma_nguoi_dung as ma_giao_vien,lich_day_bo_sung.ma_phong,1 as da_dung
FROM `lich_day_bo_sung` WHERE lich_day_bo_sung.ma_lop <> @ma_lop 
AND lich_day_bo_sung.ma_nguoi_dung <> @ma_gv
AND lich_day_bo_sung.tinh_trang = 1
AND lich_day_bo_sung.ngay = @ngay
UNION
SELECT DISTINCT WEEKDAY(ngay_nghi.ngay)+2 as thu,ngay_nghi.ma_ca,ngay_nghi.ma_giao_vien,0 as ma_phong,2 as da_dung FROM `ngay_nghi`
WHERE ngay_nghi.tinh_trang = 1 
AND ngay_nghi.ma_giao_vien NOT IN (0,@ma_gv)
AND ngay_nghi.ngay = @ngay
) as tb2
/*JOIN để chuyển đổi ca*/
INNER JOIN(
    SELECT 1 as ma_ca,4 as convent,4 as gio UNION
    SELECT 1 as ma_ca,7 as convent,4 as gio UNION
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
    SELECT 1 as ma_ca,2 as convent,2 as gio UNION
    SELECT 1 as ma_ca,3 as convent,2 as gio UNION
    SELECT 1 as ma_ca,5 as convent,2 as gio UNION
    SELECT 1 as ma_ca,6 as convent,2 as gio UNION
    SELECT 6 as ma_ca,6 as convent,2 as gio
) as convent_ca ON convent_ca.ma_ca = tb2.ma_ca AND convent_ca.gio = @gio
GROUP BY tb2.ma_giao_vien,convent_ca.convent
HAVING COUNT(*) = 1 AND tb2.da_dung = 1 AND tb2.ma_phong IN (
    /*lay ra cac phong hoc duoc mon */
    SELECT p.ma_phong
    FROM phong as p
    HAVING (
    SELECT cau_hinh_mon.ma_mon_hoc FROM cau_hinh_mon WHERE cau_hinh_mon.ma_cau_hinh = (
        /*Trả về cấu hình của phòng học tương ứng*/
        SELECT thiet_bi_phong.ma_cau_hinh FROM `thiet_bi_phong`
        INNER JOIN cau_hinh ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
        WHERE ma_phong = tb2.ma_phong
        GROUP BY ma_cau_hinh
        ORDER BY COUNT(*) DESC
        LIMIT 1
    ) AND cau_hinh_mon.ma_mon_hoc = @ma_mon
    ) = @ma_mon
)
UNION 
/*Lấy tất cả các giờ học có thể của phòng phù hợp*/
SELECT t_thu.thu,t_ca.ma_ca,p_phu_hop.ma_phong,0 as da_dung FROM (
SELECT p.ma_phong,
(SELECT thiet_bi_phong.ma_cau_hinh FROM `thiet_bi_phong`
INNER JOIN cau_hinh ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
WHERE ma_phong = p.ma_phong
GROUP BY ma_cau_hinh
ORDER BY COUNT(*) DESC
LIMIT 1) as cau_hinh
FROM phong as p
HAVING cau_hinh IS NOT NULL AND (
SELECT cau_hinh_mon.ma_mon_hoc FROM cau_hinh_mon WHERE cau_hinh_mon.ma_cau_hinh = cau_hinh AND cau_hinh_mon.ma_mon_hoc = @ma_mon
) = @ma_mon
)as p_phu_hop
/*cross join để thêm thứ cho tất cả các phòng lấy ra được*/
CROSS JOIN (
    SELECT WEEKDAY(@ngay)+2 as thu
) as t_thu
/*cross join để thêm ca vào các phòng*/
CROSS JOIN (
    SELECT * FROM (
        SELECT 2 as ma_ca,2 as gio UNION
        SELECT 3 as ma_ca,2 as gio UNION
        SELECT 5 as ma_ca,2 as gio UNION
        SELECT 6 as ma_ca,2 as gio UNION
        SELECT 4 as ma_ca,4 as gio UNION
        SELECT 7 as ma_ca,4 as gio
    ) as ca_ao
    WHERE ca_ao.gio = @gio
) as t_ca
) as t_final
GROUP BY t_final.ma_phong,t_final.ma_ca
HAVING COUNT(*) = 1