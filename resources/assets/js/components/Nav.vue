<template>
    <!-- 头部导航 -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <router-link class="navbar-brand" to="/">
                    <img src="/images/logo.png" alt="">
                </router-link>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <el-menu :default-active="$route.path" class="el-menu-demo" mode="horizontal" @select="handleSelect"
                         style="background-color:none !important;">
                    <el-menu-item index="/home">
                        <router-link to="/home">个人中心</router-link>
                    </el-menu-item>
                    <el-menu-item index="/merchants">
                        <router-link to="/merchants">商户管理</router-link>
                    </el-menu-item>
                    <el-submenu index="/promise">
                        <template slot="title">权限管理</template>
                        <el-menu-item index="/promise/roles">角色管理</el-menu-item>
                        <el-menu-item index="/promise/nodes">权限节点</el-menu-item>
                        <el-menu-item index="/promise/users">用户管理</el-menu-item>
                    </el-submenu>
                    <el-submenu index="/globalset">
                        <template slot="title">通用设置</template>
                        <el-menu-item index="/globalset/brand"><router-link to="/globalset/brand">品牌设置</router-link></el-menu-item>
                        <el-menu-item index="/globalset/vin"><router-link to="/globalset/vin">车架号设置</router-link></el-menu-item>
                        <el-menu-item index="/globalset/companytype"><router-link to="/globalset/companytype">公司类型设置</router-link></el-menu-item>
                    </el-submenu>
                    <el-menu-item index="/actionlog">操作日志</el-menu-item>
                    <el-menu-item index="/docs">
                        <router-link to="/docs">接口文档</router-link>
                    </el-menu-item>
                    <el-submenu index="" style="float:right;" v-if="user">
                        <template slot="title">{{user.name}}</template>
                        <el-menu-item index="">基本资料</el-menu-item>
                        <el-menu-item index="" @click="logout">安全退出</el-menu-item>
                    </el-submenu>
                    <el-menu-item index="/login" style="float:right;" v-else>
                        <router-link to="/login">登录</router-link>
                    </el-menu-item>
                </el-menu>
            </div>
        </div>
    </nav>
</template>
<script>
    export default {
        name: "Nav",
        data() {
            return {
                activeIndex: '/',
            };
        },
        computed: {
            user() {
                return this.$store.state.userInfo
            }
        },
        created: function () {
        },
        beforeUpdate: function () {
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            },
            logout() {
                this.$store.dispatch('logout')
                this.$router.push({path:'/login'})
            }
        }
    }
</script>
<style scoped>

    /* header */
    .navbar-brand {
        padding: 0;
    }

    .navbar-brand img {
        width: 130px;
        margin-top: 10px;
        margin-right: 22px;
    }

    .navbar-static-top {
        border-color: #e7e7e7;
        background-color: #fff;
        box-shadow: 0px 1px 11px 2px rgba(42, 42, 42, 0.1);
        border-top: 4px solid #00b5ad;
        margin-bottom: 25px;
        margin-top: 0px;
    }

    a {
        text-decoration: none;
    }

    .el-dropdown-menu__item--divided:before, .el-menu {
        background-color: transparent !important;
    }

    .el-menu {
        background-color: transparent !important;
    }

    .el-menu a {
        display: block;
    }

    .el-menu--horizontal {
        border-bottom: none;
    }
</style>