<template>
    <el-container>
        <Nav></Nav>
        <div class="container">
            <div class="panel panel-default">
                <router-view></router-view>
            </div>
        </div>
        <el-footer>
            footer
        </el-footer>
    </el-container>
</template>

<script>
    import Nav from "./../components/Nav.vue"//引入components中的Nav组件
    export default {
        components:{
            Nav,
        },
        name:"app",
        loading:true
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    footer {
        position: absolute;
        bottom: 0;
        width: 100% ;
        /* Set the fixed height of the footer here */
        height: 60px;
        background-color: #000;
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

</style>