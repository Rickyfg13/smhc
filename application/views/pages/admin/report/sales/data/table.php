<?php $this->load->view('layouts/_alert'); ?>
<div class="data-tables datatable-dark">
    <div class="d-flex justify-content-between">
        
        <div class="export">
            <select class="custome-select border-0 pr-3 mb-5" id="selectType">
                <option value="excel" selected>Excel</option>
                <option value="pdf">Pdf</option>
            </select>
            <button class="btn btn-rounded btn-xs btn-hers btnExportSalesInvoice">Export</button>
        </div>

    </div>

    <table id="dataTableReportSales" class="text-center table table-hover">
        <thead class="text-capitalize">
            <tr>
                <th>#</th>
                <th>Invoice</th>
                <th>Subtotal</th>
                <th>Created At</th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->invoice; ?></td>
                    <td>Rp&nbsp;<?= number_format($row->total, 0, ',', '.'); ?>,-</td>
                    <td><?= date_format(new DateTime($row->created_at), 'd/m/Y H:i'); ?></td>




                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Total:</th>
                <th></th>
                <th style="font-size: 18px;">Rp&nbsp;<?= number_format(
                                                            array_sum(array_column($content, 'total')),
                                                            0,
                                                            ',',
                                                            '.'
                                                        );  ?>,-</th>
                <th></th>
            </tr>
        </tfoot>
    </table>

</div>