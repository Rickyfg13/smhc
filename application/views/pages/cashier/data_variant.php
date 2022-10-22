<?php if (count($variant) > 0) : ?>
    <label for="" class="mt-2">Variant</label>
    <div class="row">

        <div class="col-12">
            <div class="btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-hers-primary-outline btn-xs btn-rounded btn-variant active" id="btnVariantDefault">
                    <input type="radio" name="options" id="option">Default
                </label>
                <?php $i = 1;
                foreach ($variant as $row) : ?>
                    <label class="btn btn-hers-primary-outline btn-xs btn-rounded btn-variant" data-price="<?= $row->price; ?>" data-id-variant="<?= $row->id; ?>">
                        <input type="radio" name="options" id="option<?= $i; ?>"><?= $row->title; ?>&nbsp;-&nbsp;Rp&nbsp;<?= number_format($row->price, 0, ',', '.') ?>,-
                    </label>
                <?php $i++;
                endforeach ?>
            </div>
        </div>



    </div>
<?php endif ?>