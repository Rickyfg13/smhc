<div class="main-content-inner">
    <div class="row">

        <!-- Dark table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Inventory List</h4>
                    <div class="alert alert-info alert-dismissible mt-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h6><i class="fa fa-info mr-2 mb-2"></i><b>Info!</b></h6>
                        <span style="font-size: 15px;">You are logged in as an admin by selecting <b>The <?= getStoreName($this->session->userdata('id_store'))->name_store; ?> store</b>, all the items you're input will automatically go to that store.</span>
                    </div>
                    <div id="alertPlace">

                    </div>
                    <?php if ($this->session->userdata('role') == 'admin') : ?>
                        <button class="btn btn-rounded btn-hers btn-sm" id="btnTambahInventory" data-toggle="modal" data-target="#modalAddInventory"><i class="fa fa-plus mr-2"></i>Inventory</button>
                    <?php endif ?>

                    <form action="#" method="POST" id="formAddInventory">
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputTitleProduct">Title of Product</label>
                                    <input type="text" class="form-control" id="title" name="title" onkeyup="createSlug('#title')" aria-describedby="emailHelp" placeholder="Title Product">
                                    <span id="title_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputSlugProduct">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-form-label">Category</label>
                                    <select class="form-control select2" name="category" id="category">
                                        <option></option>
                                        <?php foreach ($category as $row) : ?>
                                            <option value="<?= $row->id; ?>"><?= $row->title; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <span id="category_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <label for="exampleInputStockProduct">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="0" readonly>
                                <span id="stock_error"></span>
                            </div>

                            <div class="col-lg-4">
                                <label for="exampleInputPriceProduct">Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                    </div>
                                    <input type="text" id="price" name="price" class="form-control" placeholder="Price" aria-label="Username" aria-describedby="basic-addon1">

                                </div>
                                <span id="price_error"></span>
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleInputPriceProduct">Purhcase Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                    </div>
                                    <input type="text" id="purchase_price" name="purchase_price" class="form-control" placeholder="Purchase Price" aria-label="Username" aria-describedby="basic-addon1">

                                </div>
                                <span id="purchase_price_error"></span>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <a href="#" class="addVariant mb-2" style="display: none;" data-toggle="modal" data-target="#modalAddVariant">Add Treatment Variants</a>
                                <div class="space-data-variant">
                                    
                                </div>

                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <label for="exampleInputImageProduct">Image</label>
                                <div class="wadah-image-product mb-2 mt-2">

                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="image_product" id="image_product">

                        <button type="submit" class="btn btn-rounded btn-hers mt-4 pr-4 pl-4 mb-4 float-right">Submit</button>
                        <button type="button" id="btnCancelTambahInventory" class="btn btn-rounded btn-light mt-4 pr-4 pl-4 mb-4 mr-3 float-right">Cancel</button>
                    </form>
                    <div class="tableInventory mt-2">

                        <div class="text-center">
                            <img src="<?= base_url("assets/images/load/load.svg"); ?>" style="width: 100px;" alt="load-animate">
                            <h6 class="mt-2">Please Wait...</h6>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Dark table end -->
    </div>
</div>

<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalImage">Unggah & Resize Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div id="image_demo" class="text-center mx-auto" style="width:350px; margin-top:30px;"></div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-rounded btn-purple crop_image" id="crop_image">Crop & Upload Image</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="uploadEditImageModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalImage">Unggah & Resize Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div id="image_demo_edit" class="text-center mx-auto" style="width:350px; margin-top:30px;"></div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-rounded btn-purple crop_image" id="crop_image_edit">Crop & Upload Image</button>
                </div>
            </div>
        </div>
    </div>
</div>