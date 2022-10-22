<form action="#" method="POST" id="formAddTherapist">
    <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class="modal-body">

        <input type="hidden" name="id" id="id_queue_therapist" value="<?= $id_queue; ?>">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="col-form-label">Therapist</label>
                    <select class="form-control select2" name="therapist" id="therapist">
                        <option></option>
                        <?php foreach ($therapist as $row) : ?>
                            <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                        <?php endforeach ?>
                    </select>
                    <span id="therapist_error"></span>

                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-rounded btn-hers addTherapist">Add Therapist</button>
    </div>
</form>