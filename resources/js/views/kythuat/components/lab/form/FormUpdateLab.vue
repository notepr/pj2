<template>
    <form id="form_update_lab" @submit="update_lab">
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
        <br />
        <label>Lab</label>
        <multiselect
            v-model="lab"
            :options="arr_lab"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn phòng"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="false"
            :custom-label="labelLab"
        >
            <template slot="noOptions">Chưa chọn tầng</template>
        </multiselect>
        <br />
        <br />
        <div class="form-group">
            <label for="insertName">Tên phòng</label>
            <input
                type="text"
                class="form-control"
                id="insertName"
                placeholder="Nhập tên phòng"
                v-model="current_name"
            />
            <span v-if="err.ten_phong" class="text-danger">{{err.ten_phong}}</span>
        </div>
        <br />
        <div class="form-group">
            <label for="insertSeats">Số chỗ ngồi</label>
            <input
                type="number"
                class="form-control"
                id="insertSeats"
                placeholder="Nhập số chõ ngồi"
                v-model="current_seats"
            />
            <span v-if="err.so_cho_ngoi" class="text-danger">{{err.so_cho_ngoi}}</span>
        </div>
        <br />
        <label>Cấu hình</label>
        <multiselect
            v-model="cau_hinh"
            :options="arr_cau_hinh"
            :close-on-select="true"
            :show-labels="true"
            :placeholder="current_cau_hinh"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="false"
            :custom-label="labelCauHinh"
        ></multiselect>
        <br />
        <br />
        <button type="submit" class="btn btn-info">Xác nhận</button>
    </form>
</template>
<script>
export default {
    created() {
        this.$store.dispatch("toa/get_toa");
        this.$store.dispatch("cau_hinh/get_cau_hinh");
        if (this.$route.params.ma_lab) {
            this.$store.dispatch("lab/get_info_lab", this.$route.params.ma_lab);
        } else {
            this.$store.commit("lab/reset_info_lab");
        }

        this.$store.commit("lab/reset_err");

        this.$store.commit("lab/reset_arr_lab");
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
            lab: "",
            ten_lab: "",
            seats: "",
            cau_hinh: "",
        };
    },
    computed: {
        err() {
            return this.$store.state.lab.err
                ? this.$store.state.lab.err
                : false;
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
        arr_lab() {
            return this.$store.state.lab.arr_lab;
        },

        current_cau_hinh() {
            return this.$store.state.lab.info_lab.cau_hinh
                ? this.$store.state.lab.info_lab.cau_hinh.mo_ta
                      .split("`")
                      .join(" ")
                : "Chọn cấu hình";
        },

        current_name: {
            get() {
                return this.$store.state.lab.info_lab
                    ? this.$store.state.lab.info_lab.ten_phong
                    : this.ten_lab;
            },
            set(val) {
                this.ten_lab = val;
            },
        },

        current_seats: {
            get() {
                return this.$store.state.lab.info_lab
                    ? this.$store.state.lab.info_lab.so_cho_ngoi
                    : this.seats;
            },
            set(val) {
                this.seats = val;
            },
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
        labelLab({ ten_phong }) {
            return `${ten_phong}`;
        },
        update_lab(e) {
            e.preventDefault();
            var data = [];
            var obj = {
                ma_phong: this.$store.state.lab.info_lab.ma_phong,
            };
            if (this.ten_lab) {
                obj.ten_phong = this.ten_lab;
            }
            if (this.seats) {
                obj.so_cho_ngoi = this.seats;
            }

            data.push(obj);

            if (this.cau_hinh) {
                data.push(this.cau_hinh);
            }

            this.$store.dispatch("lab/update_thong_tin", data);
        },
    },
    watch: {
        toa() {
            this.tang = "";
            this.lab = "";
            if (!this.toa) {
                this.$store.commit("tang/reset_arr_tang");
                return false;
            }
            this.$store.dispatch("tang/get_tang", this.toa.ma_toa);
        },
        tang() {
            this.lab = "";
            if (!this.tang) {
                this.$store.commit("lab/reset_arr_lab");
                return false;
            } else {
                this.$store.dispatch("lab/get_lab", this.tang.ma_tang);
            }
        },
        lab() {
            if (!this.lab) {
                this.$store.commit("lab/reset_info_lab");
            } else if (this.toa && this.tang) {
                this.$router.push(
                    `/quan_ly_lab/update_lab/${this.lab.ma_phong}`
                );
                this.$store.dispatch(
                    "lab/get_info_lab",
                    this.$route.params.ma_lab
                );
            }
        },
        arr_toa() {
            if (this.arr_toa.length != 0) {
                this.toa = this.arr_toa[0];
            }
        },
    },
};
</script>
<style scoped>
</style>
