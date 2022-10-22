<div class="main-content-inner">
    <div class="row">

        <!-- Dark table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Items Sales (<?= getStoreName($this->session->userdata('id_store'))->name_store;  ?>)</h4>
                    <div id="alertPlace">

                    </div>
                   
                    <div class="tableProductOut mt-2">

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
