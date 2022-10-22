<form action="#" method="POST" id="formEditStore">
    <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class="modal-body">

        <input type="hidden" name="id" id="id_store" value="<?= $getStore->id; ?>">
        <div class="form-group">
            <label for="store_name">Name</label>
            <input type="text" class="form-control" name="store_name" id="store_name" placeholder="Store Name" value="<?= $getStore->name; ?>" autocomplete="off">
            <span id="store_name_error"></span>
        </div>

        <div class="form-group">
            <label for="store_phone">Phone</label>
            <input type="text" class="form-control" name="store_phone" id="store_phone" placeholder="Store Phone" value="<?= $getStore->phone; ?>" autocomplete="off">
            <span id="store_phone_error"></span>
        </div>

        <div class="form-group">
            <label for="store_address">Address</label>
            <textarea class="form-control" name="store_address" id="store_address" rows="3" placeholder="Store Address" autocomplete="off"><?= $getStore->address; ?></textarea>
            <span id="store_address_error"></span>
        </div>



    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-rounded btn-hers">Update Data</button>
    </div>
</form>