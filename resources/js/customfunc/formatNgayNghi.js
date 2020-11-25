export default function formatNgayNghi(arr) {
    var arr_ngay_nghi = [];
    for (const each in arr) {
        for (let i = 0; i < arr[each].length; i++) {
            var clone_obj = {
                date: each,
                ...arr[each][i],
                btn:
                    each +
                    arr[each][i].ca[0].ma_ca +
                    Math.floor(Math.random() * 10000)
            };
            arr_ngay_nghi.push(clone_obj);
        }
    }
    return arr_ngay_nghi.reverse();
}
