<template>
    <formInsert></formInsert>
</template>
<script>
import formInsert from "./form/FormInsertLab";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Thêm Phòng");
    },
    components: {
        formInsert,
    },
};
</script>
<style scoped>
</style>
