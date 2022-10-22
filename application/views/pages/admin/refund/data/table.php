<?php $this->load->view('layouts/_alert'); ?>
<div class="data-tables datatable-dark mt-4">
    <table id="dataTableRefund" class="text-center table table-hover">
        <thead class="text-capitalize">
            <tr>
                <th>#</th>
                <th>Invoice</th>
                <th>Patient Name</th>
                <th>Cash Payment</th>
                <th>Money Change</th>
                <th>Total</th>
                <th>Created At</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <!-- <td><strong><a href="#" class="text-hers" id="detailRefund" data-invoice="<?= $row->invoice; ?>"><?= $row->invoice; ?></a></strong></td> -->
                    <td><?= $row->invoice; ?></td>
                    <td><?= $row->name == "" || $row->name == null ? "-" : $row->name; ?></td>

                    <td>Rp&nbsp;<?= number_format($row->cash_payment, 0, ',', '.') ?>,-</td>
                    <td>Rp&nbsp;<?= number_format($row->money_change, 0, ',', '.') ?>,-</td>
                    <td>Rp&nbsp;<?= number_format($row->total, 0, ',', '.') ?>,-</td>
                    <td><?= date_format(new DateTime($row->created_at), 'd/m/Y   H:i '); ?>&nbsp;WIB</td>
                    <td><?= $row->reason; ?></td>

                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Total:</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th style="font-size: 22px;">Rp&nbsp;<?= number_format(
                                                            array_sum(array_column($content, 'total')),
                                                            0,
                                                            ',',
                                                            '.'
                                                        );  ?>,-</th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>