<div class="modal fade bd-example-modal-lg" id="modalPay">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pay This Invoice (Rp&nbsp;<span id="totalValueModal"><?= number_format($totalCart, 0, ',', '.') ?></span>,-)</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">

                <form action="#" method="POST" id="formPay">
                    <input type="hidden" name="invoice" id="invoice" value="">
                    <input type="hidden" name="purchase_price_total" id="purchasePriceTotal" value="">
                    <input type="hidden" name="discount_total" id="discount_total" value="">
                    <input type="hidden" name="subtotal" id="subtotal" value="">
                    <input type="hidden" name="id_customer" id="id_customer" value="">
                    <input type="hidden" name="total" id="total" value="<?= $totalCart; ?>">
                    <input type="hidden" name="method_payment" id="method_payment" value="cash_payment">
                    <input type="hidden" name="bank" id="bank" value="">
                    <input type="hidden" name="marketplace" id="marketplace" value="">
                    <div class="mt-1 mb-3">
                        <b class="text-muted mb-3 d-block">Payment Method:</b>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" checked id="cashmethod_payment" name="customRadio2" data-val="cash_payment" class="custom-control-input">
                            <label class="custom-control-label" for="cashmethod_payment">Cash Payment</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="debit_payment" name="customRadio2" data-val="debit_payment" class="custom-control-input">
                            <label class="custom-control-label" for="debit_payment">Debit/Transfer Payment</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="market_place" name="customRadio2" data-val="market_place" class="custom-control-input">
                            <label class="custom-control-label" for="market_place">Marketplace</label>
                        </div>
                    </div>


                    <div id="space_cash_payment">
                        <div class="form-group">
                            <label for="title_category">Cash Payment</label>
                            <input type="text" class="form-control" name="cash_payment" id="cash_payment" aria-describedby="cashPaymeny" placeholder="Cash Amount" autofocus>
                            <span id="cash_payment_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="title_category">Money Change</label>
                            <input type="text" class="form-control" name="money_change" id="money_change" aria-describedby="moneyChange" placeholder="Money Change" readonly>

                        </div>
                    </div>

                    <div id="space_debit_payment" style="display: none;">
                        <div class="form-group">
                            <label for="title_category">Select Bank</label>
                            <select name="bank_list" id="bank_list" class="form-control form-control-sm select2">
                                <option value="mandiri" selected>Mandiri</option>
                                <option value="bni">Bank Negara Indonesia</option>
                                <option value="bca">Bank Central Asia</option>
                                <option value="bri">Bank Rakyat Indonesia</option>
                            </select>
                        </div>
                    </div>

                    <div id="space_marketplace" style="display: none;">
                        <div class="form-group">
                          <label for="marketplace_list">Select Marketplace</label>
                          <select name="marketplace_list" id="marketplace_list" class="form-control form-control-sm select2">
                            <option value="shopee" selected>Shopee</option>
                            <option value="tokopedia">Tokopedia</option>
                          </select>
                        </div>
                    </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-rounded btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-rounded btn-hers btn-pay">Pay</button>
            </div>
            </form>
        </div>
    </div>
</div>