<template>
    <!-- 头部导航 -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
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
                <el-menu :default-active="$route.path" class="el-menu-demo" mode="horizontal" @select="handleSelect" style="background-color:none !important;">
                  <el-menu-item index="/home"><router-link to="/home">个人中心</router-link></el-menu-item>
                  <el-menu-item index="/merchants"><router-link to="/merchants">商户管理</router-link></el-menu-item>
                  <el-submenu index="/promiss">
                    <template slot="title">权限管理</template>
                    <el-menu-item index="/promiss/roles">角色管理</el-menu-item>
                    <el-menu-item index="/promiss/nodes">权限节点</el-menu-item>
                    <el-menu-item index="/promiss/users">用户管理</el-menu-item>
                  </el-submenu>
                  <el-menu-item index="/actionlog">操作日志</el-menu-item>
                  <el-menu-item index="/doc"><router-link to="/doc">接口文档</router-link></el-menu-item>
                  <el-menu-item index="/login" style="float:right;"><router-link to="/login">登录</router-link></el-menu-item>
                </el-menu>
            </div>
        </div>
    </nav>
</template>
<script>
    export default {
        name:"Nav",
        data() {
            return {
                activeIndex: '/',
            };
        },
        created:function(){
            this.defaultIdex()
        },
        beforeUpdate:function(){
            console.log(this.$route)
            // this.activeIndex = this.$route.matched[1].path
        },
        methods: {
          handleSelect(key, keyPath) {
            console.log(key, keyPath);
          },
          defaultIdex(){
                // let path = this.$route.path;
                // console.log(this.$route.matched[1].path);
            }
        }
    }
</script>
<style scoped>

    /* header */
    .navbar-brand{padding: 0;}
    .navbar-brand img{
        width: 130px;
        margin-top: 10px;
        margin-right: 22px;
    }
    .navbar-static-top {
        border-color: #e7e7e7;
        background-color: #fff;
        box-shadow: 0px 1px 11px 2px rgba(42, 42, 42, 0.1);
        border-top: 4px solid #00b5ad;
        margin-bottom: 40px;
        margin-top: 0px;
    }
    a{
        text-decoration: none;
    }
    .el-dropdown-menu__item--divided:before, .el-menu{
        background-color:none !important;
    }
    .el-menu{
        background-color:none !important;
    }
    .el-menu a{
        display:block;
    }
</style>