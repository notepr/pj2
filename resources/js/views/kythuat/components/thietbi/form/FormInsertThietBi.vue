<template>
    <form>
        <div class="form-group">
            <label for="insertDevice">Thiết bị</label>
            <input
                type="text"
                class="form-control"
                id="insertDevice"
                placeholder="Nhập tên thiết bị"
            />
        </div>
        <br />
        <div class="form-group">
            <label for="insertNumber">Số lượng</label>
            <input type="number" class="form-control" id="insertNumber" placeholder="Nhập số lượng" />
        </div>
        <br />
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
</template>
<script>
export default {
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
};
</script>
<style lang="css" scoped>
</style>
