<div class="modal fade bd-example-modal-lg" id="modalAddProductIn">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formAddProductIn">
                    <?php $this->load->view('layouts/_alert'); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <span>Your Product is not available on the list? <a href="<?= base_url("admin/inventory") ?>">Click here</a> to add a new item </span>
                            <div class="form-group">
                                <label class="col-form-label">Product</label>
                                <select class="form-control select2" name="id_product_in" id="id_product_in">
                                    <option></option>
                                    <?php foreach ($product as $row) : ?>
                                        <option value="<?= $row->id; ?>"><?= $row->title; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span id="id_product_in_error"></span>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <label for="exampleInputStockProductIn">Stock In</label>
                            <input type="number" class="form-control" id="stock_in" name="stock_in" placeholder="Stock" value="">
                            <span id="stock_in_error"></span>
                        </div>


                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <label for="exampleInputNote">Note (optional)</label>
                            <textarea class="form-control" rows="6" name="note" id="note" placeholder="Type some note here."></textarea>

                        </div>


                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-rounded btn-hers">Add Data</button>
            </div>
            </form>
        </div>
    </div>
</div>