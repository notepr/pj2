<template>
    <div
        class="sidebar"
        data-color="azure"
        data-background-color="white"
        data-image="./img/sidebar-1.jpg"
    >
        <div class="logo">
            <router-link to="/home" class="simple-text logo-normal">HOME</router-link>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav navbar-nav nav-mobile-menu">
                <li class="nav-item dropdown user-nav">
                    <a
                        class="nav-link nav-control"
                        href="javascript:;"
                        id="navbarDropdownProfile"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        style="width: 100%"
                    >
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">Account</p>
                    </a>
                    <div
                        class="dropdown-menu dropdown-menu-right"
                        aria-labelledby="navbarDropdownProfile"
                    >
                        <router-link class="dropdown-item" to="/profile">Thông tin tài khoản</router-link>
                        <router-link class="dropdown-item" to="/forgot_password">Quên mật khẩu</router-link>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout">Đăng xuất</a>
                    </div>
                </li>
            </ul>
            <ul class="nav">
                <li class="nav-item">
                    <router-link class="nav-link" to="/xem_thong_tin_lab">
                        <i class="material-icons">library_books</i>
                        <p>Xem thông tin lab</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/quan_ly_lab">
                        <i class="material-icons">laptop</i>
                        <p>Quản lý Phòng lab</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/quan_ly_cau_hinh">
                        <i class="material-icons">laptop</i>
                        <p>Quản lý cấu hình</p>
                    </router-link>
                </li>
                <!-- <li class="nav-item">
                    <router-link class="nav-link" to="/quan_ly_thiet_bi">
                        <i class="material-icons">laptop</i>
                        <p>Quản lý thiết bị</p>
                    </router-link>
                </li>-->
                <li class="nav-item">
                    <router-link class="nav-link" to="/lich_lam_viec">
                        <i class="material-icons">date_range</i>
                        <p>Xem lịch làm việc</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/quan_ly_lich_lam_viec">
                        <i class="material-icons">event_available</i>
                        <p>Quản lý lịch làm việc</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/quan_ly_user">
                        <i class="material-icons">account_circle</i>
                        <p>Quản lý người dùng</p>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {};
    },
    mounted() {
        // Bat sidebar theo url va add active class onclick
        var pathname = window.location.pathname;
        var pathsidebar = "/project-2/public/" + pathname.split("/")[3];
        if (
            pathname == "/project-2/public/profile" ||
            pathname == "/project-2/public/account_setting"
        ) {
            $(".user-nav").addClass("active");
        } else {
            $('.nav-item > a[href="' + pathsidebar + '"]')
                .parent()
                .addClass("active");
        }

        $(".sidebar .nav-link:not(.nav-control)").on("click", function () {
            $(".nav-item").removeClass("active");
            $(this).parent().addClass("active");
        });

        $(".dropdown-menu").on("click", function () {
            $(".user-nav").addClass("active");
        });

        $(
            ".dropdown-item, .nav-link:not(.nav-control), .current_user_nav, .logo"
        ).on("click", function () {
            if ($(window).width() < 992) {
                $(".close-layer").trigger("click");
            }
        });
    },
    watch: {
        $route(to, from) {
            $(window).scrollTop(0);

            $(".nav-item").removeClass("active");
            var pathname = window.location.pathname;
            var pathsidebar = "/project-2/public/" + pathname.split("/")[3];
            if (
                pathname == "/project-2/public/profile" ||
                pathname == "/project-2/public/account_setting"
            ) {
                $(".user-nav").addClass("active");
            } else {
                $('.nav-item > a[href="' + pathsidebar + '"]')
                    .parent()
                    .addClass("active");
            }

            $(".sidebar .nav-link:not(.nav-control)").on("click", function () {
                $(".nav-item").removeClass("active");
                $(this).parent().addClass("active");
            });

            $(".dropdown-menu").on("click", function () {
                $(".user-nav").addClass("active");
            });

            $(
                ".dropdown-item, .nav-link:not(.nav-control), .current_user_nav"
            ).on("click", function () {
                if ($(window).width() < 992) {
                    $(".close-layer").trigger("click");
                }
            });

            // remove tooltip
            $(".tooltip-inner").remove();
        },
    },
};
</script>
<style lang="css" scoped>
</style>
