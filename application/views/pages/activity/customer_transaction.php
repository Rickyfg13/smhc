<div class="main-content-inner">
    <div class="container-fluid">
        <div class="row">


            <!-- Statistics area start -->
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="patients-data">
                            <h4 class="header-title">List Of Patients</h4>
                            <div class="data-tables datatable mt-4">
                                <table id="dataTableListPatientsTransaction" class="text-center table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($patients as $row) : ?>
                                            <tr id="rowCustomer" data-id="<?= $row->id; ?>" data-name="<?= $row->name; ?>">
                                                <td>
                                                    <div class="data-space<?= $row->id; ?>">
                                                        <i class="fa fa-user mr-2"></i><span class="customer-name"><?= $row->name; ?></span>
                                                    </div>
                                                    <div class="edit-space<?= $row->id; ?>" style="display: none;">
                                                        <input type="text" class="form-control form-control-sm" value="<?= $row->name; ?>" id="nameEditCustomer<?= $row->id; ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="data-space<?= $row->id; ?>">
                                                        <i class="ti-mobile mr-2"></i><span class="customer-phone"><?= $row->phone; ?></span>
                                                    </div>
                                                    <div class="edit-space<?= $row->id; ?>" style="display: none;">
                                                        <input type="text" class="form-control form-control-sm" value="<?= $row->phone; ?>" id="phoneEditCustomer<?= $row->id; ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php if ($row->email != '') : ?>
                                                        <div class="data-space<?= $row->id; ?>">
                                                            <i class="ti-email mr-2"></i><span class="customer-email"><?= $row->email; ?></span>
                                                        </div>
                                                    <?php else : ?>
                                                        <span>-</span>
                                                    <?php endif  ?>
                                                    <div class="edit-space<?= $row->id; ?>" style="display: none;">
                                                        <input type="text" class="form-control form-control-sm" value="<?= $row->email; ?>" id="emailEditCustomer<?= $row->id; ?>">
                                                    </div>
                                                </td>
                                                <td><?= $row->created_at; ?></td>
                                                <td>
                                                    <button class="btn btn-xs btn-rounded btn-hers" id="btnViewTransaction" data-id="<?= $row->id; ?>"><i class="fa fa-eye mr-1"></i> View Transaction</button>

                                                    

                                                </td>


                                            </tr>


                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="data-customer-transaction">

                        </div>







                    </div>


                </div>
            </div>
        </div>
        <!-- Statistics area end -->





    </div>
</div>
</div>