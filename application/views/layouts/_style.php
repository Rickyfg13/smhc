<link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/themify-icons.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/metisMenu.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/slicknav.min.css">
<!-- amchart css -->
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<!-- others css -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/typography.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/default-css.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/styles.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/responsive.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" integrity="sha512-2eMmukTZtvwlfQoG8ztapwAH5fXaQBzaMqdljLopRSA0i6YKM8kBAOrSSykxu9NN9HrtD45lIqfONLII2AFL/Q==" crossorigin="anonymous" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/vanillatoasts.css">

<!-- modernizr css -->
<script src="<?= base_url(); ?>assets/js/vendor/modernizr-2.8.3.min.js"></script>

<style>
    :root {
        --primary-color: #2D4A49;
        --hover-primary-color: #223d3d;
        --secondary-color: #BB9A5D;
        --hover-secondary-color: #b38d47;
        --title-color: #141313;
        --text-color: #777777;
    }

    .btn-purple {
        color: #fff;
        background-color: #6a56a5;
        border-color: #6a56a5;
    }

    .btn-purple:hover {
        background-color: #402d77;
        border-color: #402d77;
    }

    .btn-hers {
        color: #fff;
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);

    }

    .btn-hers-primary {
        color: #fff;
        background-color: var(--primary-color);
        border-color: var(--primary-color);

    }

    .btn-hers-primary:hover {
        background-color: var(--hover-primary-color);
        border-color: var(--hover-primary-color);
    }

    .btn-hers:hover {
        background-color: var(--hover-secondary-color);
        border-color: var(--hover-secondary-color);
    }

    .metismenu>li:hover>a,
    .metismenu>li.active>a,
    .metismenu>li.active>a i {
        color: var(--primary-color) !important;
        background: #fff !important;
        font-weight: bold;
    }

    .metismenu li.active>a,
    .metismenu li.active>a i {
        color: var(--primary-color) !important;
        font-weight: bold;
    }


    .metismenu li a,
    .metismenu li a i {
        color: var(--secondary-color);
    }

    .metismenu li a:hover {
        background: #fff !important;
        color: var(--primary-color);
    }

    .metismenu li a:hover i {
        color: var(--primary-color) !important;
    }

    .bg-white-custom {
        background: #fff !important;
    }

    .sidebar-header {
        border-bottom: 1px solid #fff;
    }

    .collapse.in .active {
        color: var(--primary-color) !important;
    }

    .user-profile {
        color: var(--primary-color);
        background: -webkit-linear-gradient(left, var(--secondary-color) 50%, var(--secondary-color) 100%);
        background: linear-gradient(to right, var(--secondary-color) 50%, var(--secondary-color) 100%);
    }

    .user-name {
        color: #fff;
        font-weight: 500;
    }

    .breadcrumbs li a {
        color: var(--secondary-color);
    }


    #formAddInventory {
        display: none;
    }

    #dateAreaa {
        display: none;
    }

    #monthArea {
        display: none;
    }

    #yearArea {
        display: none;
    }

    #dateAreaaSalesProduct {
        display: none;
    }

    #monthAreaSalesProduct {
        display: none;
    }

    #yearAreaSalesProduct {
        display: none;
    }

    /* #monthAreaSalesPerdays{
        display: none;
    } */

    #yearAreaSalesPerdays {
        display: none;
    }

    .btn-submit-report-sales {
        display: none;
    }

    .btn-submit-report-sales-product {
        display: none;
    }

    /* .btn-submit-report-sales-perdays{
        display: none;
    } */


    .loadIco {
        display: none;
    }

    .loadDash {
        display: none;
    }

    .loadNetDash {
        display: none;
    }

    #vanillatoasts-container {
        z-index: 9999;
    }

    .trd-history-tabs ul li a:hover,
    .trd-history-tabs ul li a.active {
        border-bottom: 2px solid var(--secondary-color);
        padding-bottom: 7px;
        color: #565656;
    }

    select[readonly] {
        background: #eee;
        /*Simular campo inativo - Sugestão @GabrielRodrigues*/
        pointer-events: none;
        touch-action: none;
    }

    .s-swtich label {
        cursor: pointer;
        text-indent: -9999px;
        width: 40px;
        height: 23px;
        background: #c3c3c3;
        display: block;
        border-radius: 100px;
        position: relative;
        margin: 0;
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        margin-left: 0px;
    }

    .s-swtich input:checked+label {
        background: var(--primary-color);
    }
</style>