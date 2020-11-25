<template>
    <form @submit="add_phan_cong_ct">
        <vue-good-table
            :columns="columns"
            :rows="arr_de_xuat_phan_cong_ct"
            :search-options="{enabled: true}"
            :select-options="{ enabled: true, selectionText: 'bản ghi , đã chọn', clearSelectionText: 'xóa'}"
            :group-options="{ enabled: true, collapsable: true}"
            @on-selected-rows-change="selectionChanged"
            styleClass="vgt-table"
        >
            <div slot="selected-row-actions">
                <button type="submit" class="btn btn-info">Phân công</button>
            </div>
        </vue-good-table>
    </form>
</template>

<script>
export default {
    props: ["ma_phan_cong", "so_gio", "arr_de_xuat_phan_cong_ct"],
    data() {
        return {
            columns: [
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
            ],
            arr_add_phan_cong_ct: [],
            selected_rows: [],
        };
    },
    methods: {
        add_phan_cong_ct(e) {
            e.preventDefault();
            this.arr_add_phan_cong_ct = [];
            for (var i = 0; i < this.selected_rows.length; i++) {
                var obj = {};
                obj.ma_phong = this.selected_rows[i].ma_phong;
                obj.thu = this.selected_rows[i].thu;
                obj.ma_ca = this.selected_rows[i].ma_ca;
                this.arr_add_phan_cong_ct.push(obj);
            }
            if (this.arr_add_phan_cong_ct.length > 4) {
                this.$notify({
                    group: "nofi",
                    type: "error",
                    title: "Thất bại",
                    text: "Không thể chọn quá 4 phân công!",
                    duration: 1500,
                });
                this.arr_add_phan_cong_ct = [];
                return false;
            } else {
                this.$store.dispatch("phan_cong/add_phan_cong_chi_tiet", {
                    ma_phan_cong: this.ma_phan_cong,
                    so_gio: this.so_gio,
                    phan_cong_chi_tiet: this.arr_add_phan_cong_ct,
                });
            }
        },
        selectionChanged(row) {
            this.selected_rows = row.selectedRows;
        },
    },
};
</script>
<style>
</style>