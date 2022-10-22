<?php $this->load->view('layouts/_alert'); ?>
<div class="data-tables datatable-dark mt-4">
    <table id="dataTable3" class="text-center table table-hover">
        <thead class="text-capitalize">
            <tr>
                <th>#</th>
                <th>Category Code</th>
                <th>Title of Category</th>
                <th>Slug</th>
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
                    <td><?= $row->id; ?></td>
                    <td><?= $row->title; ?></td>
                    <td><?= $row->slug; ?></td>
                    <td><?= date_format(new DateTime($row->created_at), 'd/m/Y H:i'); ?></td>
                    <td><?= date_format(new DateTime($row->updated_at), 'd/m/Y H:i'); ?></td>
                    <td>
                        <button class="btn btn-rounded btn-info" id="btnEditCategory" data-id="<?= $row->id; ?>" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-edit fa-2x"></i></button>
                        <button class="btn btn-rounded btn-danger ml-2" id="btnDeleteCategory" data-id="<?= $row->id; ?>" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-trash fa-2x"></i></button>
                    </td>


                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>