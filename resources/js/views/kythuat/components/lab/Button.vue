<template>
    <div>
        <router-link
            to="/quan_ly_lab/danh_sach_lab"
            class="btn btn-info"
            :class="{disabled:isListLab}"
        >Danh sách lab</router-link>
        <router-link
            to="/quan_ly_lab/them_lab"
            class="btn btn-info"
            :class="{disabled:isAddLab}"
        >Thêm lab</router-link>
        <router-link
            to="/quan_ly_lab/update_lab"
            class="btn btn-info"
            :class="{disabled:isModiLab}"
        >Tùy chỉnh lab</router-link>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isListLab: false,
            isAddLab: false,
            isModiLab: false,
        };
    },
    mounted() {
        if (this.$route.path.includes("danh_sach_lab")) {
            this.isListLab = true;
            this.isAddLab = false;
            this.isModiLab = false;
        } else if (this.$route.path.includes("them_lab")) {
            this.isAddLab = true;
            this.isListLab = false;
            this.isModiLab = false;
        } else if (this.$route.path.includes("update_lab")) {
            this.isListLab = false;
            this.isAddLab = false;
            this.isModiLab = true;
        } else {
            this.isListLab = false;
            this.isAddLab = false;
            this.isModiLab = false;
        }
    },
    watch: {
        $route(to, from) {
            if (to.path.includes("danh_sach_lab")) {
                this.isListLab = true;
                this.isAddLab = false;
                this.isModiLab = false;
            } else if (to.path.includes("them_lab")) {
                this.isAddLab = true;
                this.isListLab = false;
                this.isModiLab = false;
            } else if (to.path.includes("update_lab")) {
                this.isListLab = false;
                this.isAddLab = false;
                this.isModiLab = true;
            } else {
                this.isListLab = false;
                this.isAddLab = false;
                this.isModiLab = false;
            }
        },
    },
};
</script>
<style lang="css" scoped>
</style>
