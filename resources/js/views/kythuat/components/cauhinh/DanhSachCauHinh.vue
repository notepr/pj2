<template>
    <cauHinhTable></cauHinhTable>
</template>

<script>
import cauHinhTable from "./table/CauHinhTable";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Danh sách cấu hình");
    },
    components: {
        cauHinhTable,
    },
};
</script>

<style>
</style>