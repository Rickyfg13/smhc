<div class="modal fade bd-example-modal-lg" id="modalReasonRefund">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title_modal">Refund Transaction</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">


                <div class="form-group">
                    <label for="invoice_number_refund">Invoice Number</label>
                    <input type="text" class="form-control" name="invoice_number" id="invoice_number_refund" placeholder="Invoice Number" readonly>
                </div>
                <div class="form-group">
                    <label for="reason">Why You Refund this Item?</label>
                    <select class="form-control select2" name="reason" id="reason">
                        <option value="Transaction Input Error">Transaction Input Error</option>
                        <option value="Some Product Defect">Some Product Defect</option>
                        <option value="Some Product Doesn't Match">Some Product Doesn't Match</option>
                        <option value="Other..">Other..</option>

                    </select>
                </div>

                <div class="form-group another_reason" style="display: none;">
                    <label for="another_reason">Another Reason</label>
                    <textarea class="form-control" name="another_reason" id="another_reason" rows="3" placeholder="Address"></textarea>
                </div>








            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-rounded btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-rounded btn-hers" id="btnRefundTrans">Refund This Item</button>
            </div>

        </div>
    </div>
</div>