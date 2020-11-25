<template>
    <div>
        <formInsertLichNghi></formInsertLichNghi>
    </div>
</template>

<script>
import formInsertLichNghi from "./form/FormThemLichNghi";
export default {
    mounted() {
        this.$store.commit("content/page_title", "Thêm lịch nghỉ");
    },
    components: {
        formInsertLichNghi,
    },
};
</script>

<style>
</style>