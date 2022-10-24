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
                            <h4 class="header-title">Medical Record Detail</h4>
                            <table class="table table-striped" id="patients">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Anamnese</th>
                                        <th>Diagnosa</th>
                                        <!-- <th>Theraphy</th> -->
                                        <th>Note</th>
                                        <th>Doctor</th>
                                        <th>Clinic</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <td><?= $detail['created_at']; ?></td> -->
                                        <td><?= date_format(new DateTime($detail['created_at']), 'd/m/Y') ?></td>
                                        <td><?= $detail['anamnesa']; ?></td>
                                        <td><?= $detail['diagnosa']; ?></td>
                                        <!-- <td><?= $detail['title']; ?></td> -->
                                        <td>
                                            <?= $detail['note'] == "" || $detail['note'] == null ? "" : $detail['note']; ?>
                                        </td>
                                        <td><?= $detail['doctor_name']; ?></td>
                                        <td><?= $detail['store_name']; ?></td>
                                    </tr>
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