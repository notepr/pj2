<template>
    <div class="card">
        <div class="card-header card-header-info">
            <h4 class="card-title">Bảng phân công chi tiết</h4>
        </div>
        <div class="card-body table-responsive">
            <vue-good-table
                :columns="columns"
                :rows="arr_phan_cong_ct"
                :search-options="{enabled: true}"
                styleClass="vgt-table"
            >
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'ma_ca'">
                        <button
                            class="btn btn-info"
                            @click="delete_pc_ct(props.row)"
                            v-tooltip.top="'Xóa'"
                        >
                            <i class="material-icons">delete</i>
                        </button>
                    </span>
                </template>
                <div
                    slot="emptystate"
                    class="font-weight-bold"
                >Chưa có lịch dạy cho thời khóa biểu trên</div>
            </vue-good-table>
        </div>
    </div>
</template>

<script>
export default {
    props: ["ma_phan_cong"],
    computed: {
        arr_phan_cong_ct() {
            return this.$store.state.phan_cong.arr_phan_cong_ct;
        },
    },
    data() {
        return {
            columns: [
                {
                    label: "Thứ",
                    field: "thu",
                    type: "number",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Tên phòng",
                    field: "ten_phong",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Giờ bắt đầu",
                    field: "gio_bat_dau",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Giờ kết thúc",
                    field: "gio_ket_thuc",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Tùy chỉnh",
                    field: "ma_ca",
                    thClass: "text-info",
                },
            ],
            selected_rows: [],
        };
    },
    methods: {
        delete_pc_ct(row) {
            this.$store.dispatch("phan_cong/delete_phan_cong_chi_tiet", {
                user_input: row,
                ma_phan_cong: this.ma_phan_cong,
            });
        },
    },
};
</script>

<style scoped>
</style>