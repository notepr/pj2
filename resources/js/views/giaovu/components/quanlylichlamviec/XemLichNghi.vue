<template>
    <div>
        <thongKeLichNghi></thongKeLichNghi>
        <selectGiaoVien></selectGiaoVien>
        <br />
        <tableLichNghi></tableLichNghi>
    </div>
</template>

<script>
import thongKeLichNghi from "./thongke/ThongKeLichNghi";
import selectGiaoVien from "./select/SelectNgayNghi";
import tableLichNghi from "./table/TableLichNghi";

export default {
    created() {
        this.$store.dispatch("ngay_nghi/get_ngay_nghi");
    },
    mounted() {
        this.$store.commit("content/page_title", "Xem lịch nghỉ");
    },
    data() {
        return {};
    },
    components: {
        thongKeLichNghi,
        selectGiaoVien,
        tableLichNghi,
    },
};
</script>

<style>
</style>