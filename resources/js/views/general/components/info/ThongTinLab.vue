<template>
    <div>
        <br />
        <p class="font-weight-bold">Số chỗ ngồi: {{so_cho_ngoi}}</p>
        <p class="font-weight-bold">Tình trạng: {{tinh_trang}}</p>
    </div>
</template>

<script>
export default {
    computed: {
        so_cho_ngoi() {
            return this.$store.state.lab.info_lab.so_cho_ngoi;
        },
        tinh_trang() {
            return this.$store.state.lab.info_lab.tinh_trang.ten_tinh_trang;
        },
    },
    data() {
        return {};
    },
};
</script>

<style lang="css" scoped>
</style>