<form action="#" method="POST" id="formEditPatient">
    <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class="modal-body">

        <input type="hidden" name="id" id="id_customer" value="<?= $getCustomer->id; ?>">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="name_patient_edit">Name</label>
                    <input type="text" class="form-control" name="name" id="name_patient_edit" aria-describedby="emailHelp" placeholder="Patient Name" value="<?= $getCustomer->name; ?>">
                    <span id="name_edit_error"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="nickname_patient_edit">Nickname</label>
                    <input type="text" class="form-control" name="nickname" id="nickname_patient_edit" aria-describedby="emailHelp" placeholder="Patient Nick Name" value="<?= $getCustomer->nickname; ?>">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="birth_date_patient_edit">Birth of Date</label>
                    <input type="text" class="form-control date_birth_edit" name="birth_date" id="birth_date_patient_edit" aria-describedby="emailHelp" placeholder="dd/mm/yyyy" autocomplete="off" value="<?= date_format(new DateTime($getCustomer->birth_date), 'd/m/Y'); ?>">
                    <span id="birth_date_edit_error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="identity_number_patient_edit">Identity Number (KTP)</label>
                    <input type="text" class="form-control" name="identity_number" id="identity_number_patient_edit" aria-describedby="emailHelp" placeholder="ex: 137106......" value="<?= $getCustomer->identity_number; ?>">
                    <span id="identity_number_edit_error"></span>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="phone_patient_edit">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone_patient_edit" aria-describedby="emailHelp" placeholder="Phone Number" value="<?= $getCustomer->phone; ?>">
                    <span id="phone_edit_error"></span>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="email_patient_edit">Email</label>
                    <input type="email" class="form-control" name="email" id="email_patient_edit" aria-describedby="emailHelp" placeholder="Email Address" value="<?= $getCustomer->email; ?>">
                    <span id="email_edit_error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="job_patient_edit">Job</label>
                    <input type="text" class="form-control" name="job" id="job_patient_edit" aria-describedby="emailHelp" placeholder="Job" value="<?= $getCustomer->job; ?>">
                    <span id="job_edit_error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="address_patient_edit">Address</label>
                    <textarea class="form-control" name="address" id="address_patient_edit" rows="3" placeholder="Address"><?= $getCustomer->address; ?></textarea>
                    <span id="address_edit_error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="previous_skincare_edit">Previous Skincare</label>
                    <input type="text" class="form-control" name="previous_skincare" id="previous_skincare_edit" aria-describedby="emailHelp" placeholder="Previous Skincare" value="<?= $getCustomer->previous_skincare; ?>">

                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-rounded btn-hers btnUpdatePatient">Update Data</button>
    </div>
</form>