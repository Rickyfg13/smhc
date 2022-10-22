<?php if (!$this->session->has_userdata('edit_transaction')) : ?>
    <h1 class="text-hers mb-4" style="text-align: right;">Rp&nbsp;<?= number_format($totalCart, 0, ',', '.') ?>,-</h1>

    <?php if (count($cart) > 0) : ?>
        <div id="table-cart">


            <table class="table">

                <tbody>

                    <?php $i = 1;
                    //$subtotal = 0;
                    //$disc = 0;
                    foreach ($cart as $row) : ?>
                        <?php $subtotal = array_sum($sub_total); ?>
                        <?php $disc = array_sum($disc_total);  ?>
                        <?php $purchase_price = array_sum($purchase_price_total); ?>

                        <tr>

                            <td><i class="fa fa-trash clear-items text-secondary mr-2" data-rowid="<?= $row['rowid']; ?>" data-id="<?= $row['id']; ?>" data-qty="<?= $row['qty']; ?>"></i><span><?= $row['name']; ?>&nbsp;(<?= $row['qty']; ?>x)(<?= number_format($row['option']['price_temp'], 0, ',', '.') ?>)</span></td>
                            <td style="text-align: right;"><span><?= number_format($row['option']['price_temp'] * $row['qty'], 0, ',', '.') ?>,-</span></td>
                        </tr>
                    <?php endforeach ?>
                    <tr>
                        <td>Subtotal</td>
                        <td style="text-align: right;"><?= number_format($subtotal, 0, ',', '.') ?>,-</td>
                    </tr>
                    <tr>
                        <td>Discount Total</td>
                        <td style="text-align: right;">-&nbsp;<?= number_format($disc, 0, ',', '.') ?>,-</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td style="text-align: right;"><?= number_format($totalCart, 0, ',', '.') ?>,-</td>
                    </tr>

                </tbody>
            </table>
            <input type="hidden" id="tot_disc" value="<?= $disc; ?>">
            <input type="hidden" id="purchase_price" value="<?= $purchase_price; ?>">
            <input type="hidden" id="subtotal_cart" value="<?= $subtotal; ?>">
        </div>
    <?php else : ?>
        <div class="text-center">
            <i class="ti-shopping-cart" style="font-size: 100px; color: var(--secondary-color)"></i>
            <p class="mt-2" style="margin-bottom: 200px;">Please Add The Item First!</p>
        </div>
    <?php endif ?>
<?php else : ?>
    <?php
    $id_product_sess = $this->session->userdata('id_product');
    $quantity_sess = $this->session->userdata('quantity');


    $total_db                       = $this->session->userdata('total_db');
    $subtotal_db                    = $this->session->userdata('subtotal_db');
    $discount_total_db              = $this->session->userdata('discount_total_db');
    $purchase_price_total_db        = $this->session->userdata('total_db');
    ?>
    <h1 class="text-hers mb-4" style="text-align: right;">Rp&nbsp;<?= number_format(isset($totalCart) ? $totalCart + $total_db : $total_db, 0, ',', '.') ?>,-</h1>

    <div id="table-cart">


        <table class="table cart-space">

            <tbody>
                <tr class="old-data-space">
                    <td><span style="font-size: 11px; font-weight: 600;">Old Data</span></td>
                    <td></td>
                </tr>
                <?php foreach ($transaction as $data) : ?>
                    <tr id="<?= $data->id_product; ?>">
                        <td><i class="fa fa-trash clear-items-db text-secondary mr-2" data-id-product="<?= $data->id_product; ?>" data-invoice-number="<?= $data->invoice; ?>"></i><span><?= $data->title; ?>&nbsp;(<?= $data->qty; ?>x)(<?= number_format($data->price, 0, ',', '.') ?>)</span></td>
                        <td style="text-align: right;"><span><?= number_format($data->price * $data->qty, 0, ',', '.') ?>,-</span></td>
                    </tr>
                <?php endforeach ?>
                <?php if (isset($cart)) : ?>
                    <?php if (count($cart) > 0) : ?>
                        <tr>
                            <td><span style="font-size: 11px; font-weight: 600;">New Data</span></td>
                            <td></td>
                        </tr>
                        <?php $i = 1;
                        //$subtotal = 0;
                        //$disc = 0;
                        foreach ($cart as $row) : ?>
                            <?php $subtotal = array_sum($sub_total); ?>
                            <?php $disc = array_sum($disc_total);  ?>
                            <?php $purchase_price = array_sum($purchase_price_total); ?>
                            <tr>

                                <td><i class="fa fa-trash clear-items text-secondary mr-2" data-rowid="<?= $row['rowid']; ?>"></i><span><?= $row['name']; ?>&nbsp;(<?= $row['qty']; ?>x)(<?= number_format($row['option']['price_temp'], 0, ',', '.') ?>)</span></td>
                                <td style="text-align: right;"><span><?= number_format($row['option']['price_temp'] * $row['qty'], 0, ',', '.') ?>,-</span></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                <?php endif ?>
                <tr>
                    <td>Subtotal</td>
                    <td style="text-align: right;"><?= number_format(isset($subtotal) ? $subtotal + $subtotal_db : $subtotal_db, 0, ',', '.') ?>,-</td>
                </tr>
                <tr>
                    <td>Discount Total</td>
                    <td style="text-align: right;">-&nbsp;<?= number_format(isset($disc) ? $disc + $discount_total_db : $discount_total_db, 0, ',', '.') ?>,-</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td style="text-align: right;"><?= number_format(isset($totalCart) ? $totalCart + $total_db : $total_db, 0, ',', '.') ?>,-</td>
                </tr>

            </tbody>
        </table>
        <input type="hidden" id="tot_disc" value="<?= isset($disc) ? $disc + $discount_total_db : $discount_total_db; ?>">
        <input type="hidden" id="purchase_price" value="<?= isset($purchase_price) ? $purchase_price + $purchase_price_total_db : $purchase_price_total_db; ?>">
        <input type="hidden" id="subtotal_cart" value="<?= isset($subtotal) ? $subtotal + $subtotal_db : $subtotal_db; ?>">
    </div>

<?php endif ?>

<!-- <table class="table">
    <tbody>
        <tr>
            <td>Subtotal</td>
            <td class="text-right"><?= number_format($totalCart, 0, ',', '.') ?>,-</td>
        </tr>
        <tr>
            <td>Total</td>
            <td class="text-right"><?= number_format($totalCart, 0, ',', '.') ?>,-</td>
        </tr>
        <tr>
            
        </tr>
    </tbody>

</table> -->