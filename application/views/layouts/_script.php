

<!-- jquery latest version -->
<script src="<?= base_url(); ?>assets/js/vendor/jquery-2.2.4.min.js"></script>
<!-- bootstrap 4 js -->
<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>assets/js/metisMenu.min.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.slicknav.min.js"></script>

<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<script src="<?= base_url(); ?>assets/css/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vanillatoasts.js"></script>
<!-- start chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<!-- start highcharts js -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- start zingchart js -->
<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
<!-- sweetalert js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- select2 js -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- cropie js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>
<script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
</script>
<!-- all line chart activation -->
<script src="<?= base_url(); ?>assets/js/line-chart.js"></script>
<!-- all pie chart -->
<script src="<?= base_url(); ?>assets/js/pie-chart.js"></script>
<!-- others plugins -->
<script src="<?= base_url(); ?>assets/js/plugins.js"></script>
<script src="<?= base_url(); ?>assets/js/scripts.js"></script>
<script src="<?= base_url(); ?>assets/js/app.js"></script>




<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<?php $this->load->view('layouts/myapp'); ?>

<script>
    getSalesChart();


    function getSalesChart() {
        if ($('#coin_sales1').length) {
            var ctx = document.getElementById("coin_sales1").getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: [
                        <?php
                        foreach (getMonth() as $key => $value) {
                            echo "'" . $value . "',";
                        }

                        ?>
                    ],
                    datasets: [{
                        label: "Sales",
                        backgroundColor: "rgba(117, 19, 246, 0.1)",
                        borderColor: '#0b76b6',
                        data: [
                            <?php
                            foreach (getMonth() as $key => $value) {
                                echo "'" . array_sum(array_column($sales_report[$key], 'subtotal')) . "',";
                            }

                            ?>
                        ],

                    }]
                },
                // Configuration options go here
                options: {
                    legend: {
                        display: false
                    },
                    animation: {
                        easing: "easeInOutBack"
                    },
                    scales: {
                        yAxes: [{
                            display: !1,
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold",
                                beginAtZero: !0,
                                maxTicksLimit: 5,
                                padding: 0,
                                callback: function(value) {
                                    return formatRupiah(value, 'Rp');
                                }
                            },
                            gridLines: {
                                drawTicks: !1,
                                display: !1
                            }
                        }],
                        xAxes: [{
                            display: !1,
                            gridLines: {
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                padding: 0,
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold"
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index];
                                var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                return label + ': IDR ' + formatRupiah(val);
                            }
                        }
                    }
                }
            });
        }
    }

    function getSalesRequestChart(tot_arr) {
        if ($('#coin_sales1').length) {
            var ctx = document.getElementById("coin_sales1").getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: [
                        <?php
                        foreach (getMonth() as $key => $value) {
                            echo "'" . $value . "',";
                        }

                        ?>
                    ],
                    datasets: [{
                        label: "Sales",
                        backgroundColor: "rgba(117, 19, 246, 0.1)",
                        borderColor: '#0b76b6',
                        data: tot_arr,
                    }]
                },
                // Configuration options go here
                options: {
                    legend: {
                        display: false
                    },
                    animation: {
                        easing: "easeInOutBack"
                    },
                    scales: {
                        yAxes: [{
                            display: !1,
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold",
                                beginAtZero: !0,
                                maxTicksLimit: 5,
                                padding: 0
                            },
                            gridLines: {
                                drawTicks: !1,
                                display: !1
                            }
                        }],
                        xAxes: [{
                            display: !1,
                            gridLines: {
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                padding: 0,
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold"
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index];
                                var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                return label + ': IDR ' + formatRupiah(val);
                            }
                        }
                    }
                }
            });
        }
    }

    getNetSalesChart();

    function getNetSalesChart() {
        if ($('#coin_sales2').length) {
            var ctx = document.getElementById("coin_sales2").getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: [
                        <?php
                        foreach (getMonth() as $key => $value) {
                            echo "'" . $value . "',";
                        }

                        ?>
                    ],
                    datasets: [{
                        label: "Sales",
                        backgroundColor: "rgba(114, 65, 250, 0.1)",
                        borderColor: '#890aa6',
                        data: [
                            <?php
                            foreach (getMonth() as $key => $value) {
                                echo "'" . array_sum(array_column($sales_report[$key], 'total')) . "',";
                            }

                            ?>
                        ],
                    }]
                },
                // Configuration options go here
                options: {
                    legend: {
                        display: false
                    },
                    animation: {
                        easing: "easeInOutBack"
                    },
                    scales: {
                        yAxes: [{
                            display: !1,
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold",
                                beginAtZero: !0,
                                maxTicksLimit: 5,
                                padding: 0
                            },
                            gridLines: {
                                drawTicks: !1,
                                display: !1
                            }
                        }],
                        xAxes: [{
                            display: !1,
                            gridLines: {
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                padding: 0,
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold"
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index];
                                var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                return label + ': IDR ' + formatRupiah(val);
                            }
                        }
                    }
                }
            });
        }
    }

    function getNetSalesRequestChart(tot_arr) {
        if ($('#coin_sales2').length) {
            var ctx = document.getElementById("coin_sales2").getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: [
                        <?php
                        foreach (getMonth() as $key => $value) {
                            echo "'" . $value . "',";
                        }

                        ?>
                    ],
                    datasets: [{
                        label: "Sales",
                        backgroundColor: "rgba(114, 65, 250, 0.1)",
                        borderColor: '#890aa6',
                        data: tot_arr
                    }]
                },
                // Configuration options go here
                options: {
                    legend: {
                        display: false
                    },
                    animation: {
                        easing: "easeInOutBack"
                    },
                    scales: {
                        yAxes: [{
                            display: !1,
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold",
                                beginAtZero: !0,
                                maxTicksLimit: 5,
                                padding: 0
                            },
                            gridLines: {
                                drawTicks: !1,
                                display: !1
                            }
                        }],
                        xAxes: [{
                            display: !1,
                            gridLines: {
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                padding: 0,
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold"
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index];
                                var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                return label + ': IDR ' + formatRupiah(val);
                            }
                        }
                    }
                }
            });
        }
    }


    getProductInChart();

    function getProductInChart() {
        if ($('#product_in_chart').length) {
            var ctx = document.getElementById("product_in_chart").getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: [
                        <?php
                        foreach (getMonth() as $key => $value) {
                            echo "'" . $value . "',";
                        }

                        ?>
                    ],
                    datasets: [{
                        label: "Product In",
                        backgroundColor: "rgba(240, 180, 26, 0.1)",
                        borderColor: '#F0B41A',
                        data: [
                            <?php
                            foreach (getMonth() as $key => $value) {
                                echo "'" . array_sum(array_column($product_in_report[$key], 'stock_in')) . "',";
                            }

                            ?>
                        ],
                    }]
                },
                // Configuration options go here
                options: {
                    legend: {
                        display: false
                    },
                    animation: {
                        easing: "easeInOutBack"
                    },
                    scales: {
                        yAxes: [{
                            display: !1,
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold",
                                beginAtZero: !0,
                                maxTicksLimit: 5,
                                padding: 0
                            },
                            gridLines: {
                                drawTicks: !1,
                                display: !1
                            }
                        }],
                        xAxes: [{
                            display: !1,
                            gridLines: {
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                padding: 0,
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold"
                            }
                        }]
                    }
                }
            });
        }
    }

    getItemSales();

    function getItemSales() {
        if ($('#items_sales_chart').length) {
            var ctx = document.getElementById("items_sales_chart").getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: [
                        <?php
                        foreach (getMonth() as $key => $value) {
                            echo "'" . $value . "',";
                        }

                        ?>
                    ],
                    datasets: [{
                        label: "Items Sales",
                        backgroundColor: "rgba(247, 163, 58, 0.1)",
                        borderColor: '#fd9d24',
                        fill: true,
                        data: [
                            <?php
                            foreach (getMonth() as $key => $value) {
                                echo "'" . array_sum(array_column($items_sales_report[$key], 'qty')) . "',";
                            }

                            ?>
                        ],
                    }]
                },
                // Configuration options go here
                options: {
                    legend: {
                        display: false
                    },
                    animation: {
                        easing: "easeInOutBack"
                    },
                    scales: {
                        yAxes: [{
                            display: !1,
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold",
                                beginAtZero: !0,
                                maxTicksLimit: 5,
                                padding: 0
                            },
                            gridLines: {
                                drawTicks: !1,
                                display: !1
                            }
                        }],
                        xAxes: [{
                            display: !1,
                            gridLines: {
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                padding: 0,
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold"
                            }
                        }]
                    }
                }
            });
        }
    }


    getDayGrossSalesChart();

    function getDayGrossSalesChart() {
        if ($('#day_gross_sales').length) {
            var ctx = document.getElementById("day_gross_sales").getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',
                // The data for our dataset
                data: {
                    labels: [
                        <?php
                        foreach (getNameDay() as $key => $value) {
                            echo "'" . $value . "',";
                        }

                        ?>
                    ],
                    datasets: [{
                        label: "Sales",
                        backgroundColor: "rgba(45, 74, 73, 0.8 )",
                        borderColor: '#2D4A49',
                        data: [
                            <?php
                            foreach (getNameDay() as $key => $value) {
                                if ($day[$key]) {
                                    echo "'" . $day[$key]->subtotal . "',";
                                } else {
                                    echo "'" . 0 . "',";
                                }
                            }

                            ?>
                        ],
                    }]
                },
                // Configuration options go here
                options: {
                    legend: {
                        display: false
                    },
                    animation: {
                        easing: "easeInOutBack"
                    },
                    scales: {
                        yAxes: [{
                            display: 1,
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold",
                                beginAtZero: !0,
                                maxTicksLimit: 6,
                                padding: 0,
                                callback: function(value) {
                                    return formatRupiah(value, 'Rp')
                                }
                            },
                            gridLines: {
                                drawTicks: 1,
                                display: !1
                            }
                        }],
                        xAxes: [{
                            display: 1,
                            gridLines: {
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                padding: 0,
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold"
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index];
                                var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                return label + ': IDR ' + formatRupiah(val);
                            }
                        }
                    }
                }
            });
        }
    }

    getSalesPerDayBasedMonthYear()
    var chart2;

    function getSalesPerDayBasedMonthYear(label = '', data = '') {
        if (label == '' && data == '') {
            if ($('#daily_gross_sales').length) {
                var ctx = document.getElementById("daily_gross_sales").getContext('2d');
                chart2 = new Chart(ctx, {
                    // The type of chart we want to create
                    type: 'line',
                    // The data for our dataset
                    data: {
                        labels: [
                            <?php
                            foreach ($salesPerDayBasedMonthYear as $row) {
                                //echo "'" . $value . "',";
                                echo "'" . date_format(new DateTime($row->created_at), 'd/m/Y') . "',";
                            }

                            ?>
                        ],
                        datasets: [{
                            label: "Sales",
                            backgroundColor: "rgba(45, 74, 73, 0.1)",
                            borderColor: '#2D4A49',
                            fill: true,
                            data: [
                                <?php
                                foreach ($salesPerDayBasedMonthYear as $value) {
                                    echo "'" . $value->total . "',";
                                }

                                ?>
                            ],

                        }]
                    },
                    // Configuration options go here
                    options: {
                        legend: {
                            display: false
                        },
                        animation: {
                            easing: "easeInOutBack"
                        },
                        scales: {
                            yAxes: [{
                                display: 1,
                                ticks: {
                                    fontColor: "rgba(0,0,0,0.5)",
                                    fontStyle: "bold",
                                    beginAtZero: !0,
                                    maxTicksLimit: 5,
                                    padding: 0,
                                    callback: function(value) {
                                        return formatRupiah(value, 'Rp');
                                    }
                                },
                                gridLines: {
                                    drawTicks: !1,
                                    display: !1
                                }
                            }],
                            xAxes: [{
                                display: 1,
                                gridLines: {
                                    zeroLineColor: "transparent"
                                },
                                ticks: {
                                    padding: 0,
                                    fontColor: "rgba(0,0,0,0.5)",
                                    fontStyle: "bold"
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var label = data.labels[tooltipItem.index];
                                    var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                    return label + ': IDR ' + formatRupiah(val);
                                }
                            }
                        },
                        elements: {
                            line: {
                                tension: 0, // disables bezier curves
                            }
                        },
                        responsive: true,
                    }
                });
            }
        } else {
            if ($('#daily_gross_sales').length) {
                var ctx = document.getElementById("daily_gross_sales").getContext('2d');
                chart2 = new Chart(ctx, {
                    // The type of chart we want to create
                    type: 'line',
                    // The data for our dataset
                    data: {
                        labels: label,
                        datasets: [{
                            label: "Sales",
                            backgroundColor: "rgba(45, 74, 73, 0.1)",
                            borderColor: '#2D4A49',
                            fill: true,
                            data: data,

                        }]
                    },
                    // Configuration options go here
                    options: {
                        legend: {
                            display: false
                        },
                        animation: {
                            easing: "easeInOutBack"
                        },
                        scales: {
                            yAxes: [{
                                display: 1,
                                ticks: {
                                    fontColor: "rgba(0,0,0,0.5)",
                                    fontStyle: "bold",
                                    beginAtZero: !0,
                                    maxTicksLimit: 5,
                                    padding: 0,
                                    callback: function(value) {
                                        return formatRupiah(value, 'Rp');
                                    }
                                },
                                gridLines: {
                                    drawTicks: !1,
                                    display: !1
                                }
                            }],
                            xAxes: [{
                                display: 1,
                                gridLines: {
                                    zeroLineColor: "transparent"
                                },
                                ticks: {
                                    padding: 0,
                                    fontColor: "rgba(0,0,0,0.5)",
                                    fontStyle: "bold"
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var label = data.labels[tooltipItem.index];
                                    var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                    return label + ': IDR ' + formatRupiah(val);
                                }
                            }
                        },
                        elements: {
                            line: {
                                tension: 0, // disables bezier curves
                            }
                        },
                        responsive: true,
                    }
                });
            }
        }

    }

    getHourGrossSalesChart()

    function getHourGrossSalesChart() {
        if ($('#hour_gross_sales').length) {
            var ctx = document.getElementById("hour_gross_sales").getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: [
                        <?php
                        foreach (getHour() as $row) {
                            //echo "'" . $value . "',";
                            echo "'" . $row . "',";
                        }

                        ?>
                    ],
                    datasets: [{
                        label: "Sales",
                        backgroundColor: "rgba(45, 74, 73, 0.1)",
                        borderColor: '#2D4A49',
                        fill: true,
                        data: [
                            <?php
                            foreach (getHour() as $key) {
                                //echo "'" . $value->total ."',";
                                if ($hour[$key]) {
                                    echo "'" . $hour[$key]->subtotal . "',";
                                } else {
                                    echo "'" . 0 . "',";
                                }
                            }

                            ?>
                        ],

                    }]
                },
                // Configuration options go here
                options: {
                    legend: {
                        display: false
                    },
                    animation: {
                        easing: "easeInOutBack"
                    },
                    scales: {
                        yAxes: [{
                            display: 1,
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold",
                                beginAtZero: !0,
                                maxTicksLimit: 5,
                                padding: 0,
                                callback: function(value) {
                                    return formatRupiah(value, 'Rp');
                                }
                            },
                            gridLines: {
                                drawTicks: !1,
                                display: !1
                            }
                        }],
                        xAxes: [{
                            display: 1,
                            gridLines: {
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                padding: 0,
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold"
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index];
                                var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                return label + ': IDR ' + formatRupiah(val);
                            }
                        }
                    },
                    elements: {
                        line: {
                            tension: 0, // disables bezier curves
                        }
                    },
                    responsice: true,
                }
            });
        }
    }







    const base_url2 = $('body').data('url');
    $(function() {

        $("#yearDashboard").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true,

        });

        $("#yearGrossSalesAmount").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true,

        });

        $("#yearNetSalesDashboard").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true,

        });


        $(document).on('change', '#yearDashboard', function() {
            let year = $(this).val();
            $.ajax({
                method: "POST",
                url: base_url2 + 'admin/dashboard/sales_report/' + year,
                beforeSend: function() {

                    $('#coin_sales1').hide();
                    $('.spaceSalesTotChart').hide();
                    $('.loadDash').show();
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    //console.log(data[1].length != 0 ? data[1].length : '');

                    var arr = [];
                    var tot_arr = [];
                    for (var i = 1; i <= 12; i++) {
                        if (data[i].length != 0) {
                            for (var j = 0; j < data[i].length; j++) {

                                arr.push(Number(data[i][j].subtotal));
                            }


                            var sum = arr.reduce(function(a, b) {
                                return a + b;
                            });

                            tot_arr.push(sum);


                        } else {
                            tot_arr.push(0);
                        }

                        arr = [];
                    }


                    $('#coin_sales1').fadeToggle(1000);
                    $('.spaceSalesTotChart').fadeToggle(1000);
                    $('.loadDash').hide();
                    getSalesRequestChart(tot_arr);

                    let tot_sales = tot_arr.reduce(function(a, b) {
                        return a + b;
                    });

                    console.log(tot_arr);

                    $('.salesTotalChart').text('IDR ' + formatRupiah(tot_sales));
                }

            });

        });

        $(document).on('change', '#yearNetSalesDashboard', function() {
            let year = $(this).val();
            $.ajax({
                method: "POST",
                url: base_url2 + 'admin/dashboard/sales_net_report/' + year,
                beforeSend: function() {
                    $('#coin_sales2').hide();
                    $('.spaceNetSalesTotChart').hide();
                    $('.loadNetDash').show();
                },
                success: function(response) {
                    var data = JSON.parse(response);


                    var arr = [];
                    var tot_arr = [];
                    for (var i = 1; i <= 12; i++) {
                        if (data[i].length != 0) {
                            for (var j = 0; j < data[i].length; j++) {
                                arr.push(Number(data[i][j].total));
                            }

                            var sum = arr.reduce(function(a, b) {
                                return a + b;
                            });

                            tot_arr.push(sum);
                        } else {
                            tot_arr.push(0);
                        }

                        arr = [];
                    }

                    $('#coin_sales2').fadeToggle(1000);
                    $('.spaceNetSalesTotChart').fadeToggle(1000);
                    $('.loadNetDash').hide();
                    getNetSalesRequestChart(tot_arr);

                    let tot_sales = tot_arr.reduce(function(a, b) {
                        return a + b;
                    });

                    console.log(tot_arr);

                    $('.netSalesTotalChart').text('IDR ' + formatRupiah(tot_sales));
                }
            })
        });

        $(document).on('change', '#selectMonthDailyGrossSalesAmount', function() {
            let month = $('#selectMonthDailyGrossSalesAmount option:selected').val();
            let year = $('#yearGrossSalesAmount').val();

            $.ajax({
                url: base_url2 + 'admin/dashboard/daily_gross_sales_amount',
                method: "GET",
                data: {
                    month: month,
                    year: year
                },
                beforeSend: function() {
                    $('#daily_gross_sales').hide();
                    $('.loadDailyGrossSalesAmount').show();
                },
                success: function(response) {
                    let get_data = JSON.parse(response);
                    $('#daily_gross_sales').remove();
                    $('.canvas-daily-gross-sales-amount').html(`<canvas id="daily_gross_sales" class="mt-4" height="60"></canvas>`);
                    $('#daily_gross_sales').fadeIn(1000);
                    $('.loadDailyGrossSalesAmount').hide();
                    getSalesPerDayBasedMonthYear(get_data.label, get_data.data);
                    $('#totalSalesPerDayBasedMonthYear').text(formatRupiah(get_data.total));
                }
            })
        });

        $(document).on('change', '#yearGrossSalesAmount', function() {
            let month = $('#selectMonthDailyGrossSalesAmount option:selected').val();
            let year = $('#yearGrossSalesAmount').val();

            $.ajax({
                url: base_url2 + 'admin/dashboard/daily_gross_sales_amount',
                method: "GET",
                data: {
                    month: month,
                    year: year
                },
                beforeSend: function() {
                    $('#daily_gross_sales').hide();
                    $('.loadDailyGrossSalesAmount').show();
                },
                success: function(response) {
                    let get_data = JSON.parse(response);
                    $('#daily_gross_sales').remove();
                    $('.canvas-daily-gross-sales-amount').html(`<canvas id="daily_gross_sales" class="mt-4" height="60"></canvas>`);
                    $('#daily_gross_sales').fadeIn(1000);
                    $('.loadDailyGrossSalesAmount').hide();
                    getSalesPerDayBasedMonthYear(get_data.label, get_data.data);
                    $('#totalSalesPerDayBasedMonthYear').text(formatRupiah(get_data.total));
                }
            })
        });
    });
</script>