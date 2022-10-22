<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
        #tfoot{
            border: none !important;
        }
        h4{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <!-- <img src="assets/img/logo3.jpg" style="position: absolute; width: 120px; height: auto; margin-left: 20px;"> -->
    <table style="width: 100%;">
        <tr>
            <td align="center">
                <span style="line-height: 1.6; font-weight: bold; font-size: 16px;">
                    KasirKu App
                </span>
            </td>
        </tr>
    </table>

    <hr class="line-title">
    <p class="text-center">
        <span style="text-transform: capitalize;"><?= $title; ?></span> <br>
        <?php if (isset($month)) : ?>
            <b>Period <?= $month; ?></b>
        <?php endif ?>
        <?php if (isset($start_from) && isset($end_period)) : ?>
            <b>From <?= date_format(new DateTime($start_from), "j M Y"); ?> To <?= date_format(new DateTime($end_period), "j M Y"); ?></b>
        <?php endif ?>
        <?php if (isset($year)) : ?>
            <b>Period <?= $year; ?></b>
        <?php endif ?>

    </p>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Created At</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row->invoice; ?></td>
                    <td><?php echo date_format(new DateTime($row->created_at), "d/m/Y"); ?></td>
                    <td>Rp&nbsp;<?= number_format($row->total, 0, ',', '.'); ?>,-</td>
                   
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td><h4><b>Total :</b></h4></td>
                <td></td>
                <td><h4><b>Rp&nbsp;<?= number_format(array_sum(array_column($content, 'total')), 0, ',', '.') ?>,-</b></h4></td>
            </tr>
        </tfoot>

    </table>


</body>

</html>