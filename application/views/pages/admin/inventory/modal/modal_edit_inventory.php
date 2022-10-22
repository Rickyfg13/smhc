<form action="#" method="POST" id="formEditInventory">
    <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class="modal-body">

        <input type="hidden" name="id" value="<?= $getInventory->id_product; ?>">
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleInputTitleProduct">Title of Product</label>
                    <input type="text" class="form-control" id="title_edit" name="title" aria-describedby="emailHelp" placeholder="Title Product" value="<?= $getInventory->title_product; ?>">
                    <span id="title_edit_error"></span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleInputSlugProduct">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug_edit" placeholder="Slug" value="<?= $getInventory->slug; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="col-form-label">Category</label>
                    <select class="form-control select2" name="category" id="category_edit">
                        <option></option>
                        <?php foreach ($getCategory as $row) : ?>
                            <option value="<?= $row->id; ?>" <?= $row->id == $getInventory->id_category ? "selected" : "" ?>><?= $row->title; ?></option>
                        <?php endforeach ?>
                    </select>
                    <span id="category_edit_error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <label for="exampleInputStockProduct">Stock</label>
                <input type="number" class="form-control" id="stock_edit" name="stock" placeholder="Stock" value="<?= $getInventory->stock; ?>">
                <span id="stock_edit_error"></span>
            </div>

            <div class="col-lg-4">
                <label for="exampleInputPriceProduct">Price</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Rp</span>
                    </div>
                    <input type="text" id="price_edit" name="price" class="form-control" placeholder="Price" aria-label="Price" aria-describedby="basic-addon1" value="<?= number_format($getInventory->price, 0, ',', '.'); ?>">

                </div>
                <span id="price_edit_error"></span>
            </div>
            <div class="col-lg-4">
                <label for="exampleInputPriceProduct">Purhcase Price</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Rp</span>
                    </div>
                    <input type="text" id="purchase_price_edit" name="purchase_price" class="form-control" placeholder="Purchase Price" aria-label="Username" aria-describedby="basic-addon1" value="<?= number_format($getInventory->purchase_price, 0, ',', '.'); ?>">

                </div>
                <span id="purchase_price_edit_error"></span>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12">
                <label for="exampleInputImageProduct">Image</label>
                <div class="wadah-image-product-edit mb-2 mt-2">
                    <?php if (isset($getInventory->image) || $getInventory->image != "") : ?>
                        <img src="<?= base_url("images/product/$getInventory->image"); ?>" class="img-thumbnail img-product" id="img-product">
                    <?php endif ?>
                </div>
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image_edit" name="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="image_product" id="image_product_edit" value="<?= $getInventory->image; ?>">
        <input type="hidden" name="image_product_temp" id="image_product_edit_temp" value="<?= $getInventory->image; ?>">






    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-rounded btn-hers">Update Data</button>
    </div>
</form>