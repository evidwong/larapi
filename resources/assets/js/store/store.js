import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const state = {
    isLogined: false,
    userInfo: JSON.parse(sessionStorage.getItem('userInfo')) || ''
};
const mutations = {
    LOGIN(state) {
        // 先让登录状态变为登录了
        state.isLogined = true;
        // 然后去sessionStorage取用户数据
        state.userInfo=JSON.parse(sessionStorage.getItem('userInfo'));
    },
    // 登出
    LOGOUT(state) {
        // 这个同理
        state.userInfo = '';
    }
};
const actions = {
    login ({commit}) {
        commit('LOGIN')
    },
    // 同样来个logout
    logout ({commit}) {
        commit('LOGOUT')
    }
};
const getters={
    getToken(state) {
        return state.userInfo.token;
    },
    isLogin() {
        let token_expire = Date.parse(new Date(store.state.userInfo.expire || localStorage.token_expire));
        let now_time = Date.parse(new Date());
        console.log('now_time : ', now_time, 'expire : ', token_expire);
        if (localStorage.token != '' && token_expire > now_time) {
            return true;
        } else {
            return false;
        }
    }
};
export default new Vuex.Store({
    state,
    mutations,
    actions
})