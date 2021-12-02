<template>
    <full-calendar :options="calendarOptions" />
</template>

<script>
import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue3'
import dayGrid from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGrid from '@fullcalendar/timegrid'

export default {
    components: {
        FullCalendar,
    },
    data(){
        return {
            calendarOptions:{
                plugins:[dayGrid,interactionPlugin,timeGrid],
                initialView: 'dayGridMonth',
                headerToolbar:{
                    left:'prev,next,today',
                    center:'title',
                    right:'dayGridMonth, timeGridWeek, timeGridDay',
                },
                // height:'100%',
                allDaySlot: false,
                slotMinTime:'12:00:00',
                slotMaxTime: '20:00:00',
                dateClick: this.handleDateClick,
            }
        }
    },
    beforeMount() {
        this.$data.calendarOptions.events = [
            {
                id: 'a',
                title: 'my event',
                start: '2018-09-01'
            }
        ]
    },
    methods: {
        handleDateClick(clickInfo) {
            this.$emit('dateClick', clickInfo)
        }
    }

}


</script>

<style scoped>

</style>
