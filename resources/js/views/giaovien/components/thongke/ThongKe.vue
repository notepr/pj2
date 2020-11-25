<template>
    <div>
        <p class="font-weight-bold">{{lich_ket_thuc}}</p>
    </div>
</template>

<script>
export default {
    computed: {
        lich_ket_thuc() {
            return this.$store.state.giao_vien.lich_ket_thuc;
        },
    },
    data() {
        return {};
    },
};
</script>

<style lang="css" scoped>
</style>