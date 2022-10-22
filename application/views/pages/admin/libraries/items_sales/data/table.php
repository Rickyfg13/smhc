<?php $this->load->view('layouts/_alert'); ?>
<div class="data-tables datatable-dark mt-4">
    <table id="dataTableProductOut" class="text-center table table-hover">
        <thead class="text-capitalize">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Starter Stock</th>
                <th>Quantity of Out Stock</th>
                <th>Remaining Stock</th>
                <!-- <th>Datetime</th> -->
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->title; ?></td>
                    <td><?= $row->stock_out + $row->stock; ?></td>
                    <td><?= $row->stock_out; ?></td>
                    <td><?= $row->stock; ?></td>
                    <!-- <td><?= date_format(new DateTime($row->created_at), 'd/m/Y H:i'); ?></td> -->

                    


                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>