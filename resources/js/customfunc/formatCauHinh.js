export default function formatNgayNghi(arr) {
    var arr_cau_hinh = [];
    for (const each in arr) {
        var clone_obj = {
            ma_cau_hinh: arr[each].ma_cau_hinh,
            cpu: "Trống",
            ram: "Trống",
            main: "Trống",
            o_cung: "Trống",
            vga: "Trống"
        };

        var raw_arr = arr[each].mo_ta.split("");

        var ram_index = 0;
        var main_index = 0;
        var hd_index = 0;
        var vga_index = 0;

        ram_index = arr[each].mo_ta.indexOf("RAM");
        main_index = arr[each].mo_ta.indexOf("MAIN");
        hd_index = arr[each].mo_ta.indexOf("O_CUNG");
        vga_index = arr[each].mo_ta.indexOf("VGA");

        if (ram_index > 0) {
            raw_arr.splice(ram_index - 1, 1, "spl");
        }

        if (main_index > 0) {
            raw_arr.splice(main_index - 1, 1, "spl");
        }

        if (hd_index > 0) {
            raw_arr.splice(hd_index - 1, 1, "spl");
        }

        if (vga_index > 0) {
            raw_arr.splice(vga_index - 1, 1, "spl");
        }

        raw_arr = raw_arr.join("").split("spl");

        clone_obj.cpu = raw_arr[0].slice(4);

        for (let i = 1; i < raw_arr.length; i++) {
            if (i == 1 && raw_arr[i].includes("RAM") && raw_arr[i].length > 4) {
                clone_obj.ram = raw_arr[i].slice(4);
            } else if (i == 1 && raw_arr[i].includes("RAM")) {
                clone_obj.ram = "Trống";
            }

            if (
                i == 2 &&
                raw_arr[i].includes("MAIN") &&
                raw_arr[i].length > 5
            ) {
                clone_obj.main = raw_arr[i].slice(5);
            } else if (i == 2 && raw_arr[i].includes("MAIN")) {
                clone_obj.main = "Trống";
            }

            if (
                i == 3 &&
                raw_arr[i].includes("O_CUNG") &&
                raw_arr[i].length > 7
            ) {
                clone_obj.o_cung = raw_arr[i].slice(7);
            } else if (i == 3 && raw_arr[i].includes("O_CUNG")) {
                clone_obj.o_cung = "Trống";
            }

            if (i == 4 && raw_arr[i].includes("VGA") && raw_arr[i].length > 4) {
                clone_obj.vga = raw_arr[i].slice(4);
            } else if (i == 4 && raw_arr[i].includes("VGA")) {
                clone_obj.vga = "Trống";
            }
        }

        arr_cau_hinh.push(clone_obj);
    }

    return arr_cau_hinh;
}
