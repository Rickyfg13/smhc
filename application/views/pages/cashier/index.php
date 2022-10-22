<div class="main-content-inner">
    <div class="container-fluid">
        <div class="row">


            <!-- Statistics area start -->
            <div class="col-lg-8 col-md-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Treatment & Product Items</h4>
                        <div class="float-left mb-4">
                            <button class="btn btn-rounded btn-xs btn-hers-outline btnFilterTreatment" data-id="102001">Treatment</button>
                            <button class="btn btn-rounded btn-xs btn-hers-outline btnFilterProduct ml-3" data-id="102002">Product</button>
                            <button class="btn btn-rounded btn-xs btn-hers-outline btnBackToDefault ml-3">Back to Default</button>
                        </div>
                        <div class="float-right">
                            <input class="form-control search-items" id="searchItems" placeholder="Search...">
                        </div>
                        <!-- <div id="user-statistics"></div> -->
                        <div class="space_items">
                            <div class="row items">

                                <?php foreach ($product as $row) : ?>

                                    <div class="col-xl-3 col-md-3 hitung-item">
                                        <div class="card custom mb-3">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <img src="<?= !isset($row->image) || $row->image == "" ? base_url("images/product/default-product.png") : base_url("images/product/$row->image"); ?>" style="width: 200px; border-radius: 15px;" alt="">
                                                    <h5 class="card-title mt-3" style="font-size: 16px;"><?= $row->title; ?></h5>
                                                    <?php if ($row->id_category == '102002') : ?>
                                                        <p id="sisaStock<?= $row->id; ?>"><span>Stock : <?= $this->session->userdata('stock' . $row->id); ?></span></p>
                                                    <?php endif ?>
                                                    <p class="card-text">Rp&nbsp;<?= number_format($row->price, 0, ',', '.') ?>,-</p>
                                                    <div class="button<?= $row->id; ?>">
                                                        <button class="btn btn-rounded btn-xs btn-hers btnAddToCart" id="btnAddToCart" style="margin-top: -15px;" data-category="<?= $row->id_category; ?>" data-id="<?= $row->id; ?>" data-price="<?= $row->price; ?>" data-title="<?= $row->title; ?>" data-stock="<?= $this->session->userdata('stock' . $row->id); ?>" data-purchase-price="<?= $row->purchase_price; ?>"><i class="fa fa-cart-plus fa-lg mr-2"></i>Add to Cart</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                                <div class="mx-auto">
                                    <button class="btn btn-xs btn-rounded btn-hers-primary w-100 mt-3 pl-5 pr-5" id="btnLoadMoreData" style="font-size: 16px;" data-page="2">
                                        <span style="font-weight: 700;">Load Data</span><img src="<?= base_url("assets/images/load/three-dots.svg") ?>" alt="" style="width: 40px; display:none;">
                                    </button>
                                </div>




                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- Statistics area end -->
            <!-- Advertising area start -->
            <div class="col-lg-4 col-md-6 mt-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2">
                                <!-- <img src="<?= base_url("assets/images/icon/user.svg"); ?>" id="newCustomer" class="img-fluid" data-toggle="modal" data-target="#modalCustomer"> -->
                                <button class="btn btn-hers-primary btn-xs btn-rounded" id="newCustomer" data-toggle="modal" data-target="#modalCustomer"><i class="ti-user"></i></button>
                            </div>
                            <div class="col-6">
                                <div class="mt-2 d-flex customer-space">
                                    <h6 class="customer-name-space" style="font-size: 13.5px;">New Customer</h6>

                                </div>
                                <input type="hidden" class="customer-id-space" value="">
                                <input type="hidden" class="customer-phone" value="">
                                <input type="hidden" class="status_pay" value="0">
                                <input type="hidden" id="id_queue_val" value="">
                            </div>

                            <div class="col-4 text-right">
                                <button class="btn btn-hers-primary btn-xs btn-rounded btn-block" id="btnEditTransaction"><i class="ti-view-list mr-2"></i>List Transactions</button>
                            </div>


                        </div>

                    </div>
                    <div class="card-body">

                        <div class="d-flex">
                        </div>
                        <h4 class="header-title">Detail Transactions (<span id="number_invoice"></span>)</h4>

                        <div class="d-flex justify-content-between mb-3">
                            <button class="btn btn-xs btn-success btn-rounded" id="btnSendInvoiceWa"><i class="fa fa-whatsapp mr-2"></i>Send Invoice</button>
                            <button type="button" class="btn btn-sm btn-rounded btn-hers" id="btnReset"><i class="fa fa-plus mr-2"></i>New Transaction</button>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="itemCode" placeholder="Item Code" style="border-radius: 33px;" autofocus>
                            </div>

                        </div>
                        <div id="result-cart">
                            <h1 class="text-hers mb-4" style="text-align: right;">Rp&nbsp;<?= number_format($totalCart, 0, ',', '.') ?>,-</h1>

                            <?php if (count($cart) > 0) : ?>
                                <div id="table-cart">
                                    <table class="table">

                                        <tbody>

                                            <?php $i = 1;
                                            foreach ($cart as $row) : ?>

                                                <tr>

                                                    <td><?= $row['name']; ?>&nbsp;(<?= $row['qty']; ?>x)</td>

                                                    <td style="text-align: right;"><?= number_format($row['subtotal'], 0, ',', '.') ?>,-</td>
                                                </tr>


                                            <?php endforeach ?>
                                            <tr>
                                                <td>Subtotal</td>
                                                <td style="text-align: right;"></td>
                                            </tr>
                                            <tr>
                                                <td>Discount Total</td>
                                                <td style="text-align: right;"></td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td style="text-align: right;"></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            <?php else : ?>
                                <div class="text-center">
                                    <i class="ti-shopping-cart" style="font-size: 100px; color: var(--secondary-color)"></i>
                                    <p class="mt-2" style="margin-bottom: 200px; color: var(--primary-color)">Please Add The Item First!</p>
                                </div>
                            <?php endif ?>



                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Cash Payment</td>
                                    <td class="text-right"><span id="cash_payment_val"></span></td>
                                </tr>
                                <tr>
                                    <td>Money Change</td>
                                    <td class="text-right"><span id="money_change_val"></span></td>
                                </tr>
                                <tr>

                                </tr>
                            </tbody>

                        </table>
                        <div class="frame_space">


                        </div>
                        <button type="button" class="btn btn-rounded btn-hers" id="btnPrint" onclick="frames['struk'].print()" style="display: none;">Print</button>
                        <?php if (count($cart) > 0) : ?>
                            <div class="text-center">
                                <button class="btn btn-rounded btn-hers mt-3" id="btnPay" style="width: 100%;" data-toggle="modal" data-target="#modalPay">Charge</button>
                            </div>
                        <?php else : ?>
                            <div class="text-center">
                                <button class="btn btn-rounded btn-hers mt-3" id="btnPay" style="width: 100%;" data-toggle="modal" data-target="#modalPay" disabled>Charge</button>
                            </div>
                        <?php endif ?>




                        <!-- <div class="mx-auto">
                            <div class="mt-5">
                                <ul id="keyboard">
                                    <li class="letter">7</li>
                                    <li class="letter">8</li>
                                    <li class="letter">9</li>
                                    <li class="letter clearl">4</li>
                                    <li class="letter">5</li>
                                    <li class="letter">6</li>

                                    <li class="letter clearl">1</li>
                                    <li class="letter ">2</li>
                                    <li class="letter">3</li>
                                    <li class="letter">0</li>
                                    <li class="switch">abc</li>
                                    <li class="return">retur</li>
                                    <li class="delete lastitem"></li>
                                </ul>
                            </div>
                        </div> -->


                    </div>
                </div>
            </div>
            <!-- Advertising area end -->




        </div>
    </div>
</div>