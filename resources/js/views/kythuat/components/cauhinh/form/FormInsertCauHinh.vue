<template>
    <form @submit="add_cau_hinh">
        <div class="form-group">
            <label for="insert_main">Main</label>
            <input
                type="text"
                class="form-control"
                id="insert_main"
                placeholder="Nhập Main"
                v-model="main"
            />
            <span class="text-danger">{{err_form.main}}</span>
        </div>
        <br />
        <div class="form-group">
            <label for="insert_cpu">CPU</label>
            <input
                type="text"
                class="form-control"
                id="insert_cpu"
                placeholder="Nhập CPU"
                v-model="cpu"
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
                v-model="ram"
            />
            <span class="text-danger">{{err_form.ram}}</span>
        </div>
        <br />
        <div class="form-group">
            <label for="insert_hardrive">Ổ cứng</label>
            <input
                type="text"
                class="form-control"
                id="insert_hardrive"
                placeholder="Nhập ổ cứng"
                v-model="hard_drive"
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
            <span class="text-danger">{{err_form.vga}}</span>
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
        this.$store.dispatch("mon/get_mon");
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
            main: "",
            cpu: "",
            ram: "",
            vga: "",
            hard_drive: "",
            mon: "",
        };
    },
    computed: {
        arr_mon() {
            return this.$store.state.mon.arr_mon;
        },
        err_form() {
            return this.$store.state.cau_hinh.err_form;
        },
        reset_form() {
            return this.$store.state.cau_hinh.reset_form;
        },
    },
    methods: {
        labelMon({ ma_mon_hoc, ten_mon_tieng_viet }) {
            return `${ma_mon_hoc} - ${ten_mon_tieng_viet}`;
        },
        add_cau_hinh(e) {
            e.preventDefault();
            var user_input = {
                ma_loai: 1,
                cpu: this.cpu,
                ram: this.ram,
                main: this.main,
                o_cung: this.hard_drive,
                vga: this.vga,
            };
            this.$store
                .dispatch("cau_hinh/add_cau_hinh", [
                    user_input,
                    this.mon
                        ? this.mon.map((each) => {
                              return each.ma_mon_hoc;
                          })
                        : "",
                ])
                .then(
                    setTimeout(() => {
                        this.$router.push(
                            "/quan_ly_cau_hinh/danh_sach_cau_hinh"
                        );
                    }, 500)
                );
        },
    },
    watch: {
        reset_form() {
            if (this.reset_form) {
                this.main = "";
                this.cpu = "";
                this.ram = "";
                this.vga = "";
                this.hard_drive = "";
                this.mon = "";
            }
        },
    },
};
</script>
<style lang="css" scoped>
</style>
