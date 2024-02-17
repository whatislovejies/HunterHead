import { createStore } from 'vuex';
import auth from './auth.js';

const store = createStore({
  state: {
    isAuthenticated: null,
    userRole: null
  },
  mutations: {
    CLEAR_AUTH_DATA(state) {
      // Очистка данных в хранилище
      state.auth.token = null;
      state.auth.user = null;},
    setAuth(state, isAuthenticated) {
      state.isAuthenticated = isAuthenticated;
      localStorage.setItem('isAuthenticated', isAuthenticated.toString());
    },
    setUserRole(state, userRole) {
      state.userRole = userRole;
      localStorage.setItem('userRole', userRole);
    }
  },
  actions: {
    logout({ commit }) {
      // Очистка данных в хранилище
      commit('CLEAR_AUTH_DATA');},
    async initStore({ commit }) {
      const isAuthenticated = localStorage.getItem('isAuthenticated');
      const userRole = localStorage.getItem('userRole');
      if (isAuthenticated !== null) {
        commit('setAuth', isAuthenticated === 'true');
      }
      if (userRole !== null) {
        commit('setUserRole', userRole);
      }
    },
    login({ commit }, { userRole, userId }) {
      commit('setUserRole', userRole);
      commit('setAuth', true);
    },
    logout({ commit }) {
      commit('setUserRole', 'guest');
      commit('setAuth', false);
    }
  },
  modules: {
    auth
  }
});

store.dispatch('auth/initAuth');

export default store;