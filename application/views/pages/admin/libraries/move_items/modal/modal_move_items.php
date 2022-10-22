<div class="modal fade bd-example-modal-lg" id="modalMoveItems">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= $title; ?>&nbsp;<span class="itemName"></span></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formMoveItems">
                    <?php $this->load->view('layouts/_alert'); ?>
                    <input type="hidden" name="id_product" id="id_product_move">
                    <input type="hidden" name="title" id="title_product_move">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-form-label">Move to Store</label>
                                <select class="form-control select2" name="id_store" id="id_store_product_move">
                                    <option></option>
                                    <?php foreach ($store as $row) : ?>
                                        <?php if ($this->session->userdata('id_store') != $row->id) : ?>
                                            <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>
                                <span id="id_store_error"></span>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <label for="exampleInputStockProductIn">Quantity</label>
                            <input type="number" class="form-control" id="quantity_product_move" name="quantity" placeholder="Quantity" value="">
                            <span id="quantity_error"></span>
                        </div>


                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <label for="exampleInputNote">Note (optional)</label>
                            <textarea class="form-control" rows="6" name="note" id="note_product_move" placeholder="Type some note here."></textarea>

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