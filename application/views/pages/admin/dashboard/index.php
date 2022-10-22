<?php
$total = array_sum(array_column($sumTotal, 'total'));
$subtotal = array_sum(array_column($sumTotal, 'subtotal'));
//$netSales = $total - $subtotal;

?>

<div class="main-content-inner">
    <!-- sales report area start -->
    <div class="sales-report-area mt-5 mb-5">
        <div class="row">
            <div class="col-md-3">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><strong style="margin-left: 45px !important;">Rp</strong></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0 mt-1">Gross Sales</h4>
                            <input type="text" class="form-control" id="yearDashboard" style="width: 80px; height: 25px; border-top: 0px; border-left: 0px; border-right: 0px; border-radius: 0px; text-align: center;" value="<?= date('Y'); ?>">
                            <!-- <select class="custome-select border-0 pr-3" name="month" id="month_chart">
                                <?php for ($i = 2000; $i <= 2022; $i++) : ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor ?>
                            </select> -->
                        </div>
                        <div class="text-center mb-3 loadDash" style="margin-right: 60px;">
                            <img src="<?= base_url("assets/images/load/load.svg"); ?>" style="width: 100px;" alt="load-animate">
                            <h6 class="mt-2">Please Wait...</h6>
                        </div>

                        <div class="d-flex justify-content-between pb-2">

                            <div class="spaceSalesTotChart">
                                <h2 class="salesTotalChart">IDR&nbsp;<?= number_format($subtotal, 0, ',', '.'); ?></h2>


                                <!-- <?php
                                        $arr = array();
                                        foreach (getMonth() as $key => $value) {
                                            array_push($arr, array_sum(array_column($sumTotal, 'total')));
                                        }

                                        $totalSales = array_sum($arr);
                                        $avg = $totalSales / count($arr);

                                        ?> -->
                                <!-- <span style="font-size: 14px;">Avg : IDR&nbsp;<?= number_format($avg, 0, ',', '.'); ?></span> -->
                            </div>
                        </div>
                    </div>

                    <canvas id="coin_sales1" height="100"></canvas>
                </div>
            </div>
            <div class="col-md-3">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><strong style="margin-left: 45px !important;">Rp</strong></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0">Net Sales</h4>
                            <input type="text" class="form-control" id="yearNetSalesDashboard" style="width: 80px; height: 25px; border-top: 0px; border-left: 0px; border-right: 0px; border-radius: 0px; text-align: center;" value="<?= date('Y'); ?>">
                            <!-- <input type="text" class="form-control" id="yearDashboard" style="width: 80px; height: 25px; border-top: 0px; border-left: 0px; border-right: 0px; border-radius: 0px; text-align: center;" value="<?= date('Y'); ?>"> -->

                        </div>
                        <div class="text-center mb-3 loadNetDash" style="margin-right: 60px;">
                            <img src="<?= base_url("assets/images/load/load.svg"); ?>" style="width: 100px;" alt="load-animate">
                            <h6 class="mt-2">Please Wait...</h6>
                        </div>

                        <div class="d-flex justify-content-between pb-2">

                            <div class="spaceNetSalesTotChart">
                                <h2 class="netSalesTotalChart">IDR&nbsp;<?= number_format($total, 0, ',', '.'); ?></h2>
                            </div>
                        </div>
                    </div>

                    <canvas id="coin_sales2" height="100"></canvas>
                </div>
            </div>
            <div class="col-md-3">
                <div class="single-report">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-cubes" style="margin-left: 45px;"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0">Incoming Items</h4>

                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <div class="spaceProductIn">
                                <h2><?= array_sum(array_column($product_in_total, 'stock_in')); ?> <?= array_sum(array_column($product_in_total, 'stock_in')) > 1 ? 'Items' : 'Item' ?></h2>

                            </div>

                        </div>
                    </div>
                    <canvas id="product_in_chart" height="100"></canvas>
                </div>
            </div>
            <div class="col-md-3">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-tags" style="margin-left: 49px;"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0">Items Sales</h4>

                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <div class="spaceItemSales">
                                <h2><?= $items_sales_total->total; ?> <?= $items_sales_total->total > 1 ? 'Items' : 'Item' ?></h2>

                            </div>

                        </div>
                    </div>
                    <canvas id="items_sales_chart" height="100"></canvas>
                </div>
            </div>
        </div>


    </div>
    <div class="row mt-5">
        <div class="col-lg-12 mt-sm-30 mt-xs-30">
            <div class="card">
                <div class="card-body daily-gross-sales-amount-space">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="header-title">Daily Gross Sales Amount</h4>
                        <div class="filter-space d-flex">
                            <select class="custome-select border-0 pr-3 mr-2" id="selectMonthDailyGrossSalesAmount">
                                <?php $monthNow = (int) date('m'); ?>
                                <?php foreach (getMonth() as $key => $val) : ?>
                                    <option value="<?= $key; ?>" <?= $key == $monthNow ? 'selected' : "" ?>><?= $val; ?></option>
                                <?php endforeach ?>
                            </select>
                            <input type="text" class="form-control" id="yearGrossSalesAmount" style="width: 80px; height: 25px; border-top: 0px; border-left: 0px; border-right: 0px; border-radius: 0px; text-align: center;" value="2022">
                        </div>

                    </div>
                    <h6>Total : IDR <span id="totalSalesPerDayBasedMonthYear"><?= number_format($totalSalesPerDayBasedMonthYear, 0, ',', '.'); ?></span></h6>
                    <div class="text-center mb-3 loadDailyGrossSalesAmount" style="margin-right: 60px; display: none;">
                        <img src="<?= base_url("assets/images/load/load.svg"); ?>" style="width: 100px;" alt="load-animate">
                        <h6 class="mt-2">Please Wait...</h6>
                    </div>
                    <div class="canvas-daily-gross-sales-amount">
                        <canvas id="daily_gross_sales" class="mt-4" height="60"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8 mt-sm-30 mt-xs-30">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="header-title">Hourly Gross Sales Amount</h4>
                    </div>
                    <canvas id="hour_gross_sales" class="mt-4" height="92"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mt-sm-30 mt-xs-30">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="header-title">Day of The Week Gross Sales Amount</h4>

                    </div>
                    <canvas id="day_gross_sales" class="mt-4" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-12 mt-sm-30 mt-xs-30">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="header-title">Best Seller</h4>
                        <div class="trd-history-tabs">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#siteba_store" role="tab">Siteba Store</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#bandar_damar_store" role="tab">Bandar Damar Store</a>
                                </li>
                            </ul>
                        </div>
                        <select class="custome-select border-0 pr-3">
                            <option value="product" selected>Product</option>
                            <option value="treatment">Treatment</option>
                        </select>
                    </div>
                    <div class="trad-history mt-4">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="siteba_store" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="dbkit-table">
                                        <tr class="heading-td">
                                            <td><b>Item</b></td>
                                            <td><b>Price</b></td>
                                            <td><b>Quantity</b></td>

                                        </tr>
                                        <?php foreach ($best_seller_product_siteba as $row) : ?>
                                            <tr>
                                                <td><?= $row->title; ?></td>
                                                <td>IDR&nbsp;<?= number_format($row->price, '0', ',', '.'); ?></td>
                                                <td><?= $row->qty; ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bandar_damar_store" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="dbkit-table">
                                        <tr class="heading-td">
                                            <td><b>Item</b></td>
                                            <td><b>Price</b></td>
                                            <td><b>Quantity</b></td>

                                        </tr>
                                        <?php foreach ($best_seller_product_bandar_damar as $row) : ?>
                                            <tr>
                                                <td><?= $row->title; ?></td>
                                                <td>IDR&nbsp;<?= number_format($row->price, '0', ',', '.'); ?></td>
                                                <td><?= $row->qty; ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>