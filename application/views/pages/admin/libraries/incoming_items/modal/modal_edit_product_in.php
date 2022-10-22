<form action="#" method="POST" id="formEditProductIn">
    <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class="modal-body">
        <?php $this->load->view('layouts/_alert'); ?>
        <input type="hidden" name="id" class="id_product_in" value="<?= $getProductIn->id_product_in; ?>">
        <input type="hidden" name="id_product_in" class="id_product_db" value="">
        <div class="row">
            <div class="col-lg-12">
                <span>Your Product is not available on the list? <a href="<?= base_url("admin/inventory") ?>">Click here</a> to add a new item </span>
                <div class="form-group">
                    <label class="col-form-label">Product</label>
                    <select class="form-control edit-product-in" id="id_product_in" disabled>
                        <option></option>
                        <?php foreach ($product as $row) : ?>
                            <option value="<?= $row->id; ?>" <?= $row->id == $getProductIn->id_product ? "selected" : "" ?>><?= $row->title; ?></option>
                        <?php endforeach ?>
                    </select>
                    <span id="id_product_in_error"></span>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <label for="exampleInputStockProductIn">Stock In</label>
                <input type="number" class="form-control" id="stock_in" name="stock_in" placeholder="Stock" value="<?= $getProductIn->stock_in; ?>">
                <span id="stock_in_error"></span>
            </div>


        </div>

        <div class="row mt-3">
            <div class="col-lg-12">
                <label for="exampleInputNote">Note (optional)</label>
                <textarea class="form-control" rows="6" name="note" id="note" placeholder="Type some note here."><?= $getProductIn->note; ?></textarea>

            </div>


        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-rounded btn-hers">Update Data</button>
    </div>
</form>