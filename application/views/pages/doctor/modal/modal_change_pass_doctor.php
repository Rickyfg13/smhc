<form action="#" method="POST" id="formChangePassDoctor">
    <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class="modal-body">

        <div class="change-pass-doctor-space">
            <div class="alert-space">
                <?php $this->load->view('layouts/_alert'); ?>
            </div>
            <input type="hidden" name="id_doctor" id="id_doctor" value="<?= $id_doctor; ?>">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="old_password">Old Password</label>
                        <input type="password" class="form-control" name="old_password" id="old_password" aria-describedby="oldPassword" placeholder="" value="">
                        <span class="p-viewer" id="old_pass_viewer">
                            <i class="fa fa-eye fa-lg"></i>
                        </span>
                        <span id="old_password_error"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" name="new_password" id="new_password" aria-describedby="newPassword" placeholder="" value="">
                        <span class="p-viewer" id="new_pass_viewer">
                            <i class="fa fa-eye fa-lg"></i>
                        </span>
                        <span id="new_password_error"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="confirm_password">Confirm Your Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" aria-describedby="oldPassword" placeholder="" value="">
                        <span class="p-viewer" id="confirm_pass_viewer">
                            <i class="fa fa-eye fa-lg"></i>
                        </span>
                        <span id="confirm_password_error"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-rounded btn-hers btn-submit-change-pass-doctor">Change Password</button>
    </div>
</form>