<div class="modal fade bd-example-modal-lg" id="modalAddDiscount">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Discount Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">

                <form action="#" method="POST" id="formAddDiscount">
                    <div class="form-group">
                        <label for="title_discount">Title of Discount</label>
                        <input type="text" class="form-control" name="title_discount" id="title_discount" aria-describedby="emailHelp" placeholder="Title of Discount">
                        <span id="title_discount_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="value">Value</label>
                        <input type="number" class="form-control" name="value" id="value" step="0.5" aria-describedby="emailHelp" placeholder="Numeric Input">
                        <span id="value_error"></span>
                    </div>

                    <div id="dateArea">
                        <div class="input-daterange">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tgl_start">Start From</label>
                                        <input type="text" class="form-control datetime" name="tgl_start" id="tgl_start" aria-describedby="emailHelp" placeholder="dd/mm/YYYY" autocomplete="off">
                                        <span id="tgl_start_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tgl_end">End Period</label>
                                        <input type="text" class="form-control datetime" name="tgl_end" id="tgl_end" aria-describedby="emailHelp" placeholder="dd/mm/YYYY" autocomplete="off">
                                        <span id="tgl_end_error"></span>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-secondary" id="tesss" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-rounded btn-hers">Add Data</button>
            </div>
            </form>
        </div>
    </div>
</div>