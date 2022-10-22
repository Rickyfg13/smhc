<?php foreach ($product as $row) : ?>
    <div class="col-xl-3 col-md-3 hitung-item">
        <div class="card custom mb-3">
            <div class="card-body">
                <div class="text-center">
                    <img src="<?= !isset($row->image) || $row->image == "" ? base_url("images/product/default-product.png") : base_url("images/product/$row->image"); ?>" style="width: 200px;" alt="">
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

<div class="mx-auto button-load-data-space">
    <button class="btn btn-xs btn-rounded btn-hers-primary w-100 mt-3 pl-5 pr-5" id="btnLoadMoreData" style="font-size: 16px; border-radius: 15px;" data-page="2" data-category="<?= $category; ?>">
        <span style="font-weight: 700;">Load Data</span><img src="<?= base_url("assets/images/load/three-dots.svg") ?>" alt="" style="width: 40px; display:none;">
    </button>
</div>