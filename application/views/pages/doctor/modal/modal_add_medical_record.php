<div class="modal fade bd-example-modal-lg" id="modalAddMedicalRecord" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title titleModalAddMedicalRecord">Add Medical Record Form</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formAddMedicalRecord">

                    <input type="hidden" name="id_customer" id="id_customer_rm" value="">
                    <input type="hidden" name="id_queue" id="id_queue" value="">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="anamnesa">Anamnesa</label>
                                <textarea class="form-control" name="anamnesa" id="anamnesa" rows="3" placeholder="Anamnesa"></textarea>
                                <span id="anamnesa_error"></span>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="diagnosa">Diagnosa</label>
                                <textarea class="form-control" name="diagnosa" id="diagnosa" rows="3" placeholder="Diagnosa"></textarea>
                                <span id="diagnosa_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="selectTherapy">
                                <div class="form-group">
                                    <label for="therapy">Therapy</label>
                                    <select name="therapy[]" id="therapy" class="form-control select2" multiple="multiple">
                                        <option></option>
                                        <?php foreach ($dataTherapy as $row) : ?>
                                            <option value="<?= $row->id; ?>"><?= $row->title; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <span id="therapy_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="">Product</label>
                            <br>
                            <a href="#" id="showProduct" data-toggle="modal" data-target="#modalProduct">Select product for this patient.</a>
                            <div class="resultProduct mt-2" id="">
                                <!-- <span class="badge badge-dark" style="font-size: 14px;"><i class="fa fa-times mr-2" style="font-size: 14px;"></i>tes</span> -->

                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label for="note">Note's Therapy (Optional)</label>
                                <textarea class="form-control" name="note" id="note" rows="3" placeholder="Note"></textarea>

                            </div>
                        </div>
                    </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-rounded btn-secondary btn-close-medical-record" data-dismiss="modal">Close</button>
                <!-- <button type="submit" class="btn btn-sm btn-rounded btn-purple btn-pay">Pay</button> -->
                <button type="submit" class="btn btn-sm btn-rounded btn-hers btn-submit-medical-record">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>