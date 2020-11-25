<template>
    <div>
        <selectLab></selectLab>
        <br />
        <tablethietbi v-if="show_table_tbi" :arr_thiet_bi="arr_thiet_bi"></tablethietbi>
    </div>
</template>

<script>
import selectLab from "./select/SelectThietBi.vue";
import tablethietbi from "./table/TableThietBi.vue";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Danh sách thiết bị");
    },
    computed: {
        arr_thiet_bi() {
            return this.$store.state.thiet_bi.arr_thiet_bi;
        },
    },
    data() {
        return {
            show_table_tbi: false,
        };
    },
    watch: {
        arr_thiet_bi() {
            if (this.arr_thiet_bi.length != 0) {
                this.show_table_tbi = true;
            } else {
                this.show_table_tbi = false;
            }
        },
    },
    components: {
        tablethietbi,
        selectLab,
    },
};
</script>
<style lang="css" scoped>
</style>
