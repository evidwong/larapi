import Vue from 'vue' //引入vue
import router from './router/router.js'
import Vuex from 'vuex';
import axios from 'axios';
import Element from 'element-ui';
import store from './store/store.js';


import App from './views/App' //加载views文件夹下的App组件
Vue.use(Vuex);
Vue.use(Element);

// 去掉开发模式信息
Vue.config.productionTip = false;

axios.defaults.baseURL = 'http://larapi.test';
axios.interceptors.request.use(function (config) {
    if (localStorage.token) {
        config.headers.Authorization = `Bearer ${localStorage.token}`;
    }
    return config;
}, function (err) {
    return Promise.reject(err);
});
/*axios.interceptors.response.use(function (response){
    // 处理响应数据
    return response;
}, function (error){
    // 处理响应失败
    console.log('axios error response');
    console.log(error);
    return Promise.reject(error);
});*/
router.beforeEach((to, from, next) => {
    if (to.path === '/login') {
        sessionStorage.removeItem('userInfo')
    }
    // 这里的meta就是我们刚刚在路由里面配置的meta
    if (to.meta.requireAuth) {
        let user = JSON.parse(sessionStorage.getItem('userInfo'))
        // 下面这个判断是自行实现到底是否有没有登录
        if (!user) {
            next({
                path: '/login',
                query: {redirect: to.fullPath}
            })
        } else {
            next()
        }
    } else {
        next()
    }
});
const app = new Vue({//实例化Vue
    el: '#app',
    components: {App},
    router,
    store
});