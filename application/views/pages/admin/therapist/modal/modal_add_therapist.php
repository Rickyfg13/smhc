<div class="modal fade bd-example-modal-lg" id="modalAddTherapist">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Therapist Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">

                <form action="#" method="POST" id="formAddTherapist">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name_therapist">Therapist Name</label>
                                <input type="text" class="form-control" name="name" id="name_therapist" aria-describedby="emailHelp" placeholder="Therapist Name">
                                <span id="name_therapist_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="birth_date_therapist">Birth of Date</label>
                                <input type="text" class="form-control date_birth_therapist" name="birth_date" id="birth_date_therapist" aria-describedby="emailHelp" placeholder="dd/mm/yyyy" autocomplete="off">
                                <span id="birth_date_therapist_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="identity_number_therapist">Identity Number (KTP)</label>
                                <input type="text" class="form-control" name="identity_number" id="identity_number_therapist" aria-describedby="emailHelp" placeholder="ex: 137106......">
                                <span id="identity_number_therapist_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone_therapist">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone_therapist" aria-describedby="emailHelp" placeholder="Phone Number">
                                <span id="phone_therapist_error"></span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="email_therapist">Email</label>
                                <input type="email" class="form-control" name="email" id="email_therapist" aria-describedby="emailHelp" placeholder="Email Address">
                                <span id="email_therapist_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address_therapist">Address</label>
                                <textarea class="form-control" name="address" id="address_therapist" rows="3" placeholder="Address"></textarea>
                                <span id="address_therapist_error"></span>
                            </div>
                        </div>
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