<div class="modal fade bd-example-modal-lg" id="modalAddVariant">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product Variant</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <button class="btn btn-xs btn-hers-primary btn-rounded mb-3" id="btnAddAnotherVariant"><i class="ti-plus mr-2"></i>Another Variant</button>
                <form action="#" method="POST" id="formAddVariant">
                    <div class="form-space">
                        <div class="row" id="">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title_variant">Title</label>
                                    <input type="text" class="form-control" name="title[]" id="title_variant" aria-describedby="emailHelp" placeholder="Title of Variant">
                                    <span id="title_variant_error"></span>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control price_variant" name="price[]" id="price_variant" placeholder="Price">
                                    <span id="price_variant_error"></span>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <label for="price">&nbsp;</label>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-rounded btn-hers">Add Variant</button>
            </div>
            </form>
        </div>
    </div>
</div>