<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <selectGiaovien :is_giao_vien="is_giao_vien"></selectGiaovien>
                        <br />
                        <span
                            v-if="lich_lam_viec.length == 0"
                            class="font-weight-bold"
                        >{{empty_message}}</span>
                        <lichLamViec v-if="show_lich_lam_viec" :lich_lam_viec="lich_lam_viec"></lichLamViec>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import selectGiaovien from "./components/SelectGiaoVien.vue";
import lichLamViec from "./components/LichLamViec.vue";

export default {
    created() {
        if (!this.$store.state.user.is_giao_vien) {
            // phan cong
            this.$store.dispatch("user/get_all_user");
        } else {
            // neu la giao vien get phan cong theo ma
            this.$store.dispatch("user/get_self_info");
        }
    },
    mounted() {
        if (this.$route.path == "/lich_lam_viec") {
            this.$store.commit("content/page_title", "Xem lịch làm việc");
        }
    },
    data() {
        return {
            show_lich_lam_viec: false,
        };
    },
    computed: {
        is_giao_vien() {
            return this.$store.state.user.is_giao_vien;
        },
        lich_lam_viec() {
            return this.$store.state.giao_vien.lich_lam_viec;
        },
        empty_message() {
            return this.$store.state.giao_vien.lich_ket_thuc;
        },
    },
    watch: {
        $route(to, from) {
            this.$store.commit("content/page_title", "Xem lịch làm việc");
        },
        lich_lam_viec() {
            if (this.lich_lam_viec.length != 0) {
                this.show_lich_lam_viec = true;
            } else {
                this.show_lich_lam_viec = false;
            }
        },
    },
    methods: {},
    components: {
        lichLamViec,
        selectGiaovien,
    },
};
</script>
<style lang="css" scoped>
</style>
