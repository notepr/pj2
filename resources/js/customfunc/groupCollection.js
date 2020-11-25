export default function groupCollection(arr, prop) {
    var arr_key = [];
    var result_arr = [];

    for (var e of arr) {
        // if dành cho thứ nếu không dùng có thể bỏ
        if (e[prop] != 8) {
            arr_key.push(e[prop]);
        }
    }

    arr_key = [...new Set(arr_key)];

    for (var i = 0; i < arr_key.length; i++) {
        var child_obj = {
            children: [],
            mode: "span" // mode span chỉ dành cho phân công chi tiết, có thể bỏ
        };

        if (prop == "thu") {
            child_obj.label = "Thứ " + arr_key[i]; // label chỉ dành cho phân công chi tiết, có thể bỏ
        } else if (prop == "ngay") {
            child_obj.label = "Ngày " + arr_key[i]; // label chỉ dành cho phân công chi tiết, có thể bỏ
        }

        for (e of arr) {
            if (e[prop] == arr_key[i]) {
                child_obj.children.push(e);
            }
        }

        result_arr.push(child_obj);
    }
    return result_arr;
}
