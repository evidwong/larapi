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
            <el-table-column prop="name" label="名称"/>
            <el-table-column prop="email" label="邮箱"/>
            <el-table-column prop="role_id" label="路径"/>
            <el-table-column prop="created_at" label="创建日期"/>
            <el-table-column prop="updated_at" label="创建日期"/>
        </el-table>


        <el-row style="text-align: center;padding:15px 0;" v-if="tableData.length>0">
            <Page :totalPage="totalPage" :currentPage="currentPage" :currentPageSize="currentPageSize"
                  @onRefresh="loadData"/>
        </el-row>

        <el-dialog title="节点设置" :visible.sync="dialogFormVisible" :close-on-click-modal="false">
            <el-form :model="formData" v-loading="submitLoading" label-width="100px">
                <el-form-item label="角色">

                    <el-cascader
                            :options="permises"
                            :show-all-levels="false"
                            v-model="parentId"
                            change-on-select
                            placeholder="请选择上级"
                            @change="selectParent"
                    ></el-cascader>
                </el-form-item>
                <el-form-item label="名称">
                    <el-input v-model="formData.name"/>
                </el-form-item>
                <el-form-item label="Email">
                    <el-input v-model="formData.title"/>
                </el-form-item>
                <el-form-item label="密码">
                    <el-input v-model="formData.path"/>
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
    import {getUsers, createUser, deleteUser} from '../../../api/api';
    import Page from "../../../components/Page.vue"

    var globalFormData = {
        id: '',
        name: '',
        email: '',
        password: '',
        is_admin: '',
        role_id: 0,
        cid: 1,
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
                parentId: [],
                permises: [],
                types: [
                    {value: 0, label: '分类'},
                    {value: 1, label: '模块'},
                    {value: 2, label: '操作'}
                ]
            }
        },
        computed: {},
        mounted() {
            let params = {currentPage: this.currentPage, currentPageSize: this.currentPageSize, type: 1};
            getUsers(params).then(res => {
                this.totalPage = res.total;
                this.tableData = res.data;
                this.loading = false;
            });
            getUsers({}).then(res => {

                this.permises = res.data
            })
        },
        methods: {
            format_is_menu(row, column, cellValue, index) {
                return cellValue == 0 ? '否' : '是';
            },
            format_type(row, column, cellValue, index) {
                let t = '';
                for (let type of this.types) {
                    if (cellValue == type.value) {
                        t = type.label;
                        break;
                    }
                }
                return t;
            },
            selectParent(val) {
                console.log(val)
                this.formData.pid = val.pop()
            },
            add() {
                this.dialogFormVisible = true;
                this.formData = Object.assign({}, globalFormData);
            },
            Edit() {
                if (this.tempRow.hasOwnProperty('id')) {
                    this.formData = Object.assign({}, this.tempRow);
                    this.formData.is_menu = this.formData.is_menu + '';
                    // this.formData.type = this.formData.type+''
                    console.log(this.formData);
                    let that = this;
                    first:
                        for (let per of this.permises) {
                            if (per.id == that.formData.pid) {
                                that.parentId = [per.id];
                                break first;
                            }
                            if (per.hasOwnProperty('children') && per.children.length > 0) {
                                for (let childPer of per.children) {
                                    if (childPer.id == that.formData.pid) {
                                        that.parentId = [per.id, childPer.id];
                                        break first;
                                    }
                                    if (childPer.hasOwnProperty('children') && childPer.children.length > 0) {
                                        for (let subChild of childPer.children) {
                                            if (subChild.id == that.formData.pid) {
                                                that.parentId = [per.id, childPer.id, subChild.id];
                                                break first;
                                            }
                                        }
                                    }
                                }
                            }
                        }

                    console.log(that.parentId)
                    this.dialogFormVisible = true;
                } else {
                    this.$message.error('请选择要修改的记录');
                }
            },
            submitForm() {
                this.submitLoading = true;
                createUser(this.formData).then(res => {
                    this.formData = globalFormData;
                    this.submitLoading = false;
                    this.dialogFormVisible = false;
                    this.tempRow = {};
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
                getUsers(params).then(res => {
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
                deleteUser({id: this.tempRow.id}).then(res => {
                    if (res.code != 0) {
                        this.$message({
                            message: '删除失败',
                            type: 'warning'
                        });
                    } else {
                        this.tempRow = {};
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