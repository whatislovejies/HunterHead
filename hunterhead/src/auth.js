export default {
  namespaced: true,
  state: {
    isAuthenticated: null,
    userRole: null,
    userId: null
  },
  actions: {
    initAuth({ commit }) {
      const isAuthenticated = localStorage.getItem('isAuthenticated');
      const userRole = localStorage.getItem('userRole');
      const userId = localStorage.getItem('userId');
      if (isAuthenticated !== null) {
        commit('setAuth', { isAuthenticated: isAuthenticated === 'true', userId });
      }
      if (userRole !== null) {
        commit('setUserRole', userRole);
      }
    },
    setUserRole({ commit }, { userRole, userId }) {
      commit('setUserRole', userRole);
      commit('setAuth', { isAuthenticated: true, userId });
    },
    logout({ commit }) {
      commit('setUserRole', 'guest');
      commit('setAuth', { isAuthenticated: false, userId: null });
    }
  },
  mutations: {
    setAuth(state, { isAuthenticated, userId }) {
      state.isAuthenticated = isAuthenticated;
      state.userId = userId;
      localStorage.setItem('isAuthenticated', isAuthenticated.toString());
      localStorage.setItem('userId', userId);
    },
    setUserRole(state, userRole) {
      state.userRole = userRole;
      localStorage.setItem('userRole', userRole);
    }
  }
};
