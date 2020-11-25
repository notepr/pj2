<template>
    <div class="card">
        <div class="card-header card-header-info">
            <h4 class="card-title">Danh sách lịch nghỉ</h4>
        </div>
        <div class="card-body table-responsive">
            <vue-good-table
                :columns="columns"
                :rows="arr_ngay_nghi"
                :search-options="{enabled: true}"
                styleClass="vgt-table striped"
                :pagination-options="{enabled: true}"
            >
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'btn'">
                        <button
                            class="btn btn-info"
                            @click="delete_day_off(props.row)"
                            v-tooltip.top="'Xóa'"
                        >
                            <i class="material-icons">delete</i>
                        </button>
                    </span>
                </template>
                <div slot="emptystate" class="font-weight-bold">Giáo viên chưa có lịch nghỉ</div>
            </vue-good-table>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        arr_ngay_nghi() {
            return this.$store.state.ngay_nghi.arr_ngay_nghi;
        },
    },
    data() {
        return {
            columns: [
                {
                    label: "Ngày",
                    field: "date",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Giáo viên",
                    field: this.columns_gv,
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Ca",
                    field: this.columns_ca,
                    formatFn: this.formatArrCa,
                    sortable: false,
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Ghi chú",
                    field: this.columns_note,
                    formatFn: this.formatNote,
                    sortable: false,
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Tùy chỉnh",
                    field: "btn",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
            ],
        };
    },
    methods: {
        columns_gv(row) {
            if (row.nguoidung) {
                if (row.nguoidung.ho_ten) {
                    return row.nguoidung.ho_ten;
                } else {
                    return "demo";
                }
            } else {
                return "Nghỉ lịch chung";
            }
        },
        columns_ca(row) {
            return row.ca;
        },
        columns_ma_ca(row) {
            return row.ca[0].ma_ca;
        },
        columns_note(row) {
            return row.ca[0].ngay_nghi[0].ghi_chu;
        },
        formatNote(val) {
            if (!val) {
                return "Trống";
            } else {
                return val;
            }
        },
        formatArrCa(val) {
            if (val[0].ma_ca != 1) {
                return `ca ${val[0].ma_ca} (${val[0].gio_bat_dau}-${val[0].gio_ket_thuc})`;
            } else if (val[0].ma_ca == 1) {
                return "Cả ngày";
            }
        },
        delete_day_off(row) {
            var user_input = [
                {
                    ngay_cu: row.date.split("-").reverse().join("-"),
                    ma_giao_vien_cu: row.nguoidung
                        ? row.nguoidung.ma_nguoi_dung
                        : 0,
                    ma_ca_cu: row.ca[0].ma_ca,
                    tinh_trang: 2,
                },
                row,
            ];
            this.$store.dispatch("ngay_nghi/delete_ngay_nghi", user_input);
        },
    },
};
</script>

<style>
</style>