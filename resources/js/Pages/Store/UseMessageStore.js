import axios from 'axios'
import { defineStore } from 'pinia'

export const useMessageStore = defineStore('message', {
  state: () => {
    return { page: 1, message: [], isLoaded: false }
  },

  actions: {
    async fetchMessage(roomSlug, page = 1) {
      try {
        const response = await axios.get(`/rooms/${roomSlug}/messages?page=${page}`);
        if (response.data && response.data.data) {
          this.message = [...this.message, ...response.data.data];
          this.page = response.data.meta.current_page;
          this.isLoaded = true;
        }
      } catch (error) {
        console.error("Error fetching messages:", error);
        this.isLoaded = false;
      }
    },

    async fetchPreviousMessage(roomSlug) {
      await this.fetchMessage(roomSlug, this.page + 1);
    },

    async storeMessage(roomSlug,payloud){
        await axios.post(`/rooms/${roomSlug}/messages`,payloud,{
            headers:{
               "X-Socket-Id":Echo.socketId()
            }
        })
        .then((response)=>{
            pushMessage(response.data);
        });
    },
    pushMessage(message){
        this.message.pop();
        this.message = [message,...this.message];
    }
  },

  getters: {
    allMessage(state) {
      return state.message;
    },
    getIsLoaded(state) {
      return state.isLoaded;
    }
  }
});
