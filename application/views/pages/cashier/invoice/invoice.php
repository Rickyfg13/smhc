<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" media="all">

    <title>Invoice</title>
    <style>
        :root {
            --primary-color: #2D4A49;
            --hover-primary-color: #223d3d;
            --secondary-color: #BB9A5D;
            --hover-secondary-color: #b38d47;
            --title-color: #141313;
            --text-color: #777777;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }

            .thead-hers {
                color: #fff;
                background-color: #BB9A5D !important;
                border-top: 10px solid var(--secondary-color);
            }
        }

        .text-heading {
            letter-spacing: 2.5px;
            color: var(--primary-color);
        }

        .thead-hers {
            color: #000;
            background-color: #BB9A5D !important;
            -webkit-print-color-adjust: exact;
            border-top: 10px solid var(--secondary-color);
        }
    </style>
</head>

<body>

    <div class="container-fluid" style="padding-left: 15px; padding-right: 15px;">
        <div class="row mt-4">
            <div class="col-12 text-right">
                <p><?= $store->address; ?>.</p>
                <p>(+62) <?= substr($store->phone, 1, 3); ?>-<?= substr($store->phone, 4, 4); ?>-<?= substr($store->phone, 8, 3); ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <img src="<?= base_url("assets/images/logo/herslogo-min.png"); ?>" alt="logo-hers" srcset="" style="width: 230px;">
                    <h3 class="text-heading my-auto">Invoice</h3>
                </div>
            </div>
        </div>

        <div class="row mt-3 justify-content-center">
            <div class="col-12">
                <table class="table table-sm table-borderless" style="margin-bottom: 1px;">
                    <tr>
                        <td style="width: 70%;">Date : <?= date_format(new DateTime($invoice_detail->created_at), 'd/m/Y'); ?></td>
                        <td>Invoice Number : <strong><?= $invoice; ?></strong></td>
                    </tr>
                    <tr>
                        <td>Time : <?= date_format(new DateTime($invoice_detail->created_at), 'H:i'); ?>&nbsp;WIB</td>
                        <td>Cashier : <?= $invoice_detail->name; ?></td>
                    </tr>
                    <tr>
                        <td>Method Payment : <?= ucwords(str_replace("_", " ", $invoice_detail->method_payment)); ?></td>
                        <td>Patient : <?= $invoice_detail->name_customer != "" ? $invoice_detail->name_customer : "-" ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-sm mt-4">
                        <thead>
                            <tr class="thead-hers">
                                <th scope="col">#</th>
                                <th scope="col" style="width: 50%;">Items</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($transaction as $row) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $row->title_product; ?></td>
                                    <td><?= $row->qty; ?></td>
                                    <td><?= number_format($row->subtotal, 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot class="table-borderless mt-5" style="border-top: 1px solid #dee2e6;">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="tftop"></td>
                                <td class="tftop"></td>
                                <td class="tftop">Subtotal :</td>
                                <td class="tftop"><?= $discount->subtotal != "" ? number_format($discount->subtotal, 0, ',', '.') : 0 ?></td>
                            </tr>
                            <tr>
                                <td class="tfbot"></td>
                                <td class="tfbot"></td>
                                <td class="tfbot">Discount :</td>
                                <td class="tfbot"><?= $discount->discount_total != "" ? number_format($discount->discount_total, 0, ',', '.') : 0 ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Paid :</td>
                                <td><?= $discount->cash_payment != "" ? number_format($discount->cash_payment, 0, ',', '.') : 0 ?></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #dee2e6;">
                                <td></td>
                                <td></td>
                                <td>Change Money :</td>
                                <td><?= $discount->money_change != "" ? number_format($discount->money_change, 0, ',', '.') : 0 ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><span style="font-size: 28px;">Total :</span></td>
                                <td><span style="font-size: 28px;"><strong><?= number_format($invoice_detail->total, 0, ',', '.'); ?></strong></span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


</body>

</html>