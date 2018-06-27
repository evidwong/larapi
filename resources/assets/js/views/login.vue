<template>
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-position="left" label-width="0px"
             class="demo-ruleForm login-container">
        <h3 class="title">系统登录</h3>
        <el-form-item prop="email">
            <el-input type="text" v-model="ruleForm.email" auto-complete="off" placeholder="邮箱"></el-input>
        </el-form-item>
        <el-form-item prop="passcode">
            <el-input type="password" v-model="ruleForm.passcode" auto-complete="off" placeholder="密码"></el-input>
        </el-form-item>
        <el-checkbox v-model="checked" checked class="remember">记住密码</el-checkbox>
        <el-form-item style="width:100%;">
            <el-button type="primary" style="width:100%;" @click.native.prevent="handleSubmit" :loading="logining">登录
            </el-button>
            <!--<el-button @click.native.prevent="handleReset2">重置</el-button>-->
        </el-form-item>
    </el-form>
</template>

<script>
    import {requestLogin} from '../api/api';

    export default {
        data() {
            return {
                logining: false,
                ruleForm: {
                    email: localStorage.email||'',
                    passcode: localStorage.passcode||''
                },
                rules: {
                    email: [
                        {required: true, message: '请输入邮箱', trigger: 'blur'},
                        {type:'email',message: '请输入正确的邮箱地址', trigger: 'blur'}
                    ],
                    passcode: [
                        {required: true, message: '请输入密码', trigger: 'blur'},
                    ]
                },
                checked: true
            };
        },
        methods: {
            handleReset2() {
                this.$refs.ruleForm.resetFields();
            },
            handleSubmit(ev) {
                var _this = this;
                this.$refs.ruleForm.validate((valid) => {
                    if (valid) {
                        //_this.$router.replace('/table');
                        this.logining = true;
                        //NProgress.start();
                        var loginParams = {email: this.ruleForm.email, password: this.ruleForm.passcode};
                        requestLogin(loginParams).then(data => {
                            this.logining = false;
                            let {msg, code, user} = data;
                            if (code !== 0) {
                                this.$message.error('登录失败，请检查邮箱和密码是否正确');
                            } else {
                                this.$message({
                                    message: '登录成功',
                                    type: 'success'
                                });
                                if (this.checked){
                                    localStorage.email=this.ruleForm.email;
                                    localStorage.passcode=this.ruleForm.passcode;
                                }
                                sessionStorage.setItem('userInfo', JSON.stringify(user));
                                this.$store.dispatch('login');
                                let redirect = decodeURIComponent(this.$route.query.redirect || '/');
                                this.$router.push({//你需要接受路由的参数再跳转
                                    path: redirect
                                });
                                // this.$router.replace({path: '/'});
                            }
                        });
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            }
        }
    }
</script>

<style lang="scss" scoped>
    .login-container {
        /*box-shadow: 0 0px 8px 0 rgba(0, 0, 0, 0.06), 0 1px 0px 0 rgba(0, 0, 0, 0.02);*/
        -webkit-border-radius: 5px;
        border-radius: 5px;
        -moz-border-radius: 5px;
        background-clip: padding-box;
        margin: 180px auto;
        width: 350px;
        padding: 35px 35px 15px 35px;
        background: #fff;
        border: 1px solid #eaeaea;
        box-shadow: 0 0 25px #cac6c6;
        .title {
            margin: 0px auto 40px auto;
            text-align: center;
            color: #505458;
        }
        .remember {
            margin: 0px 0px 35px 0px;
        }
    }
</style>