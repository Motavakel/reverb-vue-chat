import { defineStore } from 'pinia'

export const useMessageStore = defineStore('message', {
  state: () => {
    return {page:1,message:[] }
  },

  actions: {

  },

  getters:{
    allMessage(state){
        return state.message
    }
  }
})
