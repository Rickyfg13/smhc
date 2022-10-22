<button class="btn btn-xs btn-hers btn-rounded" id="btnQueueList">Queues List</button>
<button class="btn btn-xs btn-hers-primary btn-rounded" id="btnPatientList">Patients List</button>

<div class="data-tables datatable mt-4" id="queueSpace">
    <h3 class="mb-3" style="font-size: 14px;">Queues List</h3>
    <table id="dataTable3" class="text-center table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <!-- <th>Email</th> -->
                <th>Created At</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($customer as $row) : ?>
                <tr>
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
                    <!-- <td>
                        <div class="data-space<?= $row->id; ?>">
                            <i class="ti-email mr-2"></i><span class="customer-email"><?= $row->email; ?></span>
                        </div>
                        <div class="edit-space<?= $row->id; ?>" style="display: none;">
                            <input type="text" class="form-control form-control-sm" value="<?= $row->email; ?>" id="emailEditCustomer<?= $row->id; ?>">
                        </div>
                    </td> -->
                    <td><?= date_format(new DateTime($row->created_at), 'H:i'); ?></td>
                    <td>
                        <button type="button" class="btn btn-xs btn-rounded btn-default dropdown-toggle" style="background-color: transparent;" data-toggle="dropdown" aria-expanded="true">
                            <i class="ti-more-alt" style="transform: rotate(90deg)"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item btnAddToCartQueue" id="rowCustomer" data-queue="<?= $row->id_queue; ?>" data-id="<?= $row->id; ?>" data-phone="<?= $row->phone; ?>" data-name="<?= $row->name; ?>"><i class="ti-plus mr-2" style="color: #BB9A5D;"></i>To Cart</a>
                            <a href="#" class="dropdown-item btnAddToCartQueue" id="viewMedicalRecord" onClick="window.open('<?= base_url() . 'customer/print/' . $row->id; ?>')" data-id="<?= $row->id; ?>"><i class="ti-view-list-alt mr-2" style="color: #BB9A5D;"></i> View Medical Record</a>
                        </div>
                        <!-- <button class="btn btn-xs btn-hers btn-rounded btnAddToCartQueue" id="rowCustomer" data-id="<?= $row->id; ?>" data-name="<?= $row->name; ?>" data-phone="<?= $row->phone; ?>" data-queue="<?= $row->id_queue; ?>"><i class="ti-plus mr-2"></i>To Cart</button>
                        <button class="btn btn-xs btn-hers-primary btn-rounded ml-2 btnAddToCartQueue" id="viewMedicalRecord" onClick="window.open('<?= base_url() . 'customer/print/' . $row->id; ?>')" data-id="<?= $row->id; ?>"><i class="ti-view-list-alt mr-2"></i>View Medical Record</button> -->
                    </td>
                    <!-- <td><button class="btn btn-xs btn-purple btn-rounded btnSubmitEditCustomer" id="btnSubmitEditCustomer<?= $row->id; ?>" data-id="<?= $row->id; ?>" style="display: none;"><i class="fa fa-check" style="font-size: 18px;"></i></button></td>
                    <td>
                        <div class="edit-btn-space<?= $row->id; ?>">
                            <i class="fa fa-chevron-right" id="btnEditCustomer" style="color: #6a56a5; font-size: 18px; cursor: pointer;" data-id="<?= $row->id; ?>"></i>
                        </div>
                    </td> -->

                </tr>


            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div class="data-tables datatable mt-4" id="patientSpace" style="display: none;">
    <h3 class="mb-3" style="font-size: 14px;">Patients List</h3>
    <table id="dataTable6" class="text-center table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <!-- <th>Email</th> -->
                <th>Created At</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($patient as $row) : ?>
                <tr>
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
                    <!-- <td>
                        <div class="data-space<?= $row->id; ?>">
                            <i class="ti-email mr-2"></i><span class="customer-email"><?= $row->email; ?></span>
                        </div>
                        <div class="edit-space<?= $row->id; ?>" style="display: none;">
                            <input type="text" class="form-control form-control-sm" value="<?= $row->email; ?>" id="emailEditCustomer<?= $row->id; ?>">
                        </div>
                    </td> -->
                    <td><?= $row->created_at; ?></td>
                    <td class="">
                        <button type="button" class="btn btn-xs btn-rounded btn-default dropdown-toggle" style="background-color: transparent;" data-toggle="dropdown" aria-expanded="true">
                            <i class="ti-more-alt" style="transform: rotate(90deg)"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item btnAddToCartQueue" id="rowPatient" data-id="<?= $row->id; ?>" data-phone="<?= $row->phone; ?>" data-name="<?= $row->name; ?>"><i class="ti-plus mr-2" style="color: #BB9A5D;"></i>To Cart</a>
                            <a href="#" class="dropdown-item btnAddToCartQueue" id="viewMedicalRecord" onClick="window.open('<?= base_url() . 'customer/print/' . $row->id; ?>')" data-id="<?= $row->id; ?>"><i class="ti-view-list-alt mr-2" style="color: #BB9A5D;"></i> View Medical Record</a>
                        </div>
                        <!-- <button class="btn btn-xs btn-hers btn-rounded btnAddToCartQueue" id="rowPatient" data-id="<?= $row->id; ?>" data-phone="<?= $row->phone; ?>" data-name="<?= $row->name; ?>"><i class="ti-plus mr-2"></i>To Cart</button>
                        <button class="btn btn-xs btn-hers-primary btn-rounded ml-2 btnAddToCartQueue" id="viewMedicalRecord" onClick="window.open('<?= base_url() . 'customer/print/' . $row->id; ?>')" data-id="<?= $row->id; ?>"><i class="ti-view-list-alt mr-2"></i>View Medical Record</button> -->
                    </td>
                    <!-- <td><button class="btn btn-xs btn-purple btn-rounded btnSubmitEditCustomer" id="btnSubmitEditCustomer<?= $row->id; ?>" data-id="<?= $row->id; ?>" style="display: none;"><i class="fa fa-check" style="font-size: 18px;"></i></button></td>
                    <td>
                        <div class="edit-btn-space<?= $row->id; ?>">
                            <i class="fa fa-chevron-right" id="btnEditCustomer" style="color: #6a56a5; font-size: 18px; cursor: pointer;" data-id="<?= $row->id; ?>"></i>
                        </div>
                    </td> -->

                </tr>


            <?php endforeach ?>
        </tbody>
    </table>
</div>