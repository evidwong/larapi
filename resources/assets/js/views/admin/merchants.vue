<template>
    <div v-loading="loading">
        <div class="btn-groups">
            <el-row>
                <el-button @click="addMerchant">增加</el-button>
                <el-button type="info" @click="editMerchant">修改</el-button>
                <el-button type="warning" @click="delayMerchant">延期</el-button>
                <el-button type="danger" @click="delMerchant">删除</el-button>
            </el-row>
            <el-row></el-row>
        </div>
        <el-table :data="tableData" border style="width: 100%" @row-click="clickTableRow" height="500px">
            <el-table-column prop="id" label="ID" show-overflow-tooltip width="50px"/>
            <el-table-column prop="name" label="商户名称" show-overflow-tooltip width="120px"/>
            <el-table-column prop="type" label="公司类型" show-overflow-tooltip width="120px"/>
            <el-table-column prop="contact" label="联系人" show-overflow-tooltip width="80px"/>
            <el-table-column prop="hand_phone" label="手机" show-overflow-tooltip width="100px"/>
            <el-table-column prop="tech_ad" label="技术顾问" show-overflow-tooltip width="80px"/>
            <el-table-column prop="service_start" label="服务开始" width="100px"/>
            <el-table-column prop="service_expire" label="服务到期" width="100px"/>
            <el-table-column prop="created_at" label="创建日期" show-overflow-tooltip width="120px"/>
            <el-table-column prop="auth_brand" label="品牌" show-overflow-tooltip width="120px"/>
            <el-table-column prop="auth_ip" label="授权IP" show-overflow-tooltip width="120px"/>
            <el-table-column prop="auth_time" :formatter="auth_time_format" label="授权时间" width="200px"/>
            <el-table-column prop="auth_speed" label="授权速度" width="80px"/>
            <el-table-column prop="login_times" label="登入次数" width="80px"/>
            <el-table-column prop="query_times" label="查询记录" width="80px"/>
        </el-table>


        <el-row style="text-align: center;padding:15px 0;" v-if="tableData.length>0">
            <Page :totalPage="totalPage" :currentPage="currentPage" :currentPageSize="currentPageSize"
                  @onRefresh="loadData"/>
        </el-row>

        <el-dialog title="商户配置" :visible.sync="dialogFormVisible" :close-on-click-modal="false" width="70%">
            <el-form :inline="true" :model="formData" class="demo-form-inline" label-width="70px"
                     v-loading="submitLoading">
                <el-row>
                    <el-form-item label="商户名称">
                        <el-input v-model="formData.name" placeholder="商户名称"/>
                    </el-form-item>
                    <el-form-item label="技术顾问">
                        <el-input v-model="formData.tech_ad" placeholder="技术顾问"/>
                    </el-form-item>
                    <el-form-item label="登入次数">
                        <el-input v-model="formData.login_times" placeholder="登入次数"/>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="公司类型">
                        <el-select v-model="formData.type" placeholder="请选择公司类型">
                            <el-option
                                    v-for="item in companyType"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.name">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="服务开始">
                        <el-date-picker v-model="formData.service_start" type="date" value-format="yyyy-MM-dd"
                                        placeholder="服务开始日期">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item label="查询记录">
                        <el-input v-model="formData.query_times" placeholder="查询记录"/>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="联系人">
                        <el-input v-model="formData.contact" placeholder="联系人"/>
                    </el-form-item>
                    <el-form-item label="服务到期">
                        <el-date-picker
                                v-model="formData.service_expire"
                                type="date"
                                value-format="yyyy-MM-dd"
                                placeholder="服务到期日期">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item label="">

                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="手机">
                        <el-input v-model="formData.hand_phone" placeholder="手机"/>
                    </el-form-item>
                    <el-form-item label="授权时间">
                        <el-time-picker
                                is-range
                                v-model="formData.auth_time"
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
                        <el-input v-model="formData.tel_phone" placeholder="电话"/>
                    </el-form-item>
                    <el-form-item label="授权key">
                        <el-input v-model="formData.auth_key" placeholder="授权key"/>
                    </el-form-item>
                    <el-form-item label="授权次数">
                        <el-input v-model="formData.auth_number" placeholder=""/>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="城市" class="large_item">
                        <el-cascader
                                v-model="formData.city"
                                placeholder="可输入文字搜索"
                                :options="options"
                                filterable
                                change-on-select
                        />
                    </el-form-item>
                </el-row>
                <el-row>

                    <el-form-item label="地址" class="large_item">
                        <el-input v-model="formData.address" placeholder="地址"/>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="授权IP" class="large_item">
                        <el-input v-model="formData.auth_ip" placeholder="授权IP"/>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="授权品牌" class="large_item">
                        <el-select v-model="formData.auth_brand" multiple placeholder="请选择授权品牌" style="width:100%;">
                            <el-option
                                    v-for="item in brandConfigs"
                                    :key="item.id"
                                    :label="item.brand_name"
                                    :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item label="备注" class="large_item">
                        <el-input type="textarea" v-model="formData.remarks"/>
                    </el-form-item>

                    <el-form-item label="证照" class="large_item">
                        <el-input v-model="formData.pics" placeholder="审批人"/>
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


        <el-dialog title="商户配置" :visible.sync="delayDialogVisible" :close-on-click-modal="false">
            <el-form :model="formData" class="demo-form-inline" label-width="70px"
                     v-loading="submitLoading">
                <el-row>
                    <el-form-item label="商户名称">
                        <el-input v-model="formData.name" readonly="true" placeholder="商户名称"/>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="服务到期">
                        <el-date-picker v-model="formData.service_expire" type="date" value-format="yyyy-MM-dd"
                                        placeholder="服务开始日期">
                        </el-date-picker>
                    </el-form-item>
                </el-row>

                <el-row style="text-align:center;">
                    <el-form-item>
                        <el-button type="primary" size="medium" @click="submitDelayForm">提交</el-button>
                        <el-button size="medium" @click="delayDialogVisible = false">取消</el-button>
                    </el-form-item>
                </el-row>
            </el-form>
        </el-dialog>
    </div>


