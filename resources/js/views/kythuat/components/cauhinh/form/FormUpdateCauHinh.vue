<template>
    <form @submit="update_cau_hinh" id="form_update_cau_hinh">
        <div class="form-group">
            <label for="insert_cpu">CPU</label>
            <input
                type="text"
                class="form-control"
                id="insert_cpu"
                placeholder="Nhập CPU"
                v-model="current_cpu"
            />
            <span class="text-danger">{{err_form.cpu}}</span>
        </div>
        <br />
        <div class="form-group">
            <label for="insert_ram">Ram</label>
            <input
                type="text"
                class="form-control"
                id="insert_ram"
                placeholder="Nhập Ram"
                v-model="current_ram"
            />
            <span class="text-danger">{{err_form.ram}}</span>
        </div>
        <br />
        <div class="form-group">
            <label for="insert_main">Main</label>
            <input
                type="text"
                class="form-control"
                id="insert_main"
                placeholder="Nhập Main"
                v-model="current_main"
            />
            <span class="text-danger">{{err_form.main}}</span>
        </div>
        <br />
        <div class="form-group">
            <label for="insert_hardrive">Ổ cứng</label>
            <input
                type="text"
                class="form-control"
                id="insert_hardrive"
                placeholder="Nhập ổ cứng"
                v-model="current_hard_drive"
            />
            <span class="text-danger">{{err_form.o_cung}}</span>
        </div>
        <br />
        <div class="form-group">
            <label for="insert_vga">Card đồ họa</label>
            <input
                type="text"
                class="form-control"
                id="insert_vga"
                placeholder="Nhập card đồ họa"
                v-model="vga"
            />
        </div>
        <br />
        <label>Những môn có thể học</label>
        <multiselect
            v-model="mon"
            :options="arr_mon"
            :close-on-select="true"
            :show-labels="true"
            track-by="ma_mon_hoc"
            placeholder="Chọn môn phù hợp với cấu hình trên"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="true"
            :multiple="true"
            :custom-label="labelMon"
        ></multiselect>
        <br />
        <br />
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
</template>
<script>
export default {
    created() {
        if (this.$route.params.ma_cau_hinh) {
            this.$store.dispatch(
                "cau_hinh/get_thong_tin_cau_hinh",
                this.$route.params.ma_cau_hinh
            );
            this.$store.dispatch(
                "mon/get_mon_by_cau_hinh",
                this.$route.params.ma_cau_hinh
            );
            this.$store.dispatch("mon/get_mon");
            this.$store.dispatch(
                "mon/get_mon_by_cau_hinh",
                this.$route.params.ma_cau_hinh
            );
        }

        this.$store.commit("cau_hinh/reset_thong_tin_cau_hinh");
        this.$store.commit("mon/reset_arr_mon_by_cau_hinh");
    },
    mounted() {
        // change label color
        $(".form-group").addClass("bmd-form-group");
        $("label").addClass("bmd-label-static");
        $(".form-group").on("click", function () {
            $(".form-group").removeClass("is-focused");
            $(this).addClass("is-focused");
        });

        // remove color while move out input
        $("input").blur(function () {
            $(".form-group").removeClass("is-focused");
        });
    },
    data() {
        return {
            cpu: "",
            ram: "",
            vga: "",
            hard_drive: "",
            mon: "",
        };
    },
    computed: {
        err_form() {
            return this.$store.state.cau_hinh.err_form;
        },
        arr_mon() {
            return this.$store.state.mon.arr_mon;
        },
        current_cpu: {
            get() {
                return this.$store.state.cau_hinh.thong_tin_cau_hinh.cpu
                    ? this.$store.state.cau_hinh.thong_tin_cau_hinh.cpu
                    : "";
            },
            set(val) {
                this.cpu = val;
            },
        },
        current_ram: {
            get() {
                return this.$store.state.cau_hinh.thong_tin_cau_hinh.ram
                    ? this.$store.state.cau_hinh.thong_tin_cau_hinh.ram
                    : "";
            },
            set(val) {
                this.ram = val;
            },
        },
        current_main: {
            get() {
                return this.$store.state.cau_hinh.thong_tin_cau_hinh.main
                    ? this.$store.state.cau_hinh.thong_tin_cau_hinh.main
                    : "";
            },
            set(val) {
                this.main = val;
            },
        },
        current_hard_drive: {
            get() {
                return this.$store.state.cau_hinh.thong_tin_cau_hinh.o_cung
                    ? this.$store.state.cau_hinh.thong_tin_cau_hinh.o_cung
                    : "";
            },
            set(val) {
                this.hard_drive = val;
            },
        },
        current_vga: {
            get() {
                return this.$store.state.cau_hinh.thong_tin_cau_hinh.vga
                    ? this.$store.state.cau_hinh.thong_tin_cau_hinh.vga
                    : "";
            },
            set(val) {
                this.vga = val;
            },
        },
        current_mon() {
            return this.$store.state.mon.arr_mon_by_cau_hinh;
        },
    },
    methods: {
        labelMon({ ma_mon_hoc, ten_mon_tieng_viet }) {
            return `${ma_mon_hoc}-${ten_mon_tieng_viet}`;
        },
        update_cau_hinh(e) {
            e.preventDefault(e);
            var user_input = {
                ma_cau_hinh: this.$route.params.ma_cau_hinh,
                ma_loai: 1,
                cpu: this.cpu ? this.cpu : this.current_cpu,
                main: this.main ? this.main : this.current_main,
                ram: this.ram ? this.ram : this.current_ram,
                o_cung: this.hard_drive
                    ? this.hard_drive
                    : this.current_hard_drive,
                vga: this.vga ? this.vga : this.current_hard_drive,
            };
            this.$store.dispatch("cau_hinh/update_cau_hinh", [
                user_input,
                this.mon ? this.mon.map((each) => each.ma_mon_hoc) : [],
                this.$route.params.ma_cau_hinh,
            ]);
        },
    },
    watch: {
        current_mon() {
            this.mon = this.current_mon;
        },
    },
};
</script>
<style lang="css" scoped>
</style>
