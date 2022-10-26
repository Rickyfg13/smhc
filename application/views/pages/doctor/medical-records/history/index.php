<div class="main-content-inner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <h4 class="header-title">List of Patients</h4>
                        <table class="table table-striped" id="patients">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>No RM</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($patients as $row) : ?>
                                    <tr>
                                        <td><?= $row->id; ?></td>
                                        <td><?= substr($row->id, 1) ?></td>
                                        <td><?= $row->name; ?></td>
                                        <td><?= $row->address; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-outline-primary btn-xs" href="<?= base_url("doctor/medicalrecord/print_detail/") . $row->id; ?>" target="_blank">Print</a>
                                                <a href="<?= base_url("doctor/medicalrecord/detail/") . $row->id; ?>" class="btn btn-outline-warning btn-xs" id="detailPatient">Detail</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <!-- <select id="selectPatientsMedicalRecords" class="form-control form-control-sm">
                            <option></option>
                            <?php foreach ($patients as $row) : ?>
                                <option value="<?= $row->id ?>"><?= $row->id ?>&nbsp;-&nbsp;<?= $row->name; ?></option>
                            <?php endforeach ?>
                        </select> -->


                        <!-- <div class="tablePatientsMedicalRecordsHistory" style="margin-top: 70px !important;">
                            <div class="data-tables datatable mt-4">
                                <table id="dataTablePatientsMedicalRecordsHistory" class="text-center table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>





        </div>
    </div>


</div>