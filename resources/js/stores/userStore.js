import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
    favoritesCount: 0
  }),
  actions: {
    //Имя
    setUser(userData) {
      this.user = userData;
    },

    //Избранное
    setUserFavorites(count){
      this.favoritesCount = count;
    },



    //Чистим юзера
    clearUser() {
      this.user = null;
      this.favoritesCount = 0;
    }
  }
});




