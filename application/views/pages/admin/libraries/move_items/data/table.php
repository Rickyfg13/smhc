<div class="data-tables datatable-dark mt-4">
    <table id="dataTableMoveItems" class="text-center table table-hover">
        <thead class="text-capitalize">
            <tr>
                <th>#</th>
                <th style="width: 5%;">Title</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Store</th>
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
                    <td><?= $row->category_title; ?></td>
                    <td><?= $row->stock; ?></td>
                    <td>Rp&nbsp;<?= number_format($row->price, 0, ',', '.') ?>,-</td>
                    <td><?= $row->name; ?></td>
                    <td><?= date_format(new DateTime($row->created_at), 'd/m/Y H:i'); ?></td>
                    <td>
                        <button class="btn btn-rounded btn-hers-primary btnMoveItem" data-stock="<?= $row->stock; ?>" data-title="<?= $row->title; ?>" data-id="<?= $row->id; ?>" data-toggle="modal" data-target="#<?= $row->stock > 0 ? 'modalMoveItems' : '' ?>">Move Item</button>
                    </td>


                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>