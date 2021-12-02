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
import formatTime from "../../Shared/Mixins/transformTime";
import { Inertia } from "@inertiajs/inertia"

export default {
    name: "Books",
    components:{
        Calendar,
        Layout,
        ModalCalendar,
        formatTime
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
            return;
        },
        saveAppt(param){
            if (param.title === ''){
                alert('is opgeslageen')
            }
            let dataAppt = this.setDurationSesion(param)

            Inertia.post(route('appointment.store'), dataAppt,{
                onSuccess: page =>{
                    if(Object.entries(page.props.errors).length === 0){
                        this.closeModal()
                    }
                }
            })
            //
            Inertia.on("error", event =>{
                event.preventDefault();
            });
        },
        setDurationSesion(form){
            let dateApt = form.date_at +" "+ form.hour

            let initSesion = new Date(dateApt)

            const getSecondsSesion = initSesion.getSeconds() + form.session

            initSesion.setSeconds(getSecondsSesion)

            return{
                title: form.title,
                begin: dateApt,
                end: formatTime(initSesion),
                session: form.session,
                user_id: form.user_id


            }
        }
    }
}
</script>

<style scoped>

</style>
