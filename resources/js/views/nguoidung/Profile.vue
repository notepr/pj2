<template>
    <formUpdateProfile></formUpdateProfile>
</template>

<script>
import formUpdateProfile from "./components/profile/FormUpdateProfile";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Thông tin người dùng");
    },
    components: {
        formUpdateProfile,
    },
};
</script>

<style>
</style>