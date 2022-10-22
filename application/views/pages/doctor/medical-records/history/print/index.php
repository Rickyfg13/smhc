<?php
//hitung umur

$birthDate = new DateTime($patient->birth_date);
$today = new DateTime();

if ($birthDate < $today) {
    $umur = $today->diff($birthDate)->y;
}


?>

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

    <div class="container">
        <div class="row mt-3" style="border-bottom: 2px double #000;">
            <div class="col-3">
                <div class="text-center">
                    <img src="<?= base_url("assets/images/logo/herslogotype.png") ?>" class="my-auto" alt="" width="120">

                </div>
            </div>

            <div class="col-6 pb-2">
                <div class="text-center">
                    <h5>HERS Skin & Wellness</h5>
                    <p style="margin-bottom: -4px;">dr. Sofi Sofia Putri</p>
                    <small>Jl.Raya Siteba No.26, Nanggalo, Padang</small>
                </div>

            </div>
        </div>

        <div class="row mt-4 justify-content-center">
            <table class="table table-sm table-borderless" style="margin-left: 3rem;">
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

        <div class="row mt-4">
            <p>Doctor : <span style="font-weight: 700;"><?= isset($noRm->name) ? $noRm->name : '-' ?></span></p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Anamnese</th>
                        <th scope="col">Diagnose</th>
                        <th scope="col">Therapy</th>
                        <th scope="col">Products</th>
                        <th scope="col">Note</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($getPatients as $row) : ?>
                        <tr>
                            <td scope="row"><?= date_format(new DateTime($row->created_at), 'd/m/Y') ?></td>
                            <td><?= $row->anamnesa; ?></td>
                            <td><?= $row->diagnosa; ?></td>
                            <td>
                                <ul style="list-style-type: none; margin-left: -40px;">
                                    <?php
                                    $i = 0;
                                    foreach ($therapies[$row->id_therapies] as $row2) : ?>
                                        <!-- <span class="badge badge-pill badge-dark" style="font-size: 13px;"><?= $row2->title; ?></span> -->
                                        <?php if ($i == count($therapies[$row->id_therapies]) - 1) : ?>
                                            <li><?= $row2->title; ?></li>
                                        <?php else : ?>
                                            <li><?= $row2->title; ?>,</li>
                                        <?php endif ?>

                                    <?php $i++;
                                    endforeach ?>
                                </ul>
                            </td>
                            <td>
                                <ul style="list-style-type: none; margin-left: -40px;">
                                    <?php $j = 0;
                                    foreach ($items[$row->id_items] as $data) : ?>
                                        <?php if ($j == count($items[$row->id_items]) - 1) : ?>
                                            <li><?= $data->title; ?></li>
                                        <?php else : ?>
                                            <li><?= $data->title; ?>,</li>
                                        <?php endif ?>
                                    <?php $j++;
                                    endforeach ?>
                                </ul>
                            </td>
                            <td>
                                <?= $row->note == "" || $row->note == null ? "-" : $row->note; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="row footer">

            <span>https://www.hersclinic.id</span>

        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


</body>

</html>