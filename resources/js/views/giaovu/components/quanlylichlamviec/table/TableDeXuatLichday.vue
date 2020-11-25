<template>
    <form @submit="prevent">
        <vue-good-table
            :columns="columns"
            :rows="arr_de_xuat"
            :search-options="{enabled: true}"
            :group-options="{ enabled: true, collapsable: true}"
            styleClass="vgt-table"
        >
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'ma_ca'">
                    <button
                        class="btn btn-info"
                        @click="add_lich_bo_sung(props.row)"
                        v-tooltip.top="'Xếp lịch'"
                    >
                        <i class="material-icons">assignment_turned_in</i>
                    </button>
                </span>
            </template>
            <div slot="emptystate" class="font-weight-bold">Không tìm được lịch đề xuất phù hợp</div>
        </vue-good-table>
    </form>
</template>

<script>
export default {
    props: ["ma_gv", "ma_mon", "ma_lop"],
    computed: {
        arr_de_xuat() {
            return this.$store.state.de_xuat.arr_de_xuat;
        },
    },
    data() {
        return {
            columns: [
                {
                    label: "Thứ",
                    field: "thu",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                    sortable: false,
                },
                {
                    label: "Giờ bắt đầu",
                    field: "gio_bat_dau",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Giờ kết thức",
                    field: "gio_ket_thuc",
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
                    label: "Tùy chỉnh",
                    field: "ma_ca",
                    thClass: "text-info",
                    sortable: false,
                },
            ],
        };
    },
    methods: {
        add_lich_bo_sung(row) {
            var obj = {
                ma_giao_vien: this.ma_gv,
                ma_lop: this.ma_lop,
                ma_mon_hoc: this.ma_mon,
                ngay: row.ngay.split("-").reverse().join("-"),
                ma_phong: row.ma_phong,
                ma_ca: row.ma_ca,
            };

            this.$store.dispatch("de_xuat/add_de_xuat", obj).then(
                setTimeout(() => {
                    this.$router.push(
                        "/quan_ly_lich_lam_viec/xem_lich_bo_sung"
                    );
                }, 500)
            );
        },
        prevent(e) {
            e.preventDefault();
        },
    },
};
</script>
<style>
</style>