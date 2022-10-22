<div class="modal-header">
    <h5 class="modal-title">List of Transactions (Today)</h5>

    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
</div>
<div class="modal-body">

    <div class="table-responsive">
        <table class="table" id="tableTransactions">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Total</th>
                    <th scope="col">Created At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($transaction as $row) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><strong><a href="#" class="text-hers" id="detailTransaction" data-invoice="<?= $row->invoice; ?>"><?= $row->invoice; ?></a></strong></td>
                        <td>Rp&nbsp;<?= number_format($row->total, 0, ',', '.') ?>,-</td>
                        <td><?= date_format(new DateTime($row->created_at), 'd/m/Y   H:i '); ?>&nbsp;WIB</td>
                        <td>
                            <!-- <button type="button" class="btn btn-rounded btn-xs btn-hers text-center" id="editTransaction" data-invoice="<?= $row->invoice; ?>"><i class="ti-pencil-alt"></i></button> -->
                            <button type="button" class="btn btn-rounded btn-xs btn-hers text-center refundTransaction" data-invoice="<?= $row->invoice; ?>"><i class="ti-back-left mr-2"></i>Refund</button>

                        </td>
                    </tr>
                <?php $i++;
                endforeach ?>


            </tbody>
        </table>

    </div>





</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-rounded btn-secondary" data-dismiss="modal">Close</button>

</div>