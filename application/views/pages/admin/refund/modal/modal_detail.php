<div class="modal-header">
    <h5 class="modal-title">Detail of Refund Transaction</h5>

    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
</div>
<div class="modal-body">

    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-lg-12">
                <button class="btn btn-xs btn-hers btn-rounded float-right" id="btnPrintInvoice"><i class="ti-printer mr-2"></i>Print Invoice</button>
                <button class="btn btn-xs btn-danger btn-rounded float-right mr-2" id="btnConvertToPdf" onclick="window.open('<?= base_url() . 'cashier/invoice/' . $invoice . '/pdf' ?>')"><i class="ti-printer mr-2"></i>Convert to Pdf</button>
            </div> -->


            <div id="frames">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-3 mt-3">
                <table class="table">
                    <tr>
                        <td>Date of Transaction</td>
                        <td>:</td>
                        <td><i class="fa fa-calendar"></i>&nbsp;<?= date_format(new DateTime($invoice_detail->created_at), 'd/m/Y'); ?></td>
                    </tr>
                    <tr>
                        <td>Time</td>
                        <td>:</td>
                        <td><i class="fa fa-clock-o"></i>&nbsp;<?= date_format(new DateTime($invoice_detail->created_at), 'H:i'); ?>&nbsp;WIB</td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-6 mb-3 mt-3">
                <table class="table">
                    <tr>
                        <td>Invoice Number</td>
                        <td>:</td>
                        <td><i class="fa fa-file"></i>&nbsp;<?= $invoice; ?></td>
                    </tr>
                    <tr>
                        <td>Cashier</td>
                        <td>:</td>
                        <td><i class="fa fa-user"></i>&nbsp;<?= $invoice_detail->name ?></td>
                    </tr>
                </table>
            </div>
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
                foreach ($transaction as $row) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $row->title_product ?>&nbsp;(Rp&nbsp;<?= number_format($row->price, 0, ',', '.') ?>,-)</td>
                        <td><?= $row->qty; ?>x</td>
                        <td class="text-right">Rp&nbsp;<?= number_format($row->subtotal, 0, ',', '.') ?>,-</td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td></td>
                    <td>Subtotal :</td>
                    <td></td>
                    <td class="text-right">Rp&nbsp;<?= $discount->subtotal != "" ? number_format($discount->subtotal, 0, ',', '.') : 0 ?>,-</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Discount :</td>
                    <td></td>
                    <td class="text-right">Rp&nbsp;<?= $discount->discount_total != "" ? number_format($discount->discount_total, 0, ',', '.') : 0 ?>,-</td>
                </tr>
                <tr>
                    <td></td>
                    <td><span style="font-weight: 700; font-size: 16px">Total :</span></td>
                    <td></td>
                    <td class="text-right"><span style="font-weight: 700; font-size: 16px">Rp&nbsp;<?= number_format($invoice_detail->total, 0, ',', '.') ?>,-</span></td>
                </tr>

            </tbody>
        </table>

    </div>





</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-rounded btn-secondary" data-dismiss="modal">Close</button>

</div>