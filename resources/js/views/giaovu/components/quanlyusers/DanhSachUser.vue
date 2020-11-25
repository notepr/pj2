<template>
    <userTable></userTable>
</template>

<script>
import userTable from "./table/TableUser";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Danh sách người dùng");
    },
    components: {
        userTable,
    },
};
</script>

<style>
</style>