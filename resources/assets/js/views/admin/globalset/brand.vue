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
            <el-table-column prop="brand_name" label="品牌名称"/>
            <el-table-column prop="db_name" label="数据库名称"/>
            <el-table-column prop="db_host" label="数据库地址"/>
            <el-table-column prop="db_port" label="数据库端口"/>
            <el-table-column prop="index_name" label="索引名称"/>
            <el-table-column prop="index_type" label="索引类型"/>
            <el-table-column prop="index_host" label="索引地址"/>
            <el-table-column prop="index_port" label="索引端口"/>
            <el-table-column prop="created_at" label="创建日期"/>
            <el-table-column prop="updated_at" label="创建日期"/>
        </el-table>


        <el-row style="text-align: center;padding:15px 0;" v-if="tableData.length>0">
            <Page :totalPage="totalPage" :currentPage="currentPage" :currentPageSize="currentPageSize"
                  @onRefresh="loadData"/>
        </el-row>

        <el-dialog title="品牌数据配置" :visible.sync="dialogFormVisible" :close-on-click-modal="false">
            <el-form :model="formData" v-loading="submitLoading" label-width="100px">
                <el-form-item label="车辆品牌">
                    <el-select @change="brandChange" filterable v-model="formData.brand_id" placeholder="请选择车辆品牌">
                        <el-option-group
                                v-for="group in brands"
                                :key="group.index"
                                :label="group.group_name"
                                :value="group.id">
                            <el-option
                                    v-for="item in group.children"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id">
                            </el-option>
                        </el-option-group>
                    </el-select>
                    <img :src="brandImg" alt="" width="35px">
                </el-form-item>
                <el-form-item label="数据库名称">
                    <el-input v-model="formData.db_name"/>
                </el-form-item>
                <el-form-item label="数据库地址">
                    <el-input v-model="formData.db_host"/>
                </el-form-item>
                <el-form-item label="数据库端口">
                    <el-input v-model="formData.db_port"/>
                </el-form-item>
                <el-form-item label="索引名称">
                    <el-input v-model="formData.index_name"/>
                </el-form-item>
                <el-form-item label="索引类型">
                    <el-input v-model="formData.index_type"/>
                </el-form-item>
                <el-form-item label="索引地址">
                    <el-input v-model="formData.index_host"/>
                </el-form-item>
                <el-form-item label="索引端口">
                    <el-input v-model="formData.index_port"/>
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
    import {getBrands, getBrandConfigs, createBrandConfig, deleteBrandConfig} from '../../../api/api';
    import Page from "../../../components/Page.vue"
    import area from '../../../pca-code.json';

    var globalFormData = {
        id: '',
        brand_name: '',
        brand_id: '',
        db_name: '',
        db_host: '',
        db_port: '',
        index_name: '',
        index_type: '',
        index_host: '',
        index_port: ''
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
                options: area,
                submitLoading: false,
                delayDialogVisible: false,
                carBrands: [],
                brandImg: ''
            }
        },
        computed: {
            brands() {
                if (localStorage.brands) {
                    this.carBrands = JSON.parse(localStorage.brands);
                    return JSON.parse(localStorage.brands)
                } else {
                    return []
                }
            }
        },
        mounted() {
            let params = {currentPage: this.currentPage, currentPageSize: this.currentPageSize};
            getBrandConfigs(params).then(res => {
                this.totalPage = res.total;
                this.tableData = res.data;
                this.loading = false;
            });
            getBrands({type: 1}).then(res => {
                this.carBrands = res.data;
                localStorage.brands = JSON.stringify(res.data)
            })
        },
        methods: {
            brandChange(val) {
                var that = this;
                first:
                    for (let group of that.carBrands) {
                        for (let item of group.children) {
                            if (val == item.id) {
                                that.formData.brand_name = item.name;
                                that.brandImg = item.image;
                                break first;
                            }
                        }
                    }
            },
            add() {
                this.dialogFormVisible = true;
                this.formData = Object.assign({},globalFormData);
                this.brandImg = '';
            },
            Edit() {
                if (this.tempRow.hasOwnProperty('id')) {
                    this.formData = Object.assign({},this.tempRow);
                    this.dialogFormVisible = true;
                    var that = this;
                    first:
                        for (let group of that.carBrands) {
                            for (let item of group.children) {
                                if (that.formData.brand_id == item.id) {
                                    that.brandImg = item.image;
                                    break first;
                                }
                            }
                        }
                } else {
                    this.$message.error('请选择要修改的记录');
                }
            },
            submitForm() {
                this.submitLoading = true;
                createBrandConfig(this.formData).then(res => {
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
                                currentPageSize: this.currentPageSize
                            })
                        }
                    });
                });
            },
            loadData(params) {
                this.loading = true;
                getBrandConfigs(params).then(res => {
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
                deleteBrandConfig({id: this.tempRow.id}).then(res => {
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
                                    currentPageSize: this.currentPageSize
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