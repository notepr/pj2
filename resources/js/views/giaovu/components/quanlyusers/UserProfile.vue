<template>
    <div>
        <formUpdateProfile></formUpdateProfile>
        <notifications group="modi_success" />
    </div>
</template>

<script>
import formUpdateProfile from "./form/FormUpdateProfile";

export default {
    mounted() {
        this.$store.commit(
            "content/page_title",
            "Tùy chỉnh thông tin người dùng"
        );
    },
    components: {
        formUpdateProfile,
    },
};
</script>

<style>
</style>