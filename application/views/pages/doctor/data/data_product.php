<?php 
$products = $this->session->userdata('products'); 

if($products) {
    foreach($products as $item) {
        $data[$item->id_product] = $item->qty;
    }
}

?>
<div class="row items">
    <?php foreach ($product as $row) :  ?>
        <div class="col-xl-3 col-md-4 hitung-item">
            <div class="card custom mb-3" data-id="<?= $row->id; ?>">
                <div class="card-body product 
                
                <?php if ($products) : ?>
                    <?php foreach ($products as $product) : ?>
                        <?= $product->id_product == $row->id ? "selected" : "" ?>
                    <?php endforeach ?>
                <?php endif ?>
                " id="product_<?= $row->id; ?>" data-id="<?= $row->id; ?>">
                    <div class="text-center">
                        <img src="<?= base_url("images/product/default-product.png") ?>" class="img-fluid" style="width: 200px; border-radius: 15px;" alt="">
                        <h5 class="card-title mt-3" style="font-size: 13px;"><?= $row->title; ?></h5>

                    </div>

                </div>
                <div class="card-footer custom">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm product-qty
                        <?php if ($products) : ?>
                            <?php foreach ($products as $product) : ?>
                                <?= $product->id_product == $row->id ? "select_qty" : "" ?>
                            <?php endforeach ?>
                        <?php endif ?>
                        " name="qty_product" id="qty_product_<?= $row->id; ?>" value="<?= isset($data[$row->id]) ? $data[$row->id] : "1"; ?>" data-id="<?= $row->id; ?>" style="text-align: center;" aria-describedby="emailHelp">

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>



    <div class="mx-auto">
        <button class="btn btn-xs btn-rounded btn-hers-primary w-100 pl-5 pr-5" id="btnLoadMoreData" style="font-size: 12px;" data-page="1">
            <span style="font-weight: 700;">Load Data</span><img src="<?= base_url("assets/images/load/three-dots.svg") ?>" alt="" style="width: 40px; display:none;">
        </button>
    </div>
</div>
<div class="row mt-2">

</div>