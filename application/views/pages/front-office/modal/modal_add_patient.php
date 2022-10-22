<div class="modal fade bd-example-modal-lg" id="modalAddPatient">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title titleModalAddPatient">Add Patient Data Form</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="#" method="POST" id="formAddPatient">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name_patient">Name</label>
                                <input type="text" class="form-control" name="name" id="name_patient" aria-describedby="emailHelp" placeholder="Patient Name">
                                <span id="name_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nickname_patient">Nickname</label>
                                <input type="text" class="form-control" name="nickname" id="nickname_patient" aria-describedby="emailHelp" placeholder="Patient Nick Name">
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="birth_date_patient">Birth of Date</label>
                                <input type="text" class="form-control date_birth" name="birth_date" id="birth_date_patient" aria-describedby="emailHelp" placeholder="dd/mm/yyyy" autocomplete="off">
                                <span id="birth_date_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="identity_number_patient">Identity Number (KTP)</label>
                                <input type="text" class="form-control" name="identity_number" id="identity_number_patient" aria-describedby="emailHelp" placeholder="ex: 137106......">
                                <span id="identity_number_error"></span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone_patient">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone_patient" aria-describedby="emailHelp" placeholder="Phone Number">
                                <span id="phone_error"></span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="email_patient">Email</label>
                                <input type="email" class="form-control" name="email" id="email_patient" aria-describedby="emailHelp" placeholder="Email Address">
                                <span id="email_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="job_patient">Job</label>
                                <input type="text" class="form-control" name="job" id="job_patient" aria-describedby="emailHelp" placeholder="Job">
                                <span id="job_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address_patient">Address</label>
                                <textarea class="form-control" name="address" id="address_patient" rows="3" placeholder="Address"></textarea>
                                <span id="address_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="previous_skincare">Previous Skincare</label>
                                <input type="text" class="form-control" name="previous_skincare" id="previous_skincare" aria-describedby="emailHelp" placeholder="Previous Skincare">
                                
                            </div>
                        </div>
                    </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-rounded btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="submit" class="btn btn-sm btn-rounded btn-purple btn-pay">Pay</button> -->
                <button type="submit" class="btn btn-sm btn-rounded btn-hers">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>