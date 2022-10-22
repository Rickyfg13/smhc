<form action="#" method="POST" id="formProfileDoctor">
    <?php $this->load->view('layouts/_alert'); ?>
    <input type="hidden" name="id" id="id_doctor" value="<?= $getDoctor->id; ?>">
    <div class="row">
        <div class="col-6">
            <label for="exampleInputPriceProduct" style="margin-top: .38rem;">Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">dr</span>
                </div>
                <input type="text" id="name_doctor" name="name" class="form-control" placeholder="Doctor Name" aria-label="DoctorName" aria-describedby="basic-addon1" value="<?= substr($getDoctor->name, 2); ?>" disabled>
                <span id="name_error"></span>

            </div>

        </div>
        <div class="col-6">
            <div class="form-group mt-0">
                <label for="birth_date_doctor" class="col-form-label">Birth of Date</label>
                <input class="form-control" name="birth_date" type="date" value="<?= $getDoctor->birth_date; ?>" id="birth_date_doctor" disabled>
                <span id="birth_date_error"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="identity_number_doctor_edit">Identity Number (KTP)</label>
                <input type="text" class="form-control" name="identity_number" id="identity_number_doctor" aria-describedby="emailHelp" placeholder="ex: 137106......" value="<?= $getDoctor->identity_number; ?>" disabled>
                <span id="identity_number_error"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="idi_number_doctor_edit">IDI Number</label>
                <input type="text" class="form-control" name="idi_number" id="idi_number_doctor" aria-describedby="emailHelp" placeholder="IDI Number" value="<?= $getDoctor->idi_number; ?>" disabled>
                <span id="idi_number_error"></span>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="sip_number_doctor_edit">SIP Number</label>
                <input type="text" class="form-control" name="sip_number" id="sip_number_doctor" aria-describedby="emailHelp" placeholder="SIP Number" value="<?= $getDoctor->sip_number; ?>" disabled>
                <span id="sip_number_error"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="phone_doctor">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone_doctor" aria-describedby="emailHelp" placeholder="Phone Number" value="<?= $getDoctor->phone; ?>" disabled>
                <span id="phone_error"></span>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="email_doctor">Email</label>
                <input type="email" class="form-control" name="email" id="email_doctor" aria-describedby="emailHelp" placeholder="Email Address" value="<?= $getDoctor->email; ?>" disabled>
                <span id="email_error"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="address_doctor">Address</label>
                <textarea class="form-control" name="address" id="address_doctor" rows="3" placeholder="Address" disabled><?= $getDoctor->address; ?></textarea>
                <span id="address_error"></span>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-xs btn-rounded btn-hers btn-submit-profile-doctor" style="display: none;">Update Profile</button>
</form>