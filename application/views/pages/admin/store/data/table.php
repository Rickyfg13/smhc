<?php $this->load->view('layouts/_alert'); ?>
<div class="data-tables datatable-dark mt-4">
    <table id="dataTableStore" class="text-center table table-hover">
        <thead class="text-capitalize">
            <tr>
                <th>#</th>
               
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->name; ?></td>
                    <td><?= $row->phone; ?></td>
                    <td><?= $row->address; ?></td>
                    <td><?= date_format(new DateTime($row->created_at), 'd/m/Y H:i'); ?></td>
                    <td><?= date_format(new DateTime($row->updated_at), 'd/m/Y H:i'); ?></td>
                    <td>
                        <button class="btn btn-rounded btn-info" id="btnEditStore" data-id="<?= $row->id; ?>" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-edit fa-2x"></i></button>
                        <button class="btn btn-rounded btn-danger ml-2" id="btnDeleteStore" data-id="<?= $row->id; ?>" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-trash fa-2x"></i></button>
                    </td>


                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>