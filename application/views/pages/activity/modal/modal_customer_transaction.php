<div class="modal-header">
    <h5 class="modal-title"><?= $name_patient->name; ?></h5>

    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
</div>
<div class="modal-body">


    <div class="customer-transaction-data">
        <?php if (count($transaction) > 0) : ?>
            <div id="accordion2" class="according accordion-s2">
                <?php foreach ($transaction as $row) :  ?>
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#data-<?= $row->invoice; ?>">
                                <?= $row->invoice; ?>&nbsp;-&nbsp;<?= date_format(new DateTime($row->created_at), 'd/m/Y'); ?>
                            </a>
                        </div>
                        <div id="data-<?= $row->invoice; ?>" class="collapse" data-parent="#accordion2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3 mt-3">
                                        <table class="table">
                                            <tr>
                                                <td>Date of Transaction</td>
                                                <td>:</td>
                                                <td><i class="fa fa-calendar"></i>&nbsp;<?= date_format(new DateTime($invoice_detail[$row->invoice]->created_at), 'd/m/Y'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Time</td>
                                                <td>:</td>
                                                <td><i class="fa fa-clock-o"></i>&nbsp;<?= date_format(new DateTime($invoice_detail[$row->invoice]->created_at), 'H:i'); ?>&nbsp;WIB</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-lg-6 mb-3 mt-3">
                                        <table class="table">
                                            <tr>
                                                <td>Invoice Number</td>
                                                <td>:</td>
                                                <td><i class="fa fa-file"></i>&nbsp;<?= $row->invoice; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Cashier</td>
                                                <td>:</td>
                                                <td><i class="fa fa-user"></i>&nbsp;<?= $invoice_detail[$row->invoice]->name ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Items</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col" class="text-right">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($transaction_detail[$row->invoice] as $row2) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $row2->title_product ?>&nbsp;(Rp&nbsp;<?= number_format($row2->price, 0, ',', '.') ?>,-)</td>
                                                    <td><?= $row2->qty; ?>x</td>
                                                    <td class="text-right">Rp&nbsp;<?= number_format($row2->subtotal, 0, ',', '.') ?>,-</td>
                                                </tr>
                                            <?php endforeach ?>
                                            <tr>
                                                <td></td>
                                                <td>Subtotal :</td>
                                                <td></td>
                                                <td class="text-right">Rp&nbsp;<?= $discount[$row->invoice]->subtotal != "" ? number_format($discount[$row->invoice]->subtotal, 0, ',', '.') : 0 ?>,-</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Discount :</td>
                                                <td></td>
                                                <td class="text-right">Rp&nbsp;<?= $discount[$row->invoice]->discount_total != "" ? number_format($discount[$row->invoice]->discount_total, 0, ',', '.') : 0 ?>,-</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><span style="font-weight: 700; font-size: 16px">Total :</span></td>
                                                <td></td>
                                                <td class="text-right"><span style="font-weight: 700; font-size: 16px">Rp&nbsp;<?= number_format($invoice_detail[$row->invoice]->total, 0, ',', '.') ?>,-</span></td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php else : ?>
            <div class="text-center">
                <h5>No Transaction.</h5>
            </div>
        <?php endif ?>
    </div>





</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-rounded btn-secondary" data-dismiss="modal">Close</button>

</div>