<template>
    <div class="card">
        <div class="card-header card-header-info">
            <h4 class="card-title">Danh sách cấu hình</h4>
        </div>
        <div class="card-body table-responsive">
            <vue-good-table
                :columns="columns"
                :search-options="{enabled: true}"
                :rows="arr_cau_hinh"
                styleClass="vgt-table"
            >
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field =='ma_cau_hinh'">
                        <router-link
                            class="btn btn-info"
                            :to="{path:`/quan_ly_cau_hinh/update_cau_hinh/${props.row.ma_cau_hinh}`}"
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
    created() {
        this.$store.dispatch("cau_hinh/get_cau_hinh");
    },
    data() {
        return {
            columns: [
                {
                    label: "CPU",
                    field: "cpu",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Ram",
                    field: "ram",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Main",
                    field: "main",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Ổ cứng",
                    field: "o_cung",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "VGA",
                    field: "vga",
                    thClass: "text-info",
                    tdClass: "font-weight-bold",
                },
                {
                    label: "Tùy chỉnh",
                    field: "ma_cau_hinh",
                    thClass: "text-info",
                    sortable: false,
                },
            ],
        };
    },
    computed: {
        arr_cau_hinh() {
            return this.$store.state.cau_hinh.arr_cau_hinh;
        },
    },
};
</script>
<style lang="css" scoped>
</style>
