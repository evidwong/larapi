<template>
    <div v-loading="loading">
        <div class="btn-groups">
            <el-row>
                <el-button @click="add">增加</el-button>
                <el-button type="info" @click="Edit">修改</el-button>
                <el-button type="danger" @click="Delete">删除</el-button>
            </el-row>
        </div>
        <el-table :data="tableData" border style="width: auto" @row-click="clickTableRow" height="500px">
            <el-table-column prop="id" label="ID" show-overflow-tooltip width="50px"/>
            <el-table-column prop="name" label="标题"/>
            <el-table-column prop="created_at" label="创建日期"/>
            <el-table-column prop="updated_at" label="创建日期"/>
        </el-table>


        <el-row style="text-align: center;padding:15px 0;" v-if="tableData.length>0">
            <Page :totalPage="totalPage" :currentPage="currentPage" :currentPageSize="currentPageSize"
                  @onRefresh="loadData"/>
        </el-row>

        <el-dialog title="公司类型设置" :visible.sync="dialogFormVisible" :close-on-click-modal="false">
            <el-form :model="formData" v-loading="submitLoading" label-width="100px">

                <el-form-item label="名称">
                    <el-input v-model="formData.name"/>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submitForm">提交</el-button>
                    <el-button @click="dialogFormVisible = false">取消</el-button>
                </el-form-item>
            </el-form>
        </el-dialog>
    </div>


</template>
<script>
    import {getBaseInfos, createBaseInfo, deleteBaseInfo} from '../../../api/api';
    import Page from "../../../components/Page.vue"

    var globalFormData = {
        id: '',
        name: '',
        type: 1,
        pid: 0,
        status: 1
    };
    export default {
        components: {
            Page,
        },
        name: "brandConfig",
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
                submitLoading: false,
            }
        },
        computed: {},
        mounted() {
            let params = {currentPage: this.currentPage, currentPageSize: this.currentPageSize, type: 1};
            getBaseInfos(params).then(res => {
                this.totalPage = res.total;
                this.tableData = res.data;
                this.loading = false;
            });
        },
        methods: {
            add() {
                this.dialogFormVisible = true;
                this.formData = Object.assign({},globalFormData);
            },
            Edit() {
                if (this.tempRow.hasOwnProperty('id')) {
                    this.formData = Object.assign({},this.tempRow);
                    this.dialogFormVisible = true;
                    var that = this;
                } else {
                    this.$message.error('请选择要修改的记录');
                }
            },
            submitForm() {
                this.submitLoading = true;
                createBaseInfo(this.formData).then(res => {
                    this.formData = globalFormData;
                    this.submitLoading = false;
                    this.dialogFormVisible = false;
                    this.$message({
                        message: res.msg,
                        type: 'success',
                        onClose: () => {
                            this.loadData({
                                currentPage: this.currentPage,
                                currentPageSize: this.currentPageSize,
                                type: 1
                            })
                        }
                    });
                });
            },
            loadData(params) {
                this.loading = true;
                getBaseInfos(params).then(res => {
                    this.totalPage = res.total;
                    this.currentPage = params.currentPage;
                    this.currentPageSize = params.currentPageSize;
                    this.tableData = res.data;
                    this.loading = false;

                });
            },
            clickTableRow(row, event, column) {
                this.tempRow = row;
            },
            Delete() {
                if (!this.tempRow.hasOwnProperty('id') || this.tempRow.id == '') {
                    this.$message.error('请选择要删除的记录');
                    return;
                }
                deleteBaseInfo({id: this.tempRow.id}).then(res => {
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
                            onClose: () => {
                                this.loadData({
                                    currentPage: this.currentPage,
                                    currentPageSize: this.currentPageSize,
                                    type: 1
                                })
                            }
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
</style>