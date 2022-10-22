<!-- <div class="data-tables datatable mt-4">
    <table id="dataTableQueueProgress" class="text-center table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Created At</th>
                <th>Status</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($queue as $row) : ?>
                <tr id="rowCustomer" data-id="<?= $row->id; ?>" data-name="<?= $row->name; ?>">
                    <td><?= $row->id; ?></td>
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
                    <td><?= $row->created_at; ?></td>
                    <td>
                        <?php
                        $getStatus = $row->status;
                        $status = str_replace("_", " ", $getStatus);
                        ?>
                        <span class="badge badge-warning badge-pill" style="font-size: 16px;"><?= ucwords($status);  ?></span>

                    </td>
                    <td>
                        <button class="btn btn-info btn-rounded btn-xs" id="btnAddToPayment" data-id="<?= $row->id; ?>">Done</button>
                    </td>



                </tr>


            <?php endforeach ?>
        </tbody>
    </table>
</div> -->




<?php if (count($queue) > 0) : ?>
    <?php foreach ($queue as $row) : ?>
        <?php
        $getStatus = $row->status;
        $status = str_replace("_", " ", $getStatus);
        ?>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card custom mx-auto" style="width: 97%;">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-title">
                                <div class="d-flex">
                                    <i class="ti-user mr-2"></i>
                                    <?= $row->name; ?>
                                    <div id="circle" class="ml-3 my-auto"></div>

                                </div>

                            </h6>
                            <div class="btn-group">
                                <span style="font-size: 12px;"></span>
                                <button type="button" class="btn btn-xs btn-rounded btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti-more-alt"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right animate slideIn">
                                    <button class="dropdown-item" type="button" id="btnEditMedicalRecord" data-id="<?= $row->id; ?>" data-name="<?= $row->name; ?>"><i class=" ti-pencil mr-2 text-info"></i><strong>Edit Medical Record</strong></button>
                                </div>
                            </div>
                        </div>

                        <p class="card-text" style="margin-top: -5px;"><i class="ti-mobile mr-2"></i><?= $row->phone; ?></p>

                    </div>
                </div>
            </div>

        </div>
    <?php endforeach ?>
<?php else : ?>
    <div class="text-center">
        <img src="<?= base_url("assets/images/icon/note.png") ?>" style="width: 150px; opacity: 0.2;" class="mt-3" alt="" srcset="">
        <p style="font-size: 13px; opacity: 0.4;">No data available in list.</p>
    </div>


<?php endif ?>