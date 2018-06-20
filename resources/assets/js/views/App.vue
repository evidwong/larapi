<template>
    <el-container>
        <Nav></Nav>
        <div class="container main-container">
            <div class="panel panel-default">
                <router-view></router-view>
            </div>
        </div>
        <el-footer>
                <el-col :span="10" style="text-align: right;padding-right:15px;">
                    <img src="/images/logo.png" alt="">
                </el-col>
                <el-col :span="10">
                    <p class="copy">Copyright © 2018.百思易科技.All Rights Reserved.</p>
                    <p class="beian">ICP备案号：粤ICP备123456号</p>
                </el-col>
        </el-footer>
    </el-container>
</template>

<script>
    import Nav from "./../components/Nav.vue"//引入components中的Nav组件
    export default {
        components: {
            Nav,
        },
        name: "app",
        loading: true
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 60px;
    }

    footer .container {
        padding-right: 15px;
        padding-left: 15px;

    }

    footer .container p {
        margin: 19px 0;
        color: #c1c1c1;

    }

    footer .container p a {
        color: inherit;
    }

    /*@media (min-width: 768px) {
        .container {
            width: 750px
        }
    }

    @media (min-width: 992px) {
        .container {
            width: 970px
        }
    }

    @media (min-width: 1200px) {
        .container {
            width: 1170px
        }
    }*/
    .main-container{
        width: auto;
        margin: 0 5%;
    }
    footer img {
        margin-top: 1.5%;
        width: 130px;
    }
</style>