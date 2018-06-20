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
  <el-table :data="tableData" height="500" border style="width: 100%">
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

  <el-dialog title="增加商户" :visible.sync="dialogFormVisible">
    <el-form ref="form" :model="form">
      <el-form-item>
        <el-col :span="2" style="text-indent: 15px;">商户名称</el-col>
        <el-col :span="5">
        <el-input v-model="form.name"></el-input>
        </el-col>
        <el-col :span="2" style="text-align: center;">技术顾问</el-col>
        <el-col :span="5">
          <el-input v-model="form.name"></el-input>
        </el-col>
        <el-col :span="2" style="text-align: center;">登入次数</el-col>
        <el-col :span="5">
          <el-input v-model="form.name"></el-input>
        </el-col>
      </el-form-item>
      <el-form-item>
        <el-col :span="2"style="text-align: center;">公司类型</el-col>
        <el-col :span="5">
          <el-select v-model="form.region" placeholder="请选择公司类型">
            <el-option label="区域一" value="电子商务">电子商务</el-option>
            <el-option label="区域二" value="其它">其它</el-option>
          </el-select>
        </el-col>
        <el-col :span="2">服务开始</el-col>
        <el-col :span="5">
          <el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>
        </el-col>
        <el-col :span="2">查询次数</el-col>
        <el-col :span="5">
          <el-input v-model="form.name" disabled="true"></el-input>
        </el-col>
      </el-form-item>
      <el-form-item>
        <el-col :span="2">联系人</el-col>
        <el-col :span="5">
          <el-input v-model="form.name" disabled="true"></el-input>
        </el-col>
        <el-col :span="2">服务到期</el-col>
        <el-col :span="5">
          <el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>
        </el-col>
        <el-col :span="2">查询次数</el-col>
        <el-col :span="5">
          <el-input v-model="form.name" disabled="true"></el-input>
        </el-col>
      </el-form-item>
      <el-form-item label="活动时间">
        <el-col :span="11">
          <el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>
        </el-col>
        <el-col class="line" :span="2">-</el-col>
        <el-col :span="11">
          <el-time-picker type="fixed-time" placeholder="选择时间" v-model="form.date2" style="width: 100%;"></el-time-picker>
        </el-col>
      </el-form-item>
      <el-form-item label="即时配送">
        <el-switch v-model="form.delivery"></el-switch>
      </el-form-item>
      <el-form-item label="活动性质">
        <el-checkbox-group v-model="form.type">
          <el-checkbox label="美食/餐厅线上活动" name="type"></el-checkbox>
          <el-checkbox label="地推活动" name="type"></el-checkbox>
          <el-checkbox label="线下主题活动" name="type"></el-checkbox>
          <el-checkbox label="单纯品牌曝光" name="type"></el-checkbox>
        </el-checkbox-group>
      </el-form-item>
      <el-form-item label="特殊资源">
        <el-radio-group v-model="form.resource">
          <el-radio label="线上品牌商赞助"></el-radio>
          <el-radio label="线下场地免费"></el-radio>
        </el-radio-group>
      </el-form-item>
      <el-form-item label="活动形式">
        <el-input type="textarea" v-model="form.desc"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary">立即创建</el-button>
        <el-button>取消</el-button>
      </el-form-item>
    </el-form>
  </el-dialog>
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
        tableData: [
        {date: '2016-05-03',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'},
        {date: '2016-05-02',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'},
        {date: '2016-05-04',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'},
        {date: '2016-05-01',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'},
        {date: '2016-05-08',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'},
        {date: '2016-05-06',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'},
        {date: '2016-05-07',name: '王小虎',address: '上海市普陀区金沙江路 1518 弄'}
        ],
          dialogFormVisible: false,
          form: {
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
      computed:{

      },
    methods: {
      handleSizeChange(val) {
      },
      handleCurrentChange(val) {
      },
      addMerchants(){
        console.log(Page.data().currentPage)
      },
      editMerchants(){
      },
      delMerchants(){
      },
      delayMerchants(){
        // 
      }
    }
    
  }
</script>
<style>
  .btn-groups{
    padding: 15px;
  }
</style>