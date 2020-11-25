<template>
    <div>
        <div v-if="!is_giao_vien">
            <label>Chọn giáo viên</label>
            <multiselect
                v-model="giao_vien"
                :options="arr_gv"
                :close-on-select="true"
                :show-labels="true"
                placeholder="Chọn giáo viên"
                deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
                selectLabel="Click hoặc nhấn Enter để chọn"
                :searchable="true"
                :custom-label="labelUser"
            ></multiselect>
        </div>
        <br />
        <label>Chọn phân công</label>
        <multiselect
            v-model="phan_cong"
            :options="arr_phan_cong"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn phân công"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="true"
            :custom-label="classLabel"
        >
            <template
                slot="noOptions"
            >Chưa chọn giáo viên hoặc giáo viên đã chọn chưa được phân công</template>
        </multiselect>
        <br />
        <p class="font-weight-bold" v-if="loading">Đang tải</p>
    </div>
</template>
<script>
export default {
    props: ["is_giao_vien"],
    data() {
        return {
            phan_cong: "",
            giao_vien: "",
            loading: false,
        };
    },
    computed: {
        arr_gv() {
            if (!this.is_giao_vien) {
                return this.$store.state.user.arr_user.filter((each) => {
                    return each.ma_cap_do == 3;
                });
            } else {
                return [this.$store.state.user.self_info];
            }
        },
        arr_phan_cong() {
            return this.$store.state.phan_cong.arr_phan_cong.filter((each) => {
                return (
                    each.nguoidung &&
                    each.nguoidung.ma_nguoi_dung == this.giao_vien.ma_nguoi_dung
                );
            });
        },
    },
    watch: {
        giao_vien() {
            this.phan_cong = "";
            this.loading = true;
            if (!this.giao_vien) {
                this.$store.commit("giao_vien/reset_lich_lam_viec");
                this.$store.commit("phan_cong/reset_arr_phan_cong");
            } else {
                this.$store.dispatch(
                    "phan_cong/get_phan_cong",
                    this.giao_vien.ma_nguoi_dung
                );
                this.$store
                    .dispatch(
                        "giao_vien/get_lich_lam_viec",
                        this.giao_vien.ma_nguoi_dung
                    )
                    .then(
                        setTimeout(() => {
                            this.loading = false;
                        }, 500)
                    );
            }
        },
        phan_cong() {
            this.loading = true;
            if (this.phan_cong) {
                this.$store
                    .dispatch(
                        "giao_vien/get_lich_lam_viec_by_phan_cong",
                        this.phan_cong.ma_phan_cong
                    )
                    .then(
                        setTimeout(() => {
                            this.loading = false;
                        }, 500)
                    );
            } else {
                this.$store
                    .dispatch(
                        "giao_vien/get_lich_lam_viec",
                        this.giao_vien.ma_nguoi_dung
                    )
                    .then(
                        setTimeout(() => {
                            this.loading = false;
                        }, 500)
                    );
            }
        },
        arr_gv() {
            if (this.arr_gv.length == 1) {
                this.giao_vien = this.arr_gv[0];
            }
        },
    },
    methods: {
        labelUser({ ho_ten, email }) {
            return `${ho_ten} - ${email}`;
        },
        classLabel({ ma_lop, ma_mon_hoc }) {
            return `${ma_lop} - ${ma_mon_hoc}`;
        },
    },
};
</script>
<style lang="css" scoped>
</style>
