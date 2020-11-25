<template>
    <div>
        <selectLab></selectLab>
        <br />
        <br />
        <formInsert></formInsert>
    </div>
</template>
<script>
import selectLab from "./select/SelectThietBi.vue";
import formInsert from "./form/FormInsertThietBi.vue";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Thêm thiết bị");
    },
    components: {
        selectLab,
        formInsert,
    },
};
</script>
<style lang="css" scoped>
</style>
