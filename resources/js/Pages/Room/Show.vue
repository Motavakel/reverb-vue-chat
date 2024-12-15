<script setup>
import Footer from '@/Components/Chat/Footer.vue';
import Header from '@/Components/Chat/Header.vue';
import Main from '@/Components/Chat/Main.vue';
import Nav from '@/Components/Chat/Nav.vue';
import { useMessageStore } from '../Store/UseMessageStore';

const props = defineProps({
    room:{
        type:Object,
        Required :true
    }
});

const storeMessage = (payload)=>{
    messageStore.storeMessage(props.room.slug,payload)
}

const channel = Echo.join(`room.${props.room.slug}`);
channel.listen("MessageCreated",e=>{
    console.log(e);
})

const messageStore = useMessageStore();
messageStore.fetchMessage(props.room.slug);


</script>
<template>
    <head title="Messages" />
        <div>

            <div
                id="page-container"
                class="relative mx-auto h-screen min-w-[320px] bg-white lg:ms-80"
            >

                <Nav />

                <Header />


                <Main :room="room" />

                <Footer v-on:valid="storeMessage({content : $event})" />

            </div>

        </div>
</template>
