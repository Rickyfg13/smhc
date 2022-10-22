<form action="#" method="POST" id="formEditTherapist">
    <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class="modal-body">
        <input type="hidden" name="id" value="<?= $getTherapist->id; ?>">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="name_therapist_edit">Therapist Name</label>
                    <input type="text" class="form-control" name="name" id="name_therapist_edit" aria-describedby="emailHelp" placeholder="Therapist Name" value="<?= $getTherapist->name; ?>">
                    <span id="name_therapist_edit_error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="birth_date_therapist_edit">Birth of Date</label>
                    <input type="text" class="form-control date_birth_therapist_edit" name="birth_date" id="birth_date_therapist_edit" aria-describedby="emailHelp" placeholder="dd/mm/yyyy" autocomplete="off" value="<?= date_format(new DateTime($getTherapist->birth_date), "d/m/Y"); ?>">
                    <span id="birth_date_therapist_edit_error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="identity_number_therapist_edit">Identity Number (KTP)</label>
                    <input type="text" class="form-control" name="identity_number" id="identity_number_therapist_edit" aria-describedby="emailHelp" placeholder="ex: 137106......" value="<?= $getTherapist->identity_number; ?>">
                    <span id="identity_number_therapist_edit_error"></span>
                </div>
            </div>

           
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="phone_therapist_edit">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone_therapist_edit" aria-describedby="emailHelp" placeholder="Phone Number" value="<?= $getTherapist->phone; ?>">
                    <span id="phone_therapist_edit_error"></span>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="email_therapist_edit">Email</label>
                    <input type="email" class="form-control" name="email" id="email_therapist_edit" aria-describedby="emailHelp" placeholder="Email Address" value="<?= $getTherapist->email; ?>">
                    <span id="email_therapist_edit_error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="address_therapist_edit">Address</label>
                    <textarea class="form-control" name="address" id="address_therapist_edit" rows="3" placeholder="Address"><?= $getTherapist->address; ?></textarea>
                    <span id="address_therapist_edit_error"></span>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-rounded btn-hers">Update Data</button>
    </div>
</form>