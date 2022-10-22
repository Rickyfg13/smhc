<div class="main-content-inner">
    <div class="row">

        <!-- Dark table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title"><?= $page_title; ?></h4>
                    <div id="alertPlace">

                    </div>
                    <!-- <button class="btn btn-rounded btn-primary" id="btnTambahProductIn" data-toggle="modal" data-target="#modalAddProductIn"><i class="fa fa-plus mr-2"></i>Incoming Items</button> -->
                    <!-- <div class="form-group">
                        <label class="col-form-label">Filter By :</label>
                        <select class="form-control select2" id="selectFilterSalesPerdays">
                            <option></option>
                            <option value="month">MONTH</option>
                            <option value="year">YEAR</option>
                        </select>
                    </div> -->

                    <!-- date area -->
                    <form action="#" method="POST" class="mb-4" id="formReportSalesPerdays">
                        

                        <!-- month area -->
                        <div id="monthAreaSalesPerdays" class="mt-4">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Select Month :</label>
                                        <select class="form-control select2" name="month" id="month">
                                            <option></option>
                                            <?php foreach (getMonth() as $key => $val) : ?>
                                                <option value="<?= $key; ?>"><?= $val; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>


                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label class="col-form-label">Select Year :</label>
                                        <input type="text" class="form-control" id="datepicker" value="<?= date('Y'); ?>" name="year">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- <div id="yearAreaSalesPerdays" class="mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Select Year :</label>
                                        <input type="text" class="form-control" id="datepicker_year" value="<?= date('Y'); ?>" name="year2">
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <button type="submit" class="btn btn-rounded btn-hers btn-sm float-right mb-4 btn-submit-report-sales-perdays">Submit</button>
                    </form>
                    <div class="text-center loadIco" style="margin-top: 5rem!important;">
                        <img src="<?= base_url("assets/images/load/load.svg"); ?>" style="width: 100px;" alt="load-animate">
                        <h6 class="mt-2">Please Wait...</h6>
                    </div>
                    <div class="tableReportSalesPerdays" style="margin-top: 65px;">



                    </div>

                </div>
            </div>
        </div>
        <!-- Dark table end -->
    </div>
</div>