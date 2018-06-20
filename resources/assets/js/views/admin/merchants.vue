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
        <el-table :data="tableData" height="auto" border style="width: 100%">
            <el-table-column label="ID"></el-table-column>
            <el-table-column label="商户名称"></el-table-column>
            <el-table-column label="公司类型"></el-table-column>
            <el-table-column label="联系人"></el-table-column>
            <el-table-column label="手机"></el-table-column>
            <el-table-column label="技术顾问"></el-table-column>
            <el-table-column label="服务开始"></el-table-column>
            <el-table-column label="服务到期"></el-table-column>
            <el-table-column label="创建日期"></el-table-column>
            <el-table-column label="品牌"></el-table-column>
            <el-table-column label="授权IP"></el-table-column>
            <el-table-column label="授权时间"></el-table-column>
            <el-table-column label="授权速度"></el-table-column>
            <el-table-column label="登入次数"></el-table-column>
            <el-table-column label="查询记录"></el-table-column>
        </el-table>
        <el-row>
            <Page></Page>
        </el-row>

        <el-dialog title="增加商户" :visible.sync="dialogFormVisible" width="70%" :close-on-click-modal="false">
            <el-form :inline="true" :model="formInline" class="demo-form-inline" label-width="70px">
                <el-row>
                    <el-form-item label="商户名称">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="技术顾问">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="登入次数">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="公司类型">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="服务开始">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="查询记录">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="联系人">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="服务到期">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="服务到期">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="手机">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="授权时间">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="授权次数">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                </el-row>
                <el-row>
                    <el-form-item label="电话">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="授权key">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                    <el-form-item label="查询记录">
                        <el-input v-model="formInline.name" placeholder="审批人"></el-input>
                    </el-form-item>
                </el-row>
                <el-row style="text-align:center;">
                    <el-form-item>
                        <el-button type="primary" size="medium" @click="onSubmit">提交</el-button>
                        <el-button size="medium" @click="dialogFormVisible = false">取消</el-button>
                    </el-form-item>
                </el-row>
            </el-form>
        </el-dialog>
    </div>


</template>
<script>
    import Page from "./../../components/Page.vue"

    export default {
        components: {
            Page,
        },
        name: "merchants",
        data() {
            return {
                currentPage: 1,
                tableData: [
                    {date: '2016-05-03', name: '王小虎', address: '上海市普陀区金沙江路 1518 弄'},
                    {date: '2016-05-02', name: '王小虎', address: '上海市普陀区金沙江路 1518 弄'},
                    {date: '2016-05-04', name: '王小虎', address: '上海市普陀区金沙江路 1518 弄'},
                    {date: '2016-05-01', name: '王小虎', address: '上海市普陀区金沙江路 1518 弄'},
                    {date: '2016-05-08', name: '王小虎', address: '上海市普陀区金沙江路 1518 弄'},
                    {date: '2016-05-06', name: '王小虎', address: '上海市普陀区金沙江路 1518 弄'},
                    {date: '2016-05-07', name: '王小虎', address: '上海市普陀区金沙江路 1518 弄'}
                ],
                dialogFormVisible: false,
                formInline: {
                    name: '',
                    region: '',
                    date1: '',
                    date2: '',
                    delivery: false,
                    type: [],
                    resource: '',
                    desc: ''
                },
                formLabelWidth: '120px'
            }
        },
        computed: {},
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
            onSubmit() {
            }
        }

    }
</script>
<style>
    .btn-groups {
        padding: 15px;
    }
</style>