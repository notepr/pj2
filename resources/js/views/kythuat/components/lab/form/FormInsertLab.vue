<template>
    <form @submit="add_phong">
        <label>Tòa</label>
        <multiselect
            v-model="toa"
            :options="arr_toa"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn tòa"
            :custom-label="labelToa"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="false"
        ></multiselect>
        <br />
        <label>Tầng</label>
        <multiselect
            v-model="tang"
            :options="arr_tang"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn tầng"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="false"
            :custom-label="labelTang"
        >
            <template slot="noOptions">Chưa chọn tòa</template>
        </multiselect>
        <span class="text-danger" v-if="err.ma_tang">{{err.ma_tang}}</span>
        <br />
        <br />
        <div class="form-group">
            <label for="insertName">Tên phòng</label>
            <input
                type="text"
                class="form-control"
                id="insertName"
                placeholder="Nhập tên phòng"
                v-model="ten_lab"
            />
            <span class="text-danger" v-if="err.ten_phong">{{err.ten_phong}}</span>
        </div>
        <br />
        <div class="form-group">
            <label for="insertSeats">Số chỗ ngồi</label>
            <input
                type="number"
                class="form-control"
                id="insertSeats"
                placeholder="Nhập số chõ ngồi"
                v-model="so_cho_ngoi"
            />
        </div>
        <br />
        <label>Cấu hình</label>
        <multiselect
            v-model="cau_hinh"
            :options="arr_cau_hinh"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn cấu hình"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="false"
            :custom-label="labelCauHinh"
        ></multiselect>
        <br />
        <br />
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
</template>

<script>
export default {
    created() {
        this.$store.dispatch("toa/get_toa");
        this.$store.dispatch("cau_hinh/get_cau_hinh");
        this.$store.commit("lab/reset_err");
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
            tang: "",
            toa: "",
            cau_hinh: "",
            ten_lab: "",
            so_cho_ngoi: 20,
        };
    },
    computed: {
        err() {
            return this.$store.state.lab.err;
        },
        arr_toa() {
            return this.$store.state.toa.arr_toa;
        },
        arr_tang() {
            return this.$store.state.tang.arr_tang;
        },
        arr_cau_hinh() {
            return this.$store.state.cau_hinh.arr_cau_hinh;
        },
        reset_form() {
            return this.$store.state.lab.reset_form;
        },
    },
    methods: {
        labelToa({ ten_toa, dia_chi }) {
            return `${ten_toa} - ${dia_chi}`;
        },
        labelTang({ ten_tang }) {
            return `${ten_tang}`;
        },
        labelCauHinh({ cpu, ram, main, o_cung, vga }) {
            return `Cpu: ${cpu} - RAM: ${ram} - Main: ${main} -  Ổ cứng: ${o_cung} - VGA: ${vga}`;
        },
        add_phong(e) {
            e.preventDefault();
            var data = [];
            var obj = {
                ten_phong: this.ten_lab ? this.ten_lab : "",
                ma_tang: this.tang ? this.tang.ma_tang : "",
                so_cho_ngoi: this.so_cho_ngoi ? this.so_cho_ngoi : "",
            };
            data.push(obj);
            if (this.cau_hinh) {
                data.push(this.cau_hinh);
            }
            this.$store.dispatch("lab/update_thong_tin", data).then(
                setTimeout(() => {
                    this.$router.push("/quan_ly_lab/danh_sach_lab");
                }, 500)
            );
        },
    },
    watch: {
        toa() {
            this.tang = "";
            if (!this.toa) {
                this.$store.commit("tang/reset_arr_tang");
                return false;
            }
            this.$store.dispatch("tang/get_tang", this.toa.ma_toa);
        },
        arr_toa() {
            if (this.arr_toa.length != 0) {
                this.toa = this.arr_toa[0];
            }
        },
        reset_form() {
            if (this.reset_form) {
                this.ten_lab = "";
                this.cau_hinh = "";
            }
        },
    },
};
</script>

<style>
</style>