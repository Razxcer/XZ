import { defineStore } from "pinia";

export const useUserStore = defineStore('user', {
    state: ()=>({
        userData: null,
    }),

    actions: {
        setUser(user){
            this.userData = user;
        }
    },

    persist: true,
});




