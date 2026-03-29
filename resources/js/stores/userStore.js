import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
    favoritesCount: 0,
    discount: null
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

    //Скидка
    setUserDiscount(procent){
      this.discount = procent;
    },



    //Чистим юзера
    clearUser() {
      this.user = null;
      this.favoritesCount = 0;
    }
  }
});




