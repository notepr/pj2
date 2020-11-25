<template>
    <div>
        <label>Giáo viên</label>
        <multiselect
            v-model="user"
            :options="arr_user"
            :close-on-select="true"
            :show-labels="true"
            placeholder="Chọn giáo viên"
            deselectLabel="Click hoặc nhấn Enter để bỏ chọn"
            selectLabel="Click hoặc nhấn Enter để chọn"
            :searchable="true"
            :custom-label="userLabel"
        ></multiselect>
        <br />
        <p class="font-weight-bold" v-if="loading">Đang tải</p>
    </div>
</template>

<script>
export default {
    created() {
        this.$store.dispatch("user/get_all_user");
    },
    computed: {
        arr_user() {
            return this.$store.state.user.arr_user;
        },
    },
    data() {
        return {
            user: "",
            loading: false,
        };
    },
    methods: {
        userLabel({ ho_ten, email }) {
            return `${ho_ten} - ${email}`;
        },
    },
    watch: {
        user() {
            this.$emit("hide_table");
            if (this.user) {
                this.loading = true;
                this.$store
                    .dispatch(
                        "de_xuat/get_lich_bo_sung",
                        this.user.ma_nguoi_dung
                    )
                    .then(
                        setTimeout(() => {
                            this.loading = false;
                            this.$emit("show_table");
                        }, 5000)
                    );
            }
        },
    },
};
</script>

<style>
</style>