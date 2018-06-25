<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>汽车配件查询系统</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <style>
        html {
            position: relative;
            background: #f0f2f5;
            min-height: 100% ;
        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 60px;
            background: #f0f2f5;
        }
        .el-dialog__header {
            padding: 10px;
            border-bottom: 1px solid #f5f5f5;
        }
        .el-dialog__headerbtn{
            top:12px;
        }
        .el-form-item{
            margin-bottom: 5px;
        }
        .el-dialog__body{
            padding: 15px;
        }
        .el-form-item__content{
            line-height: 35px;
        }
        .el-input__inner{
            height: 35px;
            line-height: 35px;
        }
        .el-form-item__label{
            line-height: 35px;
            font-weight: normal;
        }
    </style>
</head>
<body>
<div id="app">
    <app></app>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>