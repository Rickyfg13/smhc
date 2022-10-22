<!-- hitung umur -->
<?php


$birthDate = new DateTime($patients->birth_date);
$today = new DateTime();

if ($birthDate < $today) {
    $umur = $today->diff($birthDate)->y;
}

?>




<!-- <div class="text-right">
    <button class="btn btn-rounded btn-sm btn-hers-primary" id="btnPrintMedicalRecord"><i class="ti-printer mr-2"></i>Print</button>
    <button class="btn btn-rounded btn-sm btn-hers" id="btnViewPatientTransactionInMedicalRecord" data-id-customer="<?= $patient->id; ?>"><i class="ti-bag mr-2"></i>View Transaction</button>
</div> -->
<div class="text-center mt-4">
    <h3>Medical Record</h3>
</div>
<!-- 
<div class="data-patient mt-5">
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <td>Name</td>
                <td>:</td>
                <td><?= $patient->name; ?></td>
                <td>No RM</td>
                <td>:</td>
                <td><?= isset($noRm->id) ? substr($noRm->id, 1) : "-"; ?></td>
            </tr>
            <tr>
                <td>Nick Name</td>
                <td>:</td>
                <td><?= $patient->nickname == "" ? "-" : $patient->nickname; ?></td>
                <td>Address</td>
                <td>:</td>
                <td><?= $patient->address; ?></td>

            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?= strtolower($patient->email); ?></td>
                <td>DoB/Age</td>
                <td>:</td>
                <td><?= $umur; ?>&nbsp;Years Old</td>

            </tr>
            <tr>
                <td>Job</td>
                <td>:</td>
                <td><?= ucwords($patient->job); ?></td>
                <td>KTP</td>
                <td>:</td>
                <td><?= $patient->identity_number; ?></td>
            </tr>
            <tr>
                <td>Phone/WA</td>
                <td>:</td>
                <td><?= $patient->phone; ?></td>
                <td>Previous Skincare</td>
                <td>:</td>
                <td><?= $patient->previous_skincare; ?></td>
            </tr>
        </table>
    </div>
</div> -->
<!-- 
<div class="data-tables datatable mt-5">
    <table id="dataTablePatientsMedicalRecordsHistory" class="text-center table table-hover">
        <thead>
            <tr>
                <th>Date</th>
                <th>Anamnese</th>
                <th>Diagnose</th>
                <th>Therapy</th>
                <th>Products</th>
                <th>Note</th>
                <th>Doctor</th>
                <th>Clinic</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($getPatients as $row) : ?>
                <tr>
                    <td><?= date_format(new DateTime($row->created_at), 'd/m/Y') ?></td>
                    <td><?= $row->anamnesa; ?></td>
                    <td><?= $row->diagnosa; ?></td>
                   
                    <td>
                        <?php foreach ($therapies[$row->id_therapies] as $row2) : ?>
                            <span class="badge badge-pill badge-info" style="font-size: 13px;"><?= $row2->title; ?></span>
                        <?php endforeach ?>
                    </td>
                    <td>
                        <?php foreach ($items[$row->id_items] as $data) : ?>
                            <span class="badge badge-pill badge-warning" style="font-size: 13px;"><?= $data->title; ?></span>
                        <?php endforeach ?>
                    </td>
                    <td>
                        <?= $row->note == "" || $row->note == null ? "" : $row->note; ?>
                    </td>
                    <th><?= $row->doctor_name; ?></th>
                    <td><?= $row->store_name; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div> -->

<table class="table table-striped" id="patients">
    <thead>
        <tr>
            <th>Date</th>
            <th>Anamnese</th>
            <th>Diagnose</th>
            <th>Therapy</th>
            <th>Products</th>
            <th>Note</th>
            <th>Doctor</th>
            <th>Clinic</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($getPatients as $row) : ?>
            <tr>
                <td><?= date_format(new DateTime($row->created_at), 'd/m/Y') ?></td>
                <td><?= $row->anamnesa; ?></td>
                <td><?= $row->diagnosa; ?></td>

                <td>
                    <?php foreach ($therapies[$row->id_therapies] as $row2) : ?>
                        <span class="badge badge-pill badge-info" style="font-size: 13px;"><?= $row2->title; ?></span>
                    <?php endforeach ?>
                </td>
                <td>
                    <?php foreach ($items[$row->id_items] as $data) : ?>
                        <span class="badge badge-pill badge-warning" style="font-size: 13px;"><?= $data->title; ?></span>
                    <?php endforeach ?>
                </td>
                <td>
                    <?= $row->note == "" || $row->note == null ? "" : $row->note; ?>
                </td>
                <th><?= $row->doctor_name; ?></th>
                <td><?= $row->store_name; ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<!-- <iframe src="<?= base_url("doctor/medicalrecord/print/$id_customer") ?>" name="medical_record_print" id="medical_record_print" style="display: none;" frameborder="0"></iframe> -->