<?php $this->load->view('layouts/_alert'); ?>
<div class="data-tables datatable-dark mt-4">
    <table id="dataTableDiscount" class="text-center table table-hover">
        <thead class="text-capitalize">
            <tr>
                <th>#</th>
                <th>Title of Discount</th>
                <th>Value</th>
                <th>Start From</th>
                <th>Expired</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->title_discount; ?></td>
                    <td><?= $row->value; ?></td>
                    <td><?= date_format(new DateTime($row->tgl_start), 'd/m/Y'); ?></td>
                    <td><?= date_format(new DateTime($row->tgl_end), 'd/m/Y'); ?></td>
                    <td>
                        <button class="btn btn-rounded btn-info" id="btnEditDiscount" data-id="<?= $row->id; ?>" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-edit fa-2x"></i></button>
                        <button class="btn btn-rounded btn-danger ml-2" id="btnDeleteDiscount" data-id="<?= $row->id; ?>" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-trash fa-2x"></i></button>
                    </td>


                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>