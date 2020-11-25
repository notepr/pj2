<template>
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <p class="navbar-brand" href="javascript:;">{{page_title}}</p>
            </div>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                aria-controls="navigation-index"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <!-- display none de an form tim kiem -->
                <form class="navbar-form" style="display: none;">
                    <div class="input-group no-border">
                        <input type="text" value class="form-control" placeholder="Search..." />
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link"
                            href="javascript:;"
                            id="navbarDropdownProfile"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="material-icons">person</i>
                            <p class="d-lg-none d-md-block">Account</p>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="navbarDropdownProfile"
                        >
                            <router-link class="dropdown-item" to="/profile">Thông tin tài khoản</router-link>
                            <router-link class="dropdown-item" to="/quen_mat_khau">Quên mật khẩu</router-link>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout">Đăng xuất</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <notifications group="nofi" />
    </nav>
</template>
<script>
export default {
    data() {
        return {};
    },
    computed: {
        page_title() {
            return this.$store.state.content.page_title;
        },
    },
    mounted() {
        // remove active class khi thao tac voi user
        $(".dropdown-item").on("click", function () {
            $(".nav-item").removeClass("active");
        });
    },
};
</script>
<style lang="css" scoped>
</style>
