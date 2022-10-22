<?php $this->load->view('layouts/_alert'); ?>
<div class="data-tables datatable-dark mt-4">
    <select class="custome-select border-0 pr-3 mb-5" id="selectType">
        <option value="excel" selected>Excel</option>
        <option value="pdf">Pdf</option>
    </select>
    <button class="btn btn-rounded btn-xs btn-hers btnExportPerDays">Export</button>
    <table id="dataTableReportSalesPerdays" class="text-center table table-hover">
        <thead class="text-capitalize">
            <tr>
                <th>#</th>
                <th>Created At</th>
                <th>Subtotal</th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= date_format(new DateTime($row->created_at), 'd/m/Y'); ?></td>
                    <td>Rp&nbsp;<?= number_format($row->total, 0, ',', '.'); ?>,-</td>




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
            </tr>
        </tfoot>
    </table>

</div>