import getCurrentDate from "./getCurrentDate";

export default function formatEvents(arr, phan_cong) {
    var result_arr = [];

    if (phan_cong) {
        for (const each in arr) {
            var clone_obj = {};
            clone_obj.start = arr[each].ngay + `T${arr[each].gio_bat_dau}`;
            clone_obj.end = arr[each].ngay + `T${arr[each].gio_ket_thuc}`;
            clone_obj.className = "fc-event-title-fix";

            var current = Date.parse(getCurrentDate("all"));
            var check = Date.parse(arr[each].ngay);

            if (check < current) {
                clone_obj.backgroundColor = "gray";
            }

            result_arr.push(clone_obj);
        }
        return result_arr;
    }

    for (const each in arr) {
        for (let i = 0; i < arr[each].length; i++) {
            var clone_obj = {};
            clone_obj.start =
                arr[each][i].ngay + `T${arr[each][i].gio_bat_dau}`;
            clone_obj.end = arr[each][i].ngay + `T${arr[each][i].gio_ket_thuc}`;
            clone_obj.title = arr[each][i].nghi
                ? "Nghỉ"
                : !arr[each][i].ma_lop
                ? `${arr[each][i].hoat_dong}`
                : `${arr[each][i].ma_lop} - ${arr[each][i].ma_mon_hoc}`;

            var current = Date.parse(getCurrentDate("all"));
            var check = Date.parse(arr[each][i].ngay);

            if (check < current) {
                clone_obj.backgroundColor = "gray";
            } else if (clone_obj.title == "Nghỉ") {
                clone_obj.backgroundColor = "#2C3E50";
            }

            result_arr.push(clone_obj);
        }
    }
    return result_arr;
}
