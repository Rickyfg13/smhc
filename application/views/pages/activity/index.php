<div class="main-content-inner">
    <div class="container-fluid">
        <div class="row">


            <!-- Statistics area start -->
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="header-title">List Transaction Activity</h4>
                            <button class="btn btn-xs btn-hers-outline btn-rounded pl-3 pr-3 btnFilterActivity" data-toggle="collapse" data-target="#filter-space" aria-expanded="false" aria-controls="filter-space"><i class="ti-filter mr-2"></i>Filter</button>
                        </div>
                        <div class="filter-space collapse" id="filter-space">
                            <div class="form-group">
                                <label class="col-form-label">Filter By :</label>
                                <select class="form-control select2" id="selectFilterActivity">
                                    <option></option>
                                    <option value="date">DATE</option>
                                    <option value="month">MONTH</option>
                                    <option value="year">YEAR</option>
                                </select>
                            </div>

                            <form action="#" method="POST" class="mb-4" id="formFilterActivity">
                                <div id="dateAreaa" class="mt-4">
                                    <div class="input-daterange">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="tgl_start">Start From</label>
                                                    <input type="text" class="form-control datetime" name="tgl_start" id="tgl_start" aria-describedby="emailHelp" placeholder="dd/mm/YYYY" autocomplete="off">
                                                    <span id="tgl_start_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="tgl_end">End Period</label>
                                                    <input type="text" class="form-control datetime" name="tgl_end" id="tgl_end" aria-describedby="emailHelp" placeholder="dd/mm/YYYY" autocomplete="off">
                                                    <span id="tgl_end_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- month area -->
                                <div id="monthArea" class="mt-4">
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

                                <div id="yearArea" class="mt-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Select Year :</label>
                                                <input type="text" class="form-control" id="datepicker_year" value="<?= date('Y'); ?>" name="year2">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" style="display: none;" class="btn btn-rounded btn-hers btn-sm float-right mb-4 btn-submit-activity">Submit</button>
                            </form>
                        </div>
                        <div class="data-tables datatable-dark mt-5 data-activity">
                            <table id="dataTableActivity" class="text-center table table-hover">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice</th>
                                        <th>Patient Name</th>
                                        <th>Cash Payment</th>
                                        <th>Money Change</th>
                                        <th>Total</th>
                                        <th>Created At</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($transaction as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><strong><a href="#" class="text-hers" id="detailTransaction" data-invoice="<?= $row->invoice; ?>"><?= $row->invoice; ?></a></strong></td>
                                            <td><?= $row->name == "" || $row->name == null ? "-" : $row->name; ?></td>
                                            <td>Rp&nbsp;<?= number_format($row->cash_payment, 0, ',', '.') ?>,-</td>
                                            <td>Rp&nbsp;<?= number_format($row->money_change, 0, ',', '.') ?>,-</td>
                                            <td>Rp&nbsp;<?= number_format($row->total, 0, ',', '.') ?>,-</td>
                                            <td><?= date_format(new DateTime($row->created_at), 'd/m/Y   H:i '); ?>&nbsp;WIB</td>
                                            <td>
                                                <button type="button" class="btn btn-rounded btn-xs btn-hers refundTransaction" id="btnRefund" data-invoice="<?= $row->invoice; ?>">Refund</button>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    endforeach ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total:</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th style="font-size: 22px;">Rp&nbsp;<?= number_format(
                                                                                    array_sum(array_column($transaction, 'total')),
                                                                                    0,
                                                                                    ',',
                                                                                    '.'
                                                                                );  ?>,-</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>





                    </div>


                </div>
            </div>
        </div>
        <!-- Statistics area end -->





    </div>
</div>
</div>