<template>
    <el-pagination
            @size-change="handleSizeChange"
            @current-change="handleCurrentChange"
            :current-page="currentPage"
            :page-sizes="[10, 20, 30, 50,100,200]"
            :page-size="currentPageSize"
            layout="total, sizes, prev, pager, next, jumper"
            :total="totalPage">
    </el-pagination>
</template>
<script>
    export default {
        name: "Page",
        data() {
            return {}
        },
        props: ['totalPage', 'currentPage', 'currentPageSize'],
        methods: {
            handleSizeChange(val) {
                let params = {currentPageSize: val, currentPage: this.currentPage};
                this.$emit('onRefresh', params);
            },
            handleCurrentChange(val) {
                let params = {currentPage: val, currentPageSize: this.currentPageSize};
                this.$emit('onRefresh', params);
            }
        }

    }
</script>