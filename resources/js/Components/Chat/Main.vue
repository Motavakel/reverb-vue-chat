<script setup>
import { useMessageStore } from '@/Pages/Store/UseMessageStore';
import { useIntersectionObserver } from '@vueuse/core';
import { ref } from 'vue';



const props = defineProps({
    room:{
        type:Object,
        required:true
    }
});
const messageStore = useMessageStore();


const target = ref('');
const {stop} = useIntersectionObserver(target,
([{isIntersecting}],observerElement)=>{
    if(isIntersecting && messageStore.getIsLoaded){
        messageStore.fetchPreviousMessage(props.room.slug);
    }
});


</script>

<template>
    <main id="page-content" class="absolute inset-0">
        <div
            class="container mx-auto space-y-6 space-y-reverse px-4 py-24 lg:p-8 lg:pb-28 xl:max-w-7xl flex flex-col-reverse h-full overflow-y-auto">
            <div v-for="message in messageStore.allMessage" :key="message.id"
                class="flex w-5/6 flex-col gap-2 lg:w-2/3 xl:w-1/3 "
                :class="{
                    'items-start'
                    : message.user.id != $page.props.auth.user.id,
                    'items-end ms-auto'
                    : message.user.id == $page.props.auth.user.id
                }">

                <p v-if="message.user.id != $page.props.auth.user.id" class="text-sm font-medium text-slate-500">
                    {{ message.user.name }}
                </p>
                <div class="rounded-2xl px-5 py-3 bg-gray-100"
                :class="{
                    'rounded-2xl px-5 py-3 rounded-br-none bg-indigo-600': message.user.id == $page.props.auth.user.id,
                    ' rounded-bl-none': message.user.id != $page.props.auth.user.id
                }">
                    <p class="font-semibold text-slate-600" :class="{
                        ' text-white': message.user.id == $page.props.auth.user.id
                    }">
                        {{ message.content }}
                    </p>
                </div>
                <p class="text-xs font-medium text-slate-500">
                    {{ message.created_at }}
                </p>
            </div>
            <div ref="target"></div>
        </div>
    </main>
</template>
