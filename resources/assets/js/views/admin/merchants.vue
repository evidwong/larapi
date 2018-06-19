<template>
<div>
  <el-table :data="tableData3" height="500" border style="width: 100%">
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
  <Page></Page>
  </div>
</template>
<script>
import Page from "./../../components/Page.vue"
  export default {
    components:{
      Page,
    },
    name:"merchants",
    data() { 
      return {
        currentPage:1,
        tableData3: [
        {date: '2016-05-03',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'},
        {date: '2016-05-02',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'},
        {date: '2016-05-04',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'},
        {date: '2016-05-01',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'},
        {date: '2016-05-08',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'},
        {date: '2016-05-06',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'},
        {date: '2016-05-07',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'}
        ]
      }
    },
    methods: {
      handleSizeChange(val) {
      },
      handleCurrentChange(val) {
      }
    }
    
  }
</script>