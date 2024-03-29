 <!-- jquery latest version -->
 <!-- <script src="<?= base_url(); ?>assets/js/vendor/jquery-2.2.4.min.js"></script> -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 <!-- bootstrap 4 js -->
 <script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
 <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
 <script src="<?= base_url(); ?>assets/js/owl.carousel.min.js"></script>
 <script src="<?= base_url(); ?>assets/js/metisMenu.min.js"></script>
 <script src="<?= base_url(); ?>assets/js/slimScroll/jquery.slimscroll.js"></script>
 <script src="<?= base_url(); ?>assets/js/jquery.slicknav.min.js"></script>

 <!-- Start datatable js -->
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
 <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
 <!-- touchspin js -->
 <script src="<?= base_url(); ?>assets/js/touchSpin/jquery.bootstrap-touchspin.js"></script>
 <script src="<?= base_url(); ?>assets/css/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
 <script src="<?= base_url(); ?>assets/js/vanillatoasts.js"></script>

 <!-- sweetalert js -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

 <!-- select2 js -->
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <!-- start chart js -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
 <!-- start highcharts js -->
 <script src="https://code.highcharts.com/highcharts.js"></script>
 <script src="https://code.highcharts.com/modules/exporting.js"></script>
 <script src="https://code.highcharts.com/modules/export-data.js"></script>
 <!-- start amcharts -->
 <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
 <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
 <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
 <script src="https://www.amcharts.com/lib/3/serial.js"></script>
 <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
 <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
 <!-- all line chart activation -->
 <script src="<?= base_url(); ?>assets/js/line-chart.js"></script>
 <!-- all pie chart -->
 <script src="<?= base_url(); ?>assets/js/pie-chart.js"></script>
 <!-- all bar chart -->
 <script src="<?= base_url(); ?>assets/js/bar-chart.js"></script>
 <!-- all map chart -->
 <script src="<?= base_url(); ?>assets/js/maps.js"></script>
 <!-- others plugins -->
 <script src="<?= base_url(); ?>assets/js/plugins.js"></script>
 <script src="<?= base_url(); ?>assets/js/scripts.js"></script>
 <!-- jquery hotkeys -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.hotkeys/0.2.0/jquery.hotkeys.min.js" integrity="sha512-njd096AjZyGuWOttOsHolCOFjq9Xg9txZTl6Pd7FOpwf1nyBDsOXpS1cd184l/EWy5ekDJZldDMQPs9bLCSAtQ==" crossorigin="anonymous"></script>
 <script src="https://js.pusher.com/6.0/pusher.min.js"></script>


 <?php

    if ($this->uri->uri_string == 'cashier' || $this->uri->segment(1) == 'activity') {
        $this->load->view('layouts/cashier/myappcashier');
    }

    if ($this->uri->segment(2) == 'medical-records-history') {
        $this->load->view('layouts/doctor/myappdoctor');
    }


    if ($this->uri->uri_string == 'front-office') {
        $this->load->view('layouts/front-office/myappfrontoffice');
    }



    ?>