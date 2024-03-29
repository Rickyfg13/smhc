<div class="main-content-inner">
    <div class="row">

        <!-- Dark table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Move Items</h4>
                    <div class="alert alert-info alert-dismissible mt-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h6><i class="fa fa-info mr-2 mb-2"></i><b>Info!</b></h6>
                        <span style="font-size: 15px;">You are logged in as an admin by selecting <b>The <?= getStoreName($this->session->userdata('id_store'))->name_store; ?> store</b>, all the stock items you're move will automatically go to that store.</span>
                    </div>
                    <div class="alert alert-warning alert-dismissible mt-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h6><i class="fa fa-exclamation-triangle mr-2 mb-2"></i><b>Warning!</b></h6>
                        <span style="font-size: 15px;">If your product is not available in this list, you can add some stocks in <b><a href="<?= base_url("admin/libraries/incoming-items"); ?>">"Incoming Items"</a></b> menu.</span>
                    </div>
                    <div id="alertPlace">

                    </div>
                    <!-- <button class="btn btn-rounded btn-sm btn-hers" id="btnMoveItems" data-toggle="modal" data-target="#modalMoveItems">Move Items</button> -->



                    <div class="tableMoveItems mt-2">

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