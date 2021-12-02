<template>
    <Layout>
        <Calendar @dateClick="dateClick" />
        <modal-calendar v-if="showModal" :form="newEvent" @closeModal="closeModal" @saveAppt="saveAppt"/>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout";
import Calendar from "../../Shared/Calendar";
import ModalCalendar from "../../Shared/Modals/CalendarModal";

export default {
    name: "Books",
    components:{
        Calendar,
        Layout,
        ModalCalendar
    },
    data(){
        return{
            showModal: false,
            newEvent:{
                title:'',
                date_at:'',
                hour:'',
                user_id:'',
                session: 1800
            }

        }
    },
    methods:{
        dateClick(arg){
            this.$data.showModal = true
            this.setModalOpen(arg)
        },
        closeModal(){
            this.$data.showModal = false
        },
        setModalOpen(obj){
            let dateAndTime = obj.dateStr.split("T");

            this.newEvent.date_at = dateAndTime[0];
            this.newEvent.hour = dateAndTime[1].substr(0,8)
            this.newEvent.user_id = this.$page.user.id
            return;
        },
        saveAppt(param){
            if (param.title === ''){
                alert('is opgeslageen')
            }
            let dataAppt = this.setDurationSesion(param)

            console.log(dataApt)
        },
        setDurationSesion(form){
            let dateApt = form.date_at +" "+ form.hour

            let initSesion = new Date(dateApt)

            const getSecondsSesion = initSesion.getSeconds() + form.session

            initSesion.setSeconds(getSecondsSesion)

            return{
                id: form.id,
                title: form.title,
                start: dateApt,
                end:initSesion,
                session: form.session,
                user_id: form.user_id


            }
        }
    }
}
</script>

<style scoped>

</style>
