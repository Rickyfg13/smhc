<div class="data-tables datatable mt-4">
    <table id="dataTableQueueProgress" class="text-center table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Created At</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($queue as $row) : ?>
                <tr id="rowCustomer" data-id="<?= $row->id; ?>" data-name="<?= $row->name; ?>">
                    <td><?= substr($row->id, 9); ?></td>
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
                        <button type="button" class="btn btn-hers btn-xs btn-rounded" id="btnAddTherapist" data-id="<?= $row->id; ?>">Add Therapist</button>
                    </td>


                </tr>


            <?php endforeach ?>
        </tbody>
    </table>
</div>