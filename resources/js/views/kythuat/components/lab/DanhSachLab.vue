<template>
    <div>
        <selectLab></selectLab>
        <labTable v-if="table_lab" :arr_lab="arr_lab"></labTable>
    </div>
</template>
<script>
import selectLab from "./select/SelectLab.vue";
import labTable from "./table/LabTable";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Danh sách phòng");
    },
    computed: {
        arr_lab() {
            return this.$store.state.lab.arr_lab;
        },
    },
    data() {
        return {
            table_lab: false,
        };
    },
    methods: {},
    watch: {
        arr_lab() {
            if (this.arr_lab.length != 0) {
                this.table_lab = true;
            } else {
                this.table_lab = false;
            }
        },
    },
    components: {
        selectLab,
        labTable,
    },
};
</script>
<style lang="css" scoped>
</style>
