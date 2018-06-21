import Vue from 'vue'
import Router from 'vue-router';
Vue.use(Router);

export default new Router({//定义路由
    routes: [
        {
            path: '/',
            name: '首页',
            component: require('../views/Home'),
        },
        {
            path: '/about',
            name: '关于我们',
            component: require('../views/About'),
        },
        {
            path: '/login',
            name: '系统登录',
            component: require('../views/login'),
        },
        {
            path: '/merchants',
            name: '商户管理',
            component: require('../views/admin/merchants'),
            meta : {
                requireAuth: true,
            },
        },
        {
            path: '/actionlog',
            name: '操作日志',
            component: require('../views/admin/merchants'),
            meta : {
                requireAuth: true,
            },
        },
        {
            path: '/promise/roles',
            name: '角色管理',
            component: require('../views/admin/promise/roles'),
            meta : {
                requireAuth: true,
            },
        },
        {
            path: '/promise/nodes',
            name: '权限节点',
            component: require('../views/admin/promise/nodes'),
            meta : {
                requireAuth: true,
            },
        },
        {
            path: '/promiss/users',
            name: '用户管理',
            component: require('../views/admin/promise/users'),
            meta : {
                requireAuth: true,
            },
        },
        {
            path: '/globalset/brand',
            name: '品牌设置',
            component: require('../views/admin/globalset/brand'),
            meta : {
                requireAuth: true,
            },
        },
        {
            path: '/globalset/vin',
            name: '车架号设置',
            component: require('../views/admin/globalset/vin'),
            meta : {
                requireAuth: true,
            },
        },
        {
            path: '/globalset/companytype',
            name: '公司类型设置',
            component: require('../views/admin/globalset/companytype'),
            meta : {
                requireAuth: true,
            },
        },
        {
            path: '/docs',
            name: '接口文档',
            component: require('../views/docs'),
        },
    ],
});