</template>
<script>
    import {getMerchants, deleteMerchants, getBaseInfos, createMerchants, getBrandConfigs} from '../../api/api';
    import Page from "../../components/Page.vue"
    import area from '../../pca-code.json';

    var globalFormData = {
        id: '',
        name: '',
        type: '',
        contact: '',
        hand_phone: '',
        tech_ad: '',
        tel_phone: '',
        city: [],
        address: '',
        login_times: '',
        query_times: '',
        service_start: '',
        service_expire: '',
        auth_time: '',
        auth_speed: '',
        auth_number: '',
        auth_key: '',
        auth_ip: '',
        auth_brand: '',
        remarks: '',
        pics: '',
    };
    export default {
        components: {
            Page,
        },
        name: "merchants",
        data() {
            return {
                loading: true,
                currentPage: 1,
                totalPage: 0,
                currentPageSize: 10,
                tableData: [],
                dialogFormVisible: false,
                tempRow: {},
                formData: globalFormData,
                formLabelWidth: '120px',
                options: area,
                brandConfigs: {},
                submitLoading: false,
                delayDialogVisible: false
            }
        },
        computed: {
            companyType() {
                if (localStorage.companyType) {
                    return JSON.parse(localStorage.companyType)
                } else {
                    return []
                }
            }
        },
        mounted() {
            let params = {currentPage: this.currentPage, currentPageSize: this.currentPageSize};
            getMerchants(params).then(res => {
                this.totalPage = res.total;
                this.tableData = res.merchants;
                this.loading = false;
            });
            getBaseInfos({type: 1}).then(res => {
                localStorage.companyType = JSON.stringify(res.data)
            })
            getBrandConfigs({}).then(res => {
                this.brandConfigs = res.data
            });
        },
        methods: {
            handleSizeChange(val) {
            },
            handleCurrentChange(val) {
            },
            addMerchant() {
                this.dialogFormVisible = true;
                this.formData = Object.assign({}, globalFormData);
            },
            editMerchant() {
                if (this.tempRow.hasOwnProperty('id')) {
                    this.formData = Object.assign({}, this.tempRow);
                    this.formData.city = this.formData.city == '' ? [] : (this.formData.city).split(',');
                    this.formData.auth_time = [];
                    this.formData.auth_time.push(this.formData.auth_start_time);
                    this.formData.auth_time.push(this.formData.auth_end_time);

                    this.dialogFormVisible = true;
                }
            },
            delayMerchant() {
                if (this.tempRow) {
                    this.formData.assign({}, this.tempRow);
                    this.delayDialogVisible = true;
                }
            },
            submitDelayForm() {
                this.submitLoading = true;
                createMerchants({
                    id: this.formData.id,
                    service_expire: this.formData.service_expire,
                    action: 'delay'
                }).then(res => {
                    console.log(res);
                    this.formData = globalFormData;
                    this.submitLoading = false;
                    this.delayDialogVisible = false;
                    this.$message({
                        message: res.msg,
                        type: 'success',
                        onClose: () => {
                            console.log('setTimeOut')
                            setTimeout(() => {
                                console.log('setTimeOut')
                                this.loadData({
                                    currentPage: this.currentPage,
                                    currentPageSize: this.currentPageSize
                                })
                            }, 1000)
                        }
                    });
                });
            },
            submitForm() {
                this.submitLoading = true;
                createMerchants(this.formData).then(res => {
                    this.formData = globalFormData;
                    this.submitLoading = false;
                    this.dialogFormVisible = false;
                    this.$message({
                        message: res.msg,
                        type: 'success',
                        onClose: () => {
                            console.log('setTimeOut')
                            setTimeout(() => {
                                console.log('setTimeOut')
                                this.loadData({
                                    currentPage: this.currentPage,
                                    currentPageSize: this.currentPageSize
                                })
                            }, 1000)
                        }
                    });
                });
            },
            loadData(params) {
                this.loading = true;
                getMerchants(params).then(res => {
                    this.totalPage = res.total;
                    this.currentPage = params.currentPage;
                    this.currentPageSize = params.currentPageSize;
                    this.tableData = res.merchants;
                    this.loading = false;

                });
            },
            clickTableRow(row, event, column) {
                this.tempRow = row;
            },
            auth_time_format(row, column, cellValue, index) {
                return row.auth_start_time + ' - ' + row.auth_end_time
            },
            delMerchant() {
                if (!this.tempRow.hasOwnProperty('id') || this.tempRow.id == '') {
                    this.$message.error('请选择要删除的记录');
                    return;
                }
                deleteMerchants({id: this.tempRow.id}).then(res => {
                    if (res.code != 0) {
                        this.$message({
                            message: '删除失败',
                            type: 'warning'
                        });
                    } else {
                        if (this.tableData.length == 1 && this.currentPage > 1) {
                            this.currentPage--
                        }
                        this.$message({
                            message: res.msg,
                            type: 'success',
                            onClose: this.loadData({
                                currentPage: this.currentPage,
                                currentPageSize: this.currentPageSize
                            })
                        });

                    }
                })
                ;
            }
        }

    }
</script>
<style>
    .btn-groups {
        padding: 15px;
    }

    .el-form-item {
        margin-bottom: 10px;
    }

    .large_item {
        width: 100%;
    }

    .large_item .el-form-item__content {
        width: 80%;
    }

    .large_item .el-form-item__content .el-select, .large_item .el-form-item__content .el-input, .large_item .el-form-item__content .el-cascader {
        width: 100%;
    }

    .el-date-editor.el-input, .el-date-editor.el-input__inner {
        width: auto;
    }

    .el-input--prefix .el-input__inner {
        text-indent: 30px;
        /*padding-left: 0;*/
    }

    .el-input--suffix .el-input__inner {
        padding-right: 0;
    }

    .medium_item {
        width: 60%;
    }

    .medium_item .el-form-item__content {
        width: 60%;
    }

    .el-select .el-input__inner {
        padding: 0 15px;
    }
</style>