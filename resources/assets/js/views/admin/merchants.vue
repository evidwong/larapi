<template>
    <div>
        <div class="btn-groups">
            <el-row>
                <el-button @click="dialogFormVisible = true">增加</el-button>
                <el-button type="info" @click="editMerchants">修改</el-button>
                <el-button type="warning" @click="delayMerchants">延期</el-button>
                <el-button type="danger" @click="delMerchants">删除</el-button>
            </el-row>
        </div>
        <el-table :data="tableData" height="auto" border style="width: 100%" v-on:onRefresh="loadData($1)">
            <el-table-column prop="id" label="ID"/>
            <el-table-column prop="name" label="商户名称"/>
            <el-table-column prop="type" label="公司类型"/>
            <el-table-column prop="contact" label="联系人"/>
            <el-table-column prop="hand_phone" label="手机"/>
            <el-table-column prop="tech_ad" label="技术顾问"/>
            <el-table-column prop="service_start" label="服务开始"/>
            <el-table-column prop="service_expire" label="服务到期"/>
            <el-table-column prop="created_at" label="创建日期"></el-table-column>
            <el-table-column prop="auth_brand" label="品牌"></el-table-column>
            <el-table-column prop="auth_ip" label="授权IP"></el-table-column>
            <el-table-column prop="auth_time_start" label="授权时间"></el-table-column>
            <el-table-column prop="auth_speed" label="授权速度"></el-table-column>
            <el-table-column prop="login_times" label="登入次数"></el-table-column>
            <el-table-column prop="query_times" label="查询记录"></el-table-column>
        </el-table>
        <el-row style="text-align: center;padding:15px 0;" v-if="tableData.length>0">
            <Page :totalPage="totalPage" :currentPage="currentPage"></Page>
        </el-row>

        <el-dialog title="增加商户" :visible.sync="dialogFormVisible" :close-on-click-modal="false">
            <el-form :inline="true" :model="formInline" class="demo-form-inline" label-width="70px">
                <el-row>
                    <el-form-item label="商户名称">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="技术顾问">
                        <el-input v-model="formInline.tech_ad" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="登入次数">
                        <el-input v-model="formInline.login_times" placeholder="审批人"></el-input>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="公司类型">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="服务开始">
                        <el-date-picker
                                v-model="service_start"
                                type="date"
                                value-format="yyyy-MM-dd"
                                placeholder="服务开始日期">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item label="查询记录">
                        <el-input v-model="formInline.query_times" placeholder="查询记录"></el-input>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="联系人">
                        <el-input v-model="formInline.contact" placeholder="联系人"></el-input>
                    </el-form-item>
                    <el-form-item label="服务到期">
                        <el-date-picker
                                v-model="service_expire"
                                type="date"
                                value-format="yyyy-MM-dd"
                                placeholder="服务到期日期">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item label="">
                        <!--<el-input v-model="formInline.name" placeholder="审批人"></el-input>-->
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="手机">
                        <el-input v-model="formInline.hand_phone" placeholder="手机"></el-input>
                    </el-form-item>
                    <el-form-item label="授权时间">
                        <el-time-picker
                                is-range
                                v-model="formInline.auth_time"
                                range-separator="至"
                                start-placeholder="开始时间"
                                end-placeholder="结束时间"
                                value-format="HH:mm:ss"
                                placeholder="选择时间范围">
                        </el-time-picker>

                    </el-form-item>

                </el-row>
                <el-row>
                    <el-form-item label="电话">
                        <el-input v-model="formInline.tel_phone" placeholder="电话"></el-input>
                    </el-form-item>
                    <el-form-item label="授权key">
                        <el-input v-model="formInline.auth_key" placeholder="授权key"></el-input>
                    </el-form-item>
                    <el-form-item label="授权次数">
                        <el-input v-model="formInline.auth_number" placeholder=""></el-input>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="城市" class="large_item">
                        <el-cascader
                                    v-model="formInline.city"
                                     placeholder=""
                                     :options="options"
                                     filterable
                                     change-on-select
                        ></el-cascader>
                    </el-form-item>
                </el-row>
                <el-row>

                    <el-form-item label="地址"  class="large_item">
                        <el-input v-model="formInline.address" placeholder="地址"></el-input>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="授权IP" class="large_item">
                        <el-input v-model="formInline.auth_ip" placeholder="授权IP"></el-input>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="授权品牌" class="large_item">
                        <el-select v-model="formInline.auth_brand" multiple placeholder="请选择授权品牌" style="width:100%;">
                            <el-option
                                    v-for="item in options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="备注">
                        <el-input type="textarea" v-model="formInline.remarks"></el-input>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="证照">
                        <el-input v-model="formInline.pics" placeholder="审批人"></el-input>
                    </el-form-item>
                </el-row>
                <el-row style="text-align:center;">
                    <el-form-item>
                        <el-button type="primary" size="medium" @click="submitForm">提交</el-button>
                        <el-button size="medium" @click="dialogFormVisible = false">取消</el-button>
                    </el-form-item>
                </el-row>
            </el-form>
        </el-dialog>
    </div>


