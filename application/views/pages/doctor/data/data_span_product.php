<?php if (count($product) > 0) : ?>
    <?php foreach ($product as $row) : ?>
        <span class="badge badge-dark" style="font-size: 14px;"><i class="fa fa-times mr-2" id="destroyProduct" data-id="<?= $row->id; ?>" style="font-size: 14px;"></i><?= $row->title; ?></span>
    <?php endforeach ?>
<?php endif ?>