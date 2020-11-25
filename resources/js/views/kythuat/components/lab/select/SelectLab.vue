<template>
    <div>
        <label>Tòa</label>
        <multiselect
            v-model="toa"
            :options="arr_toa"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn tòa"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="false"
            :custom-label="toaLabel"
        ></multiselect>
        <br />
        <label>Tầng</label>
        <multiselect
            v-model="tang"
            :options="arr_tang"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn tầng"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="false"
            :custom-label="tangLabel"
        >
            <template slot="noOptions">Chưa chọn tòa</template>
        </multiselect>
        <br />
    </div>
</template>
<script>
export default {
    created() {
        this.$store.dispatch("toa/get_toa");
    },
    data() {
        return {
            toa: "",
            tang: "",
        };
    },
    computed: {
        arr_toa() {
            return this.$store.state.toa.arr_toa;
        },
        arr_tang() {
            return this.$store.state.tang.arr_tang;
        },
    },
    methods: {
        toaLabel({ ten_toa, dia_chi }) {
            return `${ten_toa} - ${dia_chi}`;
        },
        tangLabel({ ten_tang }) {
            return `${ten_tang}`;
        },
    },
    watch: {
        toa() {
            this.tang = "";
            if (!this.toa) {
                this.$store.commit("tang/reset_arr_tang");
                return false;
            }
            this.$store.dispatch("tang/get_tang", this.toa.ma_toa);
        },
        tang() {
            if (!this.tang) {
                this.$store.commit("lab/reset_arr_lab");
                return false;
            }
            this.$store.dispatch("lab/get_lab", this.tang.ma_tang);
        },
        arr_toa() {
            if (this.arr_toa.length != 0) {
                this.toa = this.arr_toa[0];
            }
        },
    },
};
</script>
<style lang="css" scoped>
</style>