</template>
<script>
    import {getMerchants} from '../../api/api';
    import Page from "../../components/Page.vue"
    import area from '../../pca-code.json';
    // console.log(area);
    export default {
        components: {
            Page,
        },
        name: "merchants",
        data() {
            return {
                currentPage: 1,
                totalPage:0,
                tableData: [],
                dialogFormVisible: false,
                formInline: {
                    id:'',
                    name:'',
                    type:'',
                    contact:'',
                    hand_phone:'',
                    tech_ad:'',
                    tel_phone:'',
                    city:'',
                    address:'',
                    login_times:'',
                    query_times:'',
                    service_start:'',
                    service_expire:'',
                    auth_time:'',
                    auth_speed:'',
                    auth_number:'',
                    auth_key:'',
                    auth_ip:'',
                    auth_brand:'',
                    remarks:'',
                    pics:'',
                },
                formLabelWidth: '120px',
                options: area,
                service_start:'',
                service_expire:''
            }
        },
        computed: {
        },
        mounted(){
            let that=this
            let params={currentPage:1,currentPageSize:10};
            getMerchants(params).then(res=>{
                this.totalPage=res.merchants.length;
                this.currentPage=1;
                that.tableData=res.merchants
            });
        },
        methods: {
            handleSizeChange(val) {
            },
            handleCurrentChange(val) {
            },
            addMerchants() {
                console.log(Page.data().currentPage)
            },
            editMerchants() {
            },
            delMerchants() {
            },
            delayMerchants() {
                //
            },
            submitForm() {
                console.log(this.formInline)
            },
            loadData(params){
                console.log(2222222)
                getMerchants(params).then(res=>{
                    this.totalPage=res.merchants.length;
                    this.currentPage=params.currentPage;
                    this.currentPageSize=params.currentPageSize;
                    that.tableData=res.merchants
                });
            }
        }

    }
</script>
<style>
    .btn-groups {
        padding: 15px;
    }
    .el-form-item{
        margin-bottom:10px;
    }
    .large_item{
        width:100%;
    }
    .large_item .el-form-item__content{
        width:80%;
    }
    .large_item .el-form-item__content .el-select,.large_item .el-form-item__content .el-input,.large_item .el-form-item__content .el-cascader{
        width:100%;
    }
    .el-date-editor.el-input, .el-date-editor.el-input__inner{
        width:auto;
    }
    .el-input--prefix .el-input__inner{
        text-indent: 30px;
        /*padding-left: 0;*/
    }
    .el-input--suffix .el-input__inner{
        padding-right: 0;
    }
    .medium_item{
        width: 60%;
    }
    .medium_item .el-form-item__content{
        width: 60%;
    }
</style>