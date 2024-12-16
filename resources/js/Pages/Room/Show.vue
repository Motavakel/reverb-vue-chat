<script setup>
import Footer from '@/Components/Chat/Footer.vue';
import Header from '@/Components/Chat/Header.vue';
import Main from '@/Components/Chat/Main.vue';
import Nav from '@/Components/Chat/Nav.vue';
import { useMessageStore } from '../Store/UseMessageStore';

const props = defineProps({
    room: {
        type: Object,
        Required: true
    }
});

const storeMessage = (payload) => {
    messageStore.storeMessage(props.room.slug, payload)
}

const channel = Echo.join(`room.${props.room.id}`)
    .here((users) => {
        // وقتی کاربر به کانال متصل شد، لیست کاربران را تنظیم کنید
        userStore.setUsers(users);
    })

    .joining((user) => {
        // وقتی کاربر جدید به کانال ملحق شد
        userStore.addUser(user);
    })
    .leaving((user) => {
        // وقتی کاربر کانال را ترک کرد
        userStore.removeUser(user);
    })
    .listen("MessageCreated", (e) => {
        // وقتی پیام جدیدی در کانال ایجاد شد
        allMessages.pushMessage(e);
    })
    .listenForWispher("typing", (e) => {
        userStore.setTyping(e);
    });

const messageStore = useMessageStore();
messageStore.fetchMessage(props.room.slug);


</script>
<template>

    <head title="Messages" />
    <div>

        <div id="page-container" class="relative mx-auto h-screen min-w-[320px] bg-white lg:ms-80">

            <Nav />

            <Header />


            <Main :room="room" />

            <Footer v-on:valid="storeMessage({ content: $event })" />

        </div>

    </div>
</template>
