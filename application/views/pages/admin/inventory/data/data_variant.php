<button type="button" class="btn btn-xs btn-hers-primary btn-rounded mt-2" id="btnClearVariant">
    <i class="fa fa-trash mr-2"></i>Clear Variant
</button>
<table class="table table-sm mt-3 w-50 data-variant-table">
    <tbody>
        <?php if ($this->session->has_userdata('data_variant')) :  ?>
            <?php foreach ($this->session->userdata('data_variant') as $data) : ?>
                <tr>
                    <td><?= $data['title']; ?></td>
                    <td>Rp&nbsp;<?= number_format($data['price'], 0, ',', '.') ?>,-</td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>