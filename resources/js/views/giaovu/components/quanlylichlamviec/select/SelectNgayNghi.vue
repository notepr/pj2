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
        };
    },
    methods: {
        userLabel({ ho_ten, email }) {
            return `${ho_ten} - ${email}`;
        },
    },
    watch: {
        user() {
            if (this.user) {
                this.$store.dispatch(
                    "ngay_nghi/get_ngay_nghi_gv",
                    this.user.ma_nguoi_dung
                );
            } else {
                this.$store.dispatch("ngay_nghi/get_ngay_nghi");
            }
        },
    },
};
</script>

<style>
</style>