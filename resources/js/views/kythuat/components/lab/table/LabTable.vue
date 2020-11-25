<template>
    <div class="card">
        <div class="card-header card-header-info">
            <h4 class="card-title">Danh sách các phòng</h4>
        </div>
        <div class="card-body table-responsive">
            <vue-good-table
                :columns="columns"
                :rows="arr_lab"
                :search-options="{enabled: true}"
                :pagination-options="{enabled: true}"
                styleClass="vgt-table"
            >
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'ma_phong'">
                        <button
                            class="btn btn-info"
                            v-tooltip.top="'Thay đổi tình trạng'"
                            @click="thay_doi_state(props.row)"
                        >
                            <i class="material-icons">power_settings_new</i>
                        </button>
                        <router-link
                            class="btn btn-info"
                            :to="{path: `/quan_ly_lab/update_lab/${props.row.ma_phong}`}"
                            v-tooltip.top="'Tùy chỉnh'"
                        >
                            <i class="material-icons">settings</i>
                        </router-link>
                    </span>
                </template>
            </vue-good-table>
        </div>
    </div>
</template>
<script>
export default {
    props: ["arr_lab"],
    data() {
        return {
            columns: [
                {
                    label: "Tên phòng",
                    field: "ten_phong",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Cấu hình",
                    field: "cau_hinh.mo_ta",
                    sortable: false,
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                    formatFn: this.formatCH,
                },
                {
                    label: "Số chỗ ngồi",
                    field: "so_cho_ngoi",
                    type: "number",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Tình trạng",
                    field: "tinh_trang",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                    formatFn: this.formatState,
                },
                {
                    label: "Tùy chỉnh",
                    field: "ma_phong",
                    sortable: false,
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
            ],
        };
    },
    methods: {
        formatState(row) {
            return row.ten_tinh_trang;
        },
        formatCH(row) {
            var row = row.split("`");
            row.shift();
            row = row.join(" ");
            return row;
        },
        thay_doi_state(row) {
            var obj = {
                ma_phong: row.ma_phong,
                ma_tinh_trang: row.tinh_trang.ma_tinh_trang == 1 ? 2 : 1,
            };
            this.$store.dispatch("lab/update_tinh_trang", obj);
        },
    },
    watch: {
        arr_lab() {
            $(document).ready(function () {
                $(".btn").tooltip();
                $(".tooltip-inner").remove();
            });
        },
    },
};
</script>
<style lang="css" scoped>
</style>
