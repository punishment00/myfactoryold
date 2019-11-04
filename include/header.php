<!DOCTYPE html>
<html>
<head>
    <title><?= empty($page_title) ? "Factory" : $page_title; ?></title>
    <meta charset="UTF-8">
    <!-- jquery -->
    <script type="text/javascript" src="/myfactory/scripts/jquery-3.4.1.min.js"></script>
    <!-- fontawesome -->
    <link rel="stylesheet" type="text/css" href="/myfactory/fontawesome-5.11.2/css/all.min.css">
    <script type="text/javascript" src="/myfactory/fontawesome-5.11.2/js/all.min.js"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="/myfactory/bootstrap-4.3.1/css/bootstrap.min.css">
    <script type="text/javascript" src="/myfactory/bootstrap-4.3.1/js/bootstrap.min.js"></script>
    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="/myfactory/datatable/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="/myfactory/datatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/myfactory/datatable/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/myfactory/datatable/fixedHeader.bootstrap4.min.css">
    <script type="text/javascript" src="/myfactory/datatable/dataTables.fixedHeader.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/myfactory/styles/common.css?date=<?= date("YmdHis"); ?>">
    <script type="text/javascript" src="/myfactory/scripts/script.js?date=<?= date("YmdHis"); ?>"></script>
    
</head>
<body>