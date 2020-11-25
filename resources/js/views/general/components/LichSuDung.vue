<template>
    <div>
        <p class="font-weight-bold">Chú thích:</p>
        <div style="display:flex;">
            <p class="font-weight-bold" style="color:blue">Lịch dạy</p>
            <p class="font-weight-bold" style="color:#2C3E50; padding: 0 10px">Lịch nghỉ</p>
        </div>
        <thongtin></thongtin>
        <br />
        <FullCalendar :options="calendar_options" />
    </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import listPlugin from "@fullcalendar/list";
import thongtin from "./info/ThongTinLab";

export default {
    props: ["lich_su_dung"],
    data() {
        return {
            calendar_options: {
                plugins: [dayGridPlugin, listPlugin],
                eventTimeFormat: {
                    hour: "2-digit",
                    minute: "2-digit",
                    hour12: false,
                },
                displayEventEnd: true,
                events: this.lich_su_dung,
                eventDisplay: "block",
                initialView: this.modi_calendar_view(),
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: this.modi_calendar_button(),
                },
            },
        };
    },
    methods: {
        modi_calendar_button() {
            if ($(window).width() < 770) {
                return "listWeek";
            } else {
                return "dayGridMonth,listWeek";
            }
        },
        modi_calendar_view() {
            if ($(window).width() < 770) {
                return "listWeek";
            } else {
                return "dayGridMonth";
            }
        },
    },
    components: {
        FullCalendar,
        thongtin,
    },
};
</script>
<style lang="css" scoped>
@import "~@fullcalendar/daygrid/main.css";
@import "~@fullcalendar/list/main.css";
</style>
