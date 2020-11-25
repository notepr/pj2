<template>
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5
                        class="modal-title font-weight-bold"
                        id="exampleModalLabel"
                    >Lịch sử dụng của các phòng trong ngày hôm nay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Số giờ</label>
                    <multiselect
                        v-model="so_gio"
                        :options="arr_gio_day"
                        :close-on-select="true"
                        :show-labels="true"
                        placeholder="Chọn số giờ (mặc định là 2)"
                        deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
                        selectLabel="Click hoặc nhấn Enter để chọn"
                        :searchable="false"
                        :custom-label="gioLabel"
                    ></multiselect>
                    <br />
                    <div class="card">
                        <div class="card-body table-responsive">
                            <vue-good-table
                                :columns="columns"
                                :rows="arr_lab_calendar"
                                :search-options="{enabled: true}"
                                styleClass="vgt-table striped"
                                :pagination-options="{enabled: true}"
                            ></vue-good-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        arr_lab_calendar() {
            return this.$store.state.lab.all_lab_calendar.filter(
                (each) => each.ma_phong != 1
            );
        },
    },
    data() {
        return {
            so_gio: "",
            arr_gio_day: [
                {
                    value: 2,
                    title: "2 giờ",
                },
                {
                    value: 4,
                    title: "4 giờ",
                },
            ],
            columns: [
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
            ],
        };
    },
    methods: {
        gioLabel({ title }) {
            return `${title}`;
        },
    },
    watch: {
        so_gio() {
            console.log(this.so_gio);
            if (this.so_gio) {
                this.$store.dispatch("lab/get_all_calendar", this.so_gio.value);
            } else {
                this.$store.dispatch("lab/get_all_calendar", 2);
            }
        },
        arr_lab_calendar() {
            console.log(this.arr_lab_calendar);
        },
    },
};
</script>

<style>
</style>