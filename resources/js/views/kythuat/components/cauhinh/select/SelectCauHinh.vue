<template>
    <div>
        <label>Cấu hình</label>
        <multiselect
            v-model="current_cau_hinh"
            :options="arr_cau_hinh"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn cấu hình"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="true"
            :custom-label="labelCauHinh"
        ></multiselect>
    </div>
</template>

<script>
export default {
    created() {
        this.$store.dispatch("cau_hinh/get_cau_hinh");
    },
    computed: {
        arr_cau_hinh() {
            return this.$store.state.cau_hinh.arr_cau_hinh;
        },
        current_cau_hinh: {
            get() {
                return this.$store.state.cau_hinh.arr_cau_hinh.filter(
                    (each) => each.ma_cau_hinh == this.$route.params.ma_cau_hinh
                );
            },
            set(val) {
                this.cau_hinh = val;
            },
        },
    },
    data() {
        return {
            cau_hinh: "",
        };
    },
    watch: {
        cau_hinh() {
            if (this.cau_hinh) {
                this.$router.push(
                    `/quan_ly_cau_hinh/update_cau_hinh/${this.cau_hinh.ma_cau_hinh}`
                );
                this.$store.dispatch(
                    "cau_hinh/get_thong_tin_cau_hinh",
                    this.cau_hinh.ma_cau_hinh
                );
                this.$store.dispatch(
                    "mon/get_mon_by_cau_hinh",
                    this.cau_hinh.ma_cau_hinh
                );
            } else {
                this.$store.commit("cau_hinh/reset_thong_tin_cau_hinh");
                this.$router.push(`/quan_ly_cau_hinh/update_cau_hinh/`);
                this.$store.commit("mon/reset_arr_mon_by_cau_hinh");
            }
        },
    },
    methods: {
        labelCauHinh({ cpu, ram, main, o_cung, vga }) {
            return `Cpu: ${cpu} - RAM: ${ram} - Main: ${main} -  Ổ cứng: ${o_cung} - VGA: ${vga}`;
        },
    },
};
</script>

<style>
</style>