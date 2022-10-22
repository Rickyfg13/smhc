<form action="<?= base_url("admin/schedule/insert"); ?>" method="POST" id="formAddSchedule">
    <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class="modal-body">

        <input type="hidden" name="id" id="id_doctor" value="<?= $getDoctor->id; ?>">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="col-form-label">Store</label>
                    <select class="form-control select2" name="store" id="store_edit">
                        <option></option>
                        <?php foreach ($store as $row) : ?>
                            <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                        <?php endforeach ?>
                    </select>
                    <span id="store_error"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label class="col-form-label">Day</label>
            </div>
            <div class="col-3">
                <div class="s-sw-title">
                    <span>Monday</span>
                    <div class="s-swtich">

                        <input type="checkbox" id="switchMonday" value="Monday" name="day[]" />
                        <label for="switchMonday">Monday</label>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="s-sw-title">
                    <span>Tuesday</span>
                    <div class="s-swtich">
                        <input type="checkbox" id="switchTuesday" value="Tuesday" name="day[]" />
                        <label for="switchTuesday">Tuesday</label>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="s-sw-title">
                    <span>Wednesday</span>
                    <div class="s-swtich">
                        <input type="checkbox" id="switchWednesday" value="Wednesday" name="day[]" />
                        <label for="switchWednesday">Wednesday</label>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="s-sw-title">
                    <span>Thursday</span>
                    <div class="s-swtich">
                        <input type="checkbox" id="switchThursday" value="Thursday" name="day[]" />
                        <label for="switchThursday">Thursday</label>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="s-sw-title">
                    <span>Friday</span>
                    <div class="s-swtich">
                        <input type="checkbox" id="switchFriday" value="Friday" name="day[]" />
                        <label for="switchFriday">Friday</label>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="s-sw-title">
                    <span>Saturday</span>
                    <div class="s-swtich">
                        <input type="checkbox" id="switchSaturday" value="Saturday" name="day[]" />
                        <label for="switchSaturday">Saturday</label>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="s-sw-title">
                    <span>Sunday</span>
                    <div class="s-swtich">
                        <input type="checkbox" id="switchSunday" value="Sunday" name="day[]" />
                        <label for="switchSunday">Sunday</label>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2">
                <span id="day_error"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="start_time" class="col-form-label">Start Time</label>
                    <input class="form-control" type="time" name="start_time" value="13:45:00" id="start_time">
                    <span id="start_time_error"></span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="end_time" class="col-form-label">End Time</label>
                    <input class="form-control" type="time" name="end_time" value="13:45:00" id="end_time">
                    <span id="end_time_error"></span>
                </div>
            </div>

        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-rounded btn-hers">Add Schedule</button>
    </div>
</form>