<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $page_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- style -->
    <?php $this->load->view('layouts/doctor/_style'); ?>
    <!-- end style -->

    <style>
        #loading {
            position: fixed;
            background: #2D4A49;
            right: 45%;
            padding: 10px 20px 0px 20px;
            border-bottom-left-radius: 7px;
            border-bottom-right-radius: 7px;
            font-size: 16px;
            z-index: 9999;
            letter-spacing: 1.2px;
            display: none;
        }
    </style>
</head>

<body class="body-bg" data-url="<?= base_url(); ?>">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <audio controls id="notifSound" class="sound" style="display: none;">
        <source src="<?= base_url("assets/sounds/pristine.mp3") ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <audio controls id="notifSoundRemove" class="sound-2" style="display: none;">
        <source src="<?= base_url("assets/sounds/knob.mp3") ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    
    <div id="loading">
        <div class="d-flex">
            <div class="loaderr loaderr--style7" title="6">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                    <rect x="0" y="0" width="4" height="20" fill="#BB9A5D">
                        <animate attributeName="opacity" attributeType="XML" values="1; .2; 1" begin="0s" dur="0.6s" repeatCount="indefinite" />
                    </rect>
                    <rect x="7" y="0" width="4" height="20" fill="#BB9A5D">
                        <animate attributeName="opacity" attributeType="XML" values="1; .2; 1" begin="0.2s" dur="0.6s" repeatCount="indefinite" />
                    </rect>
                    <rect x="14" y="0" width="4" height="20" fill="#BB9A5D">
                        <animate attributeName="opacity" attributeType="XML" values="1; .2; 1" begin="0.4s" dur="0.6s" repeatCount="indefinite" />
                    </rect>
                </svg>
            </div>
            <span class="text-white">Loading...</span>
        </div>

    </div>
    <!-- preloader area end -->
    <!-- main wrapper start -->
    <div class="horizontal-main-wrapper">

        <!-- main header area start -->
        <?php $this->load->view('layouts/doctor/_header'); ?>
        <!-- main header area end -->

        <!-- header area start (navbar) -->
        <?php $this->load->view('layouts/doctor/_navbar'); ?>
        <!-- header area end -->

        <!-- page title area end -->
        <?php $this->load->view($page); ?>
        <!-- main content area end -->


        <!-- start modal -->
        <?php $this->load->view('layouts/doctor/_modal'); ?>
        <!-- modal end -->

        <!-- footer area start-->
        <?php $this->load->view('layouts/doctor/_footer'); ?>
        <!-- footer area end-->

    </div>
    <!-- main wrapper start -->

    <!-- offset area start -->
    <?php $this->load->view('layouts/doctor/_offset'); ?>
    <!-- offset area end -->

    <!-- script -->
    <?php $this->load->view('layouts/doctor/_script'); ?>
    <!-- end script -->
</body>

</html>