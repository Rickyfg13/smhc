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

<!-- TouchSpin -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/touchSpin/jquery.bootstrap-touchspin.css">
<!-- End of TouchSpin -->
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

    #dateAreaa {
        display: none;
    }

    #monthArea {
        display: none;
    }

    #yearArea {
        display: none;
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

    .btn-hers:hover {
        background-color: var(--hover-secondary-color);
        border-color: var(--hover-secondary-color);
    }

    .btn-hers-outline {
        background-color: transparent;
        border-color: var(--secondary-color);
        color: var(--secondary-color) !important;
    }

    .btn-hers-outline:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
        color: #fff !important;
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

    .btn-hers-primary-outline {
        background-color: transparent;
        border-color: var(--primary-color);
        color: var(--primary-color) !important;
    }

    .btn-hers-primary-outline:hover {
        background-color: var(--hover-primary-color);
        border-color: var(--hover-primary-color);
        color: #fff !important;
    }

    .btn-hers-primary-outline:not(:disabled):not(.disabled).active,
    .btn-hers-primary-outline:not(:disabled):not(.disabled):active,
    .show>.btn-hers-primary-outline.dropdown-toggle {
        color: #fff !important;
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .text-purple {
        color: #6a56a5;
    }

    .text-purple:hover {
        color: #4b3a7b;
    }

    .text-hers {
        color: var(--primary-color);
    }

    .text-hers-secondary {
        color: var(--hover-secondary-color);
    }

    .input-group-prepend button {
        color: #fff;
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .input-group-prepend button:hover {
        background-color: var(--hover-primary-color);
        border-color: var(--hover-primary-color);
    }

    .input-group-append button {
        color: #fff;
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .input-group-append button:hover {
        background-color: var(--hover-primary-color);
        border-color: var(--hover-primary-color);
    }


    #formAddInventory {
        display: none;
    }

    #keyboard {
        margin-left: 280px;
        padding: 0;
        list-style: none;
    }

    #keyboard li {
        float: left;
        margin: 0 5px 5px 0;
        width: 60px;
        height: 60px;
        font-size: 24px;
        line-height: 60px;
        text-align: center;
        background: #fff;
        border: 1px solid #f9f9f9;
        border-radius: 5px;
    }

    .capslock,
    .tab,
    .left-shift,
    .clearl,
    .switch {
        clear: left;
    }

    #keyboard .tab,
    #keyboard .delete {
        width: 70px;
    }

    #keyboard .capslock {
        width: 80px;
    }

    #keyboard .return {
        width: 90px;
    }

    #keyboard .left-shift {
        width: 70px;
    }

    #keyboard .switch {
        width: 90px;
    }

    #keyboard .rightright-shift {
        width: 109px;
    }

    .lastitem {
        margin-right: 0;
    }

    .uppercase {
        text-transform: uppercase;
    }

    #keyboard .space {
        float: left;
        width: 556px;
    }


    #keyboard .space,
    #keyboard .return {
        font-size: 16px;
    }


    #keyboard .switch {
        font-size: 24px;
    }

    .on {
        display: none;
    }

    #keyboard li:hover {
        position: relative;
        top: 1px;
        left: 1px;
        border-color: #e5e5e5;
        cursor: pointer;
    }

    .custom .card-body {
        -webkit-box-shadow: 0px 0px 13px 1px rgba(0, 0, 0, 0.15);
        box-shadow: 0px 0px 13px 1px rgba(0, 0, 0, 0.05);
        border-radius: 3%;
    }

    #btnReset {
        display: none;
    }

    #btnSendInvoiceWa {
        display: none;
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

    .btn-purple-outline {
        border: 1px solid #6a56a5 !important;
        color: #6a56a5;
        background-color: #fff;
    }

    .btn-purple-outline:hover {
        background-color: #6a56a5;
        color: #fff;
        border-color: #6a56a5;
    }

    .search-items {
        border-radius: 33px;
        border: 0px;
        background-color: #f5f5f5;
        height: 40px;
    }

    .search-items:focus {
        background-color: #f5f5f5;
    }

    .search-items::placeholder {
        color: #b1a7a7;

    }

    .card-header {
        background-color: #fff;
    }



    .ico-user-place {
        margin: auto;
    }

    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .user-profile {
        background: var(--secondary-color);
    }

    .horizontal-menu ul li:hover>a,
    .horizontal-menu ul li.active>a {
        color: var(--secondary-color);
    }

    .horizontal-menu ul li a {
        color: var(--primary-color);
    }

    .slicknav_menu {
        background: var(--primary-color);
        padding: 0;
        margin-top: 20px;
    }

    .avatar-doctor {
        position: relative;
        bottom: 80px;
    }

    .avatar-doctor h4 {
        font-size: 18px;
        letter-spacing: 1.2px;
    }

    .avatar-doctor h6 {
        font-weight: 300;
        letter-spacing: 1.1px;
    }

    #vanillatoasts-container {
        z-index: 9999;
    }

    .clear-items {
        font-size: 20px !important;
    }

    .clear-items:hover {
        cursor: pointer;
    }

    .clear-items-db {
        font-size: 20px !important;
    }

    .clear-items-db:hover {
        cursor: pointer;
    }

    .custom-radio .custom-control-input:checked~.custom-control-label::before {
        background-color: var(--secondary-color);
    }

    .btn-default::after {
        display: none;
        width: 0;
        height: 0;
        margin-left: .255em;
        vertical-align: .255em;
        content: "";
        border-top: .3em solid;
        border-right: .3em solid transparent;
        border-bottom: 0;
        border-left: .3em solid transparent;
    }

    .ti-more-alt {
        filter: progid: DXImageTransform.Microsoft.BasicImage(rotation=0.5);
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
        display: inline-block;
    }

    .dropdown-menu {
        border-color: white !important;
        -webkit-box-shadow: 0px 0px 13px 1px rgba(0, 0, 0, 0.15);
        box-shadow: 0px 0px 13px 1px rgba(0, 0, 0, 0.05);
    }

    .horizontal-menu .submenu {
        border-top-color: var(--primary-color) !important;
    }

    #modal-customer-transaction {
        padding-left: 17px;
    }
</style>