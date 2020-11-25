<template>
    <formUpdate></formUpdate>
</template>

<script>
import formUpdate from "./form/FormUpdateLab";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Cập nhập thông tin lab");
    },
    components: {
        formUpdate,
    },
};
</script>

<style>
</style>