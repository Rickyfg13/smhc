<?php $this->load->view('layouts/_alert'); ?>
<div class="data-tables datatable-dark mt-4">
    <select class="custome-select border-0 pr-3 mb-5" id="selectType">
        <option value="excel" selected>Excel</option>
        <option value="pdf">Pdf</option>
    </select>
    <button class="btn btn-rounded btn-xs btn-hers btnExportSalesProduct">Export</button>
    <table id="dataTableReportSalesProduct" class="text-center table table-hover">
        <thead class="text-capitalize">
            <tr>
                <th>#</th>
                <th>Title of Product</th>
                <th>Price</th>
                <th>Items Sales</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->title; ?></td>
                    <td>Rp&nbsp;<?= number_format($row->price, 0, ',', '.'); ?>,-</td>
                    <td><?= $row->qty; ?></td>
                    <td>Rp&nbsp;<?= number_format($row->subtotal, 0, ',', '.'); ?>,-</td>
                    <!-- <td><?= date_format(new DateTime($row->created_at), 'd/m/Y H:i'); ?></td> -->




                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Subtotal:</th>
                <th></th>
                <th></th>
                <th></th>
                <th>Rp&nbsp;<?= number_format(
                                array_sum(array_column($content, 'subtotal')),
                                0,
                                ',',
                                '.'
                            );  ?>,-</th>

            </tr>
            <tr>
                <th>Discount Total:</th>
                <th></th>
                <th></th>
                <th></th>
                <th>-&nbsp;Rp&nbsp;<?= number_format(
                                        $get_total_discount,
                                        0,
                                        ',',
                                        '.'
                                    );  ?>,-</th>

            </tr>
            <tr>
                <th>Total:</th>
                <th></th>
                <th></th>
                <th></th>
                <?php
                $total_transaction_detail = array_sum(array_column($content, 'subtotal'));
                $total = $total_transaction_detail - $get_total_discount;
                ?>
                <th style="font-size: 18px;">Rp&nbsp;<?= number_format(
                                                            $total,
                                                            0,
                                                            ',',
                                                            '.'
                                                        );  ?>,-</th>

            </tr>
        </tfoot>
    </table>

</div>