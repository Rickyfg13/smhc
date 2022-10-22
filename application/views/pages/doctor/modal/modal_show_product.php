<div class="modal fade bd-example-modal-lg" id="modalProduct">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title titleModalProduct"></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right">
                            <input class="form-control search-items" id="searchProduct" placeholder="Search...">
                        </div>
                    </div>
                </div>
                <div class="products-data mt-3">
                    <div class="text-center">
                        <img src="<?= base_url("assets/images/load/load.svg") ?>" style="width: 100px;">
                        <h6>Please Wait...</h6>
                    </div>

                    


                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-rounded btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-rounded btn-hers" id="btnAddProduct">Add Product</button>
            </div>

        </div>
    </div>
</div>