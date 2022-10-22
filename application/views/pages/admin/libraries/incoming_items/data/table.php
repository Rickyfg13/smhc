<?php $this->load->view('layouts/_alert'); ?>
<div class="data-tables datatable-dark mt-4">
    <table id="dataTableProductIn" class="text-center table table-hover">
        <thead class="text-capitalize">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Stock In</th>
                <th>Created At</th>

                <th></th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->title; ?></td>
                    <td><?= $row->stock_in; ?></td>
                    <td><?= date_format(new DateTime($row->created_at_product_in), 'd/m/Y H:i'); ?></td>

                    <td>
                        <?php if ($this->session->userdata('role') == 'admin') : ?>
                            <button class="btn btn-rounded btn-info" id="btnEditProductIn" data-id-product="<?= $row->id_product ?>" data-id="<?= $row->id_product_in; ?>" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-edit fa-2x"></i></button>
                            <button class="btn btn-rounded btn-danger ml-2" id="btnDeleteProductIn" data-stock="<?= $row->stock; ?>" data-id="<?= $row->id_product_in; ?>" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-trash fa-2x"></i></button>
                        <?php endif ?>
                    </td>


                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>