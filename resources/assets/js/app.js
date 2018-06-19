import Vue from 'vue' //引入vue
import VueRouter from 'vue-router'//引入vue-router
import Element from 'element-ui';
Vue.use(VueRouter);
Vue.use(Element);

import App from './views/App' //加载views文件夹下的App组件
const router = new VueRouter({//定义路由
    routes: [
        {
            path: '/',
            name: '首页',
            component: require('./views/Home'),
        },
        {
            path: '/about',
            name: '关于我们',
            component: require('./views/About'),
        },
        {
            path: '/login',
            name: '系统登录',
            component: require('./views/login'),
        },
        {
            path: '/merchants',
            name: '商户管理',
            component: require('./views/admin/merchants'),
        },
    ],
});
const app = new Vue({//实例化Vue
    el: '#app',
    components: { App },
    router,
});