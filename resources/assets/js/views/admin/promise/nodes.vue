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
            <el-table-column prop="title" label="标题"/>
            <el-table-column prop="name" label="标识"/>
            <el-table-column prop="guard_name" label="分组标识"/>
            <el-table-column prop="path" label="路径"/>
            <el-table-column prop="sort" label="排序"/>
            <el-table-column prop="type" :formatter="format_type" label="类型"/>
            <el-table-column prop="is_menu" :formatter="format_is_menu" label="是否菜单"/>
            <el-table-column prop="description" label="描述"/>
            <el-table-column prop="created_at" label="创建日期"/>
            <el-table-column prop="updated_at" label="创建日期"/>
        </el-table>


        <el-row style="text-align: center;padding:15px 0;" v-if="tableData.length>0">
            <Page :totalPage="totalPage" :currentPage="currentPage" :currentPageSize="currentPageSize"
                  @onRefresh="loadData"/>
        </el-row>

        <el-dialog title="节点设置" :visible.sync="dialogFormVisible" :close-on-click-modal="false">
            <el-form :model="formData" v-loading="submitLoading" label-width="100px">
                <el-form-item label="上级">

                    <el-cascader
                            :options="permises"
                            :show-all-levels="false"
                            v-model="parentId"
                            change-on-select
                            placeholder="请选择上级"
                            @change="selectParent"
                    ></el-cascader>
                </el-form-item>
                <el-form-item label="标识">
                    <el-input v-model="formData.name"/>
                </el-form-item>
                <el-form-item label="分组标识">
                    <el-input v-model="formData.guard_name"/>
                </el-form-item>
                <el-form-item label="标题">
                    <el-input v-model="formData.title"/>
                </el-form-item>
                <el-form-item label="路径">
                    <el-input v-model="formData.path"/>
                </el-form-item>
                <el-form-item label="是否菜单">
                    <el-radio v-model="formData.is_menu" label="0" border>否</el-radio>
                    <el-radio v-model="formData.is_menu" label="1" border>是</el-radio>
                </el-form-item>
                <el-form-item label="排序">
                    <el-input v-model="formData.sort"/>
                </el-form-item>
                <el-form-item label="类型">
                    <el-select v-model="formData.type" placeholder="请选择">
                        <el-option
                                v-for="item in types"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="描述">
                    <el-input type="textarea" v-model="formData.description"/>
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
    import {getNodes, createNode, deleteNode} from '../../../api/api';
    import Page from "../../../components/Page.vue"

    var globalFormData = {
        id: '',
        name: '',
        guard_name: '',
        title: '',
        path: '',
        sort: 0,
        type: 1,
        pid: 0,
        is_menu: "0",
        description: ''
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
            getNodes(params).then(res => {
                this.totalPage = res.total;
                this.tableData = res.data;
                this.loading = false;
            });
            getNodes({}).then(res => {

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
                createNode(this.formData).then(res => {
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
                getNodes(params).then(res => {
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
                deleteNode({id: this.tempRow.id}).then(res => {
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