<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Struk</title>
    <style>
        * {
            font-size: 11px;
            font-family: 'Arial';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        .header td,
        .header th,
        .header tr,
        table.header {
            border-top: 0px;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .description,
        .quantity,
        .price,
        .ket,
        .value {
            font-size: 9px;
        }

        td.description,
        th.description {
            width: 60px;
            max-width: 60px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 50px;
            max-width: 50px;
            word-break: break-all;
        }

        td.ket,
        th.ket {
            width: 80px;
            max-width: 80px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 155px;
            max-width: 155px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        hr {
            border: 1px dashed #000;
        }

        .identity {
            display: flex;
            text-align: left;
            justify-content: space-between;
            margin-top: -10px;
        }

        .identity p {
            font-size: 9px;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <img src="<?= base_url("assets/images/logo/herslogo-struk.png"); ?>" width="50" alt="Logo">
        <p class="centered"><?= $store->address; ?>. <br>
            (+62) <?= substr($store->phone, 1, 3); ?>-<?= substr($store->phone, 4, 4); ?>-<?= substr($store->phone, 8, 3); ?>
        </p>
        <hr>
        <!-- <div class="identity">
            <p>DateTime:</p>
            <p>15/11/21 10:42</p>
        </div>
        <div class="identity">
            <p>No Invoice:</p>
            <p>TR0212321312321</p>
        </div>
        <div class="identity">
            <p>Cashier:</p>
            <p>Muthia</p>
        </div>
        <div class="identity">
            <p>Patient:</p>
            <p>Muhammad Rafasha Pambudhi</p>
        </div> -->
        <table class="header">
            <tbody>
                <tr>
                    <td class="ket">Date:</td>
                    <td class="value" style="text-align: right;"><?= date_format(new DateTime($invoice_detail->created_at), 'd/m/y H:i'); ?></td>
                </tr>
                <tr>
                    <td class="ket">No Invoice:</td>
                    <td class="value" style="text-align: right;"><?= $invoice; ?></td>
                </tr>
                <tr>
                    <td class="ket">Cashier:</td>
                    <td class="value" style="text-align: right;"><?= $invoice_detail->name; ?></td>
                </tr>
                <tr>
                    <td class="ket">Patient:</td>
                    <td class="value" style="text-align: right;"><?= $invoice_detail->name_customer != "" ? $invoice_detail->name_customer : "-" ?></td>
                </tr>
                <tr>
                    <td class="ket">Method Payment:</td>
                    <td class="value" style="text-align: right;"><?= ucwords(str_replace("_", " ", $invoice_detail->method_payment)); ?></td>
                </tr>
            </tbody>
        </table>
        <table>
            <!-- <thead>
                <tr>
                    <th class="description" style="text-align: left;">Items</th>
                    <th class="quantity" style="text-align: left;">Qty</th>
                    <th class="price" style="text-align: right;">SubTotal</th>
                </tr>
            </thead> -->
            <tbody>
                <?php foreach ($transaction as $row) : ?>
                    <tr>
                        <td class="description"><?= $row->title_product; ?></td>
                        <td class="quantity" style="text-align: right;"><?= $row->qty; ?>x</td>
                        <td class="price" style="text-align: right;"><?= number_format($row->subtotal, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td class="description">SUBTOTAL</td>
                    <td class=""></td>
                    <td class="price" style="text-align: right;"><?= $discount->subtotal != "" ? number_format($discount->subtotal, 0, ',', '.') : 0 ?></td>
                </tr>
                <tr>
                    <td class="description">DISCOUNT</td>
                    <td class=""></td>
                    <td class="price" style="text-align: right;"><?= $discount->discount_total != "" ? number_format($discount->discount_total, 0, ',', '.') : 0 ?></td>
                </tr>
                <tr>
                    <td class="description">PAID</td>
                    <td class=""></td>
                    <td class="price" style="text-align: right;"><?= $discount->cash_payment != "" ? number_format($discount->cash_payment, 0, ',', '.') : 0 ?></td>
                </tr>
                <tr>
                    <td class="description">CHANGE MONEY</td>
                    <td class=""></td>
                    <td class="price" style="text-align: right;"><?= $discount->money_change != "" ? number_format($discount->money_change, 0, ',', '.') : 0 ?></td>
                </tr>
                <tr>
                    <td class="description">TOTAL</td>
                    <td class=""></td>
                    <td class="price" style="text-align: right;"><strong><?= number_format($invoice_detail->total, 0, ',', '.'); ?></strong></td>
                </tr>

            </tbody>
        </table>
        <p class="centered">Thanks for your purchase :)
            <br>Happy Treatment
            <br>@hersclinic.id
        </p>
    </div>
</body>

</html>