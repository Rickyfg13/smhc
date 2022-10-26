<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <style>
        .footer {
            border-top: 2px double #000;
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .footer span {
            margin: auto;
        }
    </style>
    <title>Medical Record</title>
</head>

<body>
    <div class="main-content-inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4 class="header-title text-center">Medical Record Detail</h4>
                            <div class="data-patient mt-5 mb-5">
                                <div class="table-responsive">
                                    <table class="table table-striped">

                                        <?php foreach ($customer as $row) : ?>

                                            <?php $birthDate = new DateTime($row->birth_date);
                                            $today = new DateTime();

                                            if ($birthDate < $today) {
                                                $umur = $today->diff($birthDate)->y;
                                            } ?>
                                            <tr>
                                                <td>Name</td>
                                                <td>:</td>
                                                <td><?= $row->name; ?></td>
                                                <td>No RM</td>
                                                <td>:</td>
                                                <td><?= isset($row->id) ? substr($row->id, 1) : "-"; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nick Name</td>
                                                <td>:</td>
                                                <td><?= $row->nickname == "" ? "-" : $row->nickname; ?></td>
                                                <td>Address</td>
                                                <td>:</td>
                                                <td><?= $row->address; ?></td>

                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td><?= strtolower($row->email); ?></td>
                                                <td>DoB/Age</td>
                                                <td>:</td>
                                                <td><?= $umur; ?>&nbsp;Years Old</td>

                                            </tr>
                                            <tr>
                                                <td>Job</td>
                                                <td>:</td>
                                                <td><?= ucwords($row->job); ?></td>
                                                <td>KTP</td>
                                                <td>:</td>
                                                <td><?= $row->identity_number; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Phone/WA</td>
                                                <td>:</td>
                                                <td><?= $row->phone; ?></td>
                                                <td>Previous Skincare</td>
                                                <td>:</td>
                                                <td><?= $row->previous_skincare; ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </table>
                                </div>
                            </div>
                            <table class="table table-striped" id="patients">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Anamnese</th>
                                        <th>Diagnosa</th>
                                        <th>Theraphy</th>
                                        <th>Note</th>
                                        <th>Doctor</th>
                                        <th>Clinic</th>
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detail as $row => $index) : ?>
                                        <tr>
                                            <td><?= date_format(new DateTime($index->date), 'd/m/Y') ?></td>
                                            <td><?= $index->anamnesa; ?></td>
                                            <td><?= $index->diagnosa; ?></td>
                                            <td>
                                                <?php foreach ($therapies[$index->id_therapies] as $row2) : ?>
                                                    <span class="badge badge-pill badge-info" style="font-size: 13px;"><?= $row2->title; ?></span>
                                                <?php endforeach ?>
                                            </td>
                                            <td>
                                                <?= $index->note == "" || $index->note == null ? "" : $index->note; ?>
                                            </td>
                                            <th><?= $index->doctor_name; ?></th>
                                            <td><?= $index->store_name; ?></td>
                                            <!-- <td>
                                            <a href="<?= base_url('doctor/medical-records/history/detail/' . $index->id_medical_records) ?>" class="btn btn-primary btn-sm">Detail</a>
                                        </td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>


                            <div class="tablePatientsMedicalRecordsHistory" style="margin-top: 70px !important;">
                                <!-- <div class="data-tables datatable mt-4">
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
                            </div> -->
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>


    </div>
</body>

</html>