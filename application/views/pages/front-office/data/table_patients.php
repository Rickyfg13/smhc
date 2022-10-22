<div class="data-tables datatable mt-4">
    <table id="dataTableListPatients" class="text-center table table-hover">
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
                        <!-- <button class="btn btn-xs btn-rounded btn-hers" id="btnAddToQueue" data-id="<?= $row->id; ?>"><i class="fa fa-plus mr-1"></i> To Queue</button>

                        <button class="btn btn-xs btn-rounded btn-danger" id="btnDeletePatient" data-id="<?= $row->id; ?>"><i class="fa fa-trash mr-1"></i> Delete</button> -->
                        <button type="button" class="btn btn-xs btn-rounded btn-default dropdown-toggle" style="background-color: transparent;" data-toggle="dropdown" aria-expanded="true">
                            <i class="ti-more-alt" style="transform: rotate(90deg)"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item" id="btnAddToQueue" data-id="<?= $row->id; ?>"><i class="ti-plus mr-2" style="color: #BB9A5D;"></i>To Queue</a>
                            <a href="#" class="dropdown-item" id="btnEditPatient" data-id="<?= $row->id; ?>"><i class="ti-pencil mr-2" style="color: #BB9A5D;"></i>Edit</a>
                            <a href="#" class="dropdown-item" id="btnDeletePatient" data-id="<?= $row->id; ?>"><i class="ti-trash mr-2" style="color: #BB9A5D;"></i>Delete</a>
                        </div>
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