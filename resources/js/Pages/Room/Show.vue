<script setup>
import Footer from '@/Components/Chat/Footer.vue';
import Header from '@/Components/Chat/Header.vue';
import Main from '@/Components/Chat/Main.vue';
import Nav from '@/Components/Chat/Nav.vue';

defineProps({
    room:{
        type:Object,
        Required :true
    }
});

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

                <Main />

                <Footer />

            </div>

        </div>
</template>
