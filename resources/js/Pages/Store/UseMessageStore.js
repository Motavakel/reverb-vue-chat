import axios from 'axios'
import { defineStore } from 'pinia'

export const useMessageStore = defineStore('message', {
  state: () => {
    return {page:1,message:[] }
  },

  actions: {
    async fetchMessage(roomSlug,page=1){
        console.log("roomSlug:", roomSlug);

        await axios
        .get(`/rooms/${roomSlug}/messages?page=${page}`)
        .then((response)=>{

            //To merge two arrays in JavaScript, combining previous messages with new messages
            this.message = [...this.message,...response.data.data];
            this.page = response.data.meta.curent_page;
        });
    }
  },

  getters:{
    allMessage(state){
        return state.message
    }
  }
})
