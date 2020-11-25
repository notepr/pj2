<template>
    <div>
        <label>Phân công</label>
        <multiselect
            v-model="phan_cong"
            :options="arr_phan_cong"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn phân công"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="true"
            :custom-label="labelPcong"
        ></multiselect>
    </div>
</template>

<script>
export default {
    created() {
        this.$store.dispatch("phan_cong/get_phan_cong");
    },
    data() {
        return {
            phan_cong: "",
        };
    },
    computed: {
        arr_phan_cong() {
            return this.$store.state.phan_cong.arr_phan_cong;
        },
    },
    methods: {
        labelPcong({ ho_ten, ma_lop, ma_mon_hoc }) {
            return `${ho_ten} - ${ma_lop} - ${ma_mon_hoc}`;
        },
    },
    watch: {
        phan_cong() {
            if (this.phan_cong) {
                this.$store
                    .dispatch(
                        "phan_cong/get_phan_cong_chi_tiet",
                        this.phan_cong.ma_phan_cong
                    )
                    .then(
                        this.$emit("emit_data", 1, this.phan_cong.ma_phan_cong)
                    );
            } else {
                this.$emit("emit_data", 0);
                this.$store.commit("phan_cong/reset_arr_phan_cong_ct");
            }
        },
    },
};
</script>

<style>
</style>