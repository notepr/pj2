<template>
    <div>
        <formThemLichDay @data_up="pass_data" @show_table="show_table" @hide_table="hide_table"></formThemLichDay>
        <br />
        <tableDeXuat
            :ma_gv="ma_gv"
            :ma_mon="ma_mon"
            :ma_lop="ma_lop"
            v-if="table"
            @hide_table="hide_table"
        ></tableDeXuat>
    </div>
</template>

<script>
import formThemLichDay from "./form/formDeXuat";
import tableDeXuat from "./table/TableDeXuatLichDay";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Thêm lịch làm việc");
    },
    data() {
        return {
            table: false,
            ma_gv: "",
            ma_mon: "",
            ma_lop: "",
        };
    },
    methods: {
        pass_data(ma_gv, ma_mon, ma_lop) {
            this.ma_gv = ma_gv;
            this.ma_mon = ma_mon;
            this.ma_lop = ma_lop;
        },
        hide_table() {
            this.table = false;
        },
        show_table() {
            this.table = true;
        },
    },
    components: {
        formThemLichDay,
        tableDeXuat,
    },
};
</script>

<style>
</style>