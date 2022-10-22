<form action="#" method="POST" id="formEditDiscount">
    <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class="modal-body">

        <input type="hidden" name="id" id="id_discount" value="<?= $getDiscount->id; ?>">
        <div class="form-group">
            <label for="title_discount">Title of Discount</label>
            <input type="text" class="form-control" name="title_discount" id="title_discount" aria-describedby="emailHelp" placeholder="Title of Discount" value="<?= $getDiscount->title_discount; ?>">
            <span id="title_discount_error"></span>
        </div>
        <div class="form-group">
            <label for="value">Value</label>
            <input type="number" class="form-control" name="value" id="value" aria-describedby="emailHelp" step="0.5" placeholder="Numeric Input" value="<?= $getDiscount->value; ?>">
            <span id="value_error"></span>
        </div>

        <div id="dateArea">
            <div class="input-daterange">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tgl_start">Start From</label>
                            <input type="text" class="form-control datetime" name="tgl_start" id="tgl_start" aria-describedby="emailHelp" placeholder="dd/mm/YYYY" autocomplete="off" value="<?= date_format(new DateTime($getDiscount->tgl_start), 'd/m/Y'); ?>">
                            <span id="tgl_start_error"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tgl_end">End Period</label>
                            <input type="text" class="form-control datetime" name="tgl_end" id="tgl_end" aria-describedby="emailHelp" placeholder="dd/mm/YYYY" autocomplete="off" value="<?= date_format(new DateTime($getDiscount->tgl_end), 'd/m/Y'); ?>">
                            <span id="tgl_end_error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-rounded btn-secondary" id="tesss" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-rounded btn-primary">Update Data</button>
    </div>
</form>