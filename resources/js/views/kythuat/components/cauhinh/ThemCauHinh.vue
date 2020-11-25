<template>
    <formInsert></formInsert>
</template>

<script>
import formInsert from "./form/FormInsertCauHinh";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Thêm cấu hình");
    },
    components: {
        formInsert,
    },
};
</script>

<style>
</style>