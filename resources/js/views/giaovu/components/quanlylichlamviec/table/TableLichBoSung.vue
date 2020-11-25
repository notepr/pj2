<template>
    <div class="card">
        <div class="card-header card-header-info">
            <h4 class="card-title">Bảng danh sách lịch dạy bổ sung</h4>
        </div>
        <div class="card-body table-responsive">
            <vue-good-table
                :columns="columns"
                :rows="arr_lich_bo_sung"
                :search-options="{enabled: true}"
                styleClass="vgt-table"
            >
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'ma_lich_day_bo_sung'">
                        <button
                            class="btn btn-info"
                            @click="delete_lich_bo_sung(props.row)"
                            v-tooltip.top="'Xóa'"
                        >
                            <i class="material-icons">delete</i>
                        </button>
                    </span>
                </template>
                <div
                    slot="emptystate"
                    class="font-weight-bold"
                >Giáo viên chưa có lịch dạy bổ sung nào</div>
            </vue-good-table>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        arr_lich_bo_sung() {
            return this.$store.state.de_xuat.arr_lich_bo_sung;
        },
    },
    data() {
        return {
            columns: [
                {
                    label: "Ngày",
                    field: "ngay",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Lớp",
                    field: "ma_lop",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Ca",
                    field: this.formatCa,
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                    sortable: false,
                },
                {
                    label: "Phòng",
                    field: "phong.ten_phong",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Tùy chỉnh",
                    field: "ma_lich_day_bo_sung",
                    sortable: false,
                    thClass: "text-info",
                },
            ],
        };
    },
    methods: {
        formatCa(row) {
            return `${row.ca.ma_ca} (${row.ca.gio_bat_dau} - ${row.ca.gio_ket_thuc})`;
        },
        delete_lich_bo_sung(row) {
            this.$store.dispatch(
                "de_xuat/delete_lich_bo_sung",
                row.ma_lich_day_bo_sung
            );
        },
    },
};
</script>

<style>
</style>