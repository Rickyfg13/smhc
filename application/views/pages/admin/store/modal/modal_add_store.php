<div class="modal fade bd-example-modal-lg" id="modalAddStore">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Store Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formAddStore">
                    <div class="form-group">
                        <label for="store_name">Name</label>
                        <input type="text" class="form-control" name="store_name" id="store_name" placeholder="Store Name" autocomplete="off">
                        <span id="store_name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="store_phone">Phone</label>
                        <input type="text" class="form-control" name="store_phone" id="store_phone" placeholder="Store Phone" autocomplete="off">
                        <span id="store_phone_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="store_address">Address</label>
                        <textarea class="form-control" name="store_address" id="store_address" rows="3" placeholder="Store Address" autocomplete="off"></textarea>
                        <span id="store_address_error"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-rounded btn-hers">Add Data</button>
            </div>
            </form>
        </div>
    </div>
</div>