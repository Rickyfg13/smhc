<div class="modal-header">
    <h5 class="modal-title"><?= $getDoctor->name; ?></h5>
    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table id="tableViewDoctorSchedule" class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Day</th>
                    <th scope="col">Store</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedule as $row) : ?>
                    <tr>
                        <td><?= $row->day_name; ?></td>
                        <td><?= $row->name; ?></td>
                        <td><?= date_format(new DateTime($row->times_start), 'H:i'); ?></td>
                        <td><?= date_format(new DateTime($row->times_end), 'H:i'); ?></td>
                    </tr>
                
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
</div>