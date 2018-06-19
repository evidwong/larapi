<template>
  <el-pagination
      @size-change="handleSizeChange"
      @current-change="handleCurrentChange"
      :current-page="currentPage"
      :page-sizes="[100, 200, 300, 400]"
      :page-size="100"
      layout="total, sizes, prev, pager, next, jumper"
      :total="400">
    </el-pagination>
</template>
<script>
  export default {
    name:"Page",
    data() { 
      return {
        currentPage:1,
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