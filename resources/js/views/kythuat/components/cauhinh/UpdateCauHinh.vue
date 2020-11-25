<template>
    <div>
        <selectCauHinh></selectCauHinh>
        <br />
        <br />
        <!-- form modi -->
        <formUpdate></formUpdate>
    </div>
</template>
<script>
import selectCauHinh from "./select/SelectCauHinh";
import formUpdate from "./form/FormUpdateCauHinh";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Tùy chỉnh cấu hình");
    },
    data() {
        return {};
    },
    components: {
        formUpdate,
        selectCauHinh,
    },
};
</script>
<style lang="css" scoped>
</style>
