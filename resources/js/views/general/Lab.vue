<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <button
                            class="btn btn-info"
                            data-toggle="modal"
                            data-target="#exampleModal"
                            @click="get_all_lab_calendar"
                        >Xem lịch sử dụng tất cả các phòng</button>
                        <br />
                        <br />
                        <!-- <thongKe></thongKe> -->
                        <selectlab></selectlab>
                        <lichSuDung v-if="show_lab_calendar" :lich_su_dung="lich_su_dung"></lichSuDung>
                        <formAllLab></formAllLab>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import selectlab from "./components/SelectLab.vue";
import lichSuDung from "./components/LichSuDung.vue";
import thongKe from "./components/ThongKe.vue";
import formAllLab from "./components/form/FormCheckAllLab";

export default {
    mounted() {
        this.$store.commit("content/page_title", "Xem thông tin lab");
    },
    data() {
        return {
            show_lab_calendar: false,
        };
    },
    computed: {
        lich_su_dung() {
            return this.$store.state.lab.lich_su_dung;
        },
    },
    methods: {
        get_all_lab_calendar() {
            this.$store.dispatch("lab/get_all_calendar");
        },
    },
    watch: {
        lich_su_dung() {
            if (this.lich_su_dung.length != 0) {
                this.show_lab_calendar = true;
            } else {
                this.show_lab_calendar = false;
            }
        },
    },
    components: {
        lichSuDung,
        selectlab,
        thongKe,
        formAllLab,
    },
};
</script>
<style lang="css" scoped>
</style>
