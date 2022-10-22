<script>
    const base_url = $('body').data('url');

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('cc14b125ee722dc1a2ea', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    var id_store = '<?php echo $this->session->userdata('id_store') ?>';
    channel.bind('my-event', function(data) {
        if (id_store == data.id_store_sess) {
            VanillaToasts.create({
                title: 'Success!',
                text: data.msg,
                type: 'success',
                positionClass: 'topRight',
                timeout: 2000
            });

            notifSound();
        }

    });

    var audioElement = document.getElementById('notifSound');

    function notifSound() {
        audioElement.play();
    }



    $(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: "Choose the option",
            allowClear: true
        });

        $('#dateAreaa .input-daterange').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
            todayBtn: 'linked',
        });

        $('#dateAreaaSalesProduct .input-daterange').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
            todayBtn: 'linked',
        });

        $("#datepicker").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true,

        });

        $("#datepicker_year").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true,

        });

        $('#dataTableListPatientsTransaction').DataTable({
            responsive: false,
            "order": [
                [3, "desc"]
            ], //or asc 
            "columnDefs": [{
                "targets": 3,
                "type": "date-eu"
            }],
        });
        //method payment selected
        $(document).on('click', "input[name=customRadio2]", function() {
            let val = $(this).data('val');
            let total = $('#total').val();
            if (val == 'cash_payment') {
                $('#space_cash_payment').show();
                $('#space_debit_payment').hide();
                $('#space_marketplace').hide();
                $('#cash_payment').val("");
                $('#money_change').val("");
                $('#method_payment').val(val);
                $('#bank').val("");
                $('#cash_payment').focus();
            } else if (val == 'debit_payment') {
                $('#space_cash_payment').hide();
                $('#space_debit_payment').show();
                $('#space_marketplace').hide();
                $('#cash_payment').val(formatRupiah(total));
                $('#money_change').val(0);
                $('#method_payment').val(val);


                let valBank = $('#bank_list option:selected').val();
                $('#bank').val(valBank);
                //console.log($('#bank_list option:selected').val());
            } else {
                $('#space_cash_payment').hide();
                $('#space_debit_payment').hide();
                $('#space_marketplace').show();
                $('#method_payment').val(val);
                $('#money_change').val(0);
                $('#bank').val("");
                let valMarketplace = $('#marketplace_list option:selected').val();
                $('#marketplace').val(valMarketplace);
            }
        });

        // $(document).on('page.dt', '#dataTable6', function() {
        //     $('.sorting_desc').hide();
        //     $('.sorting_asc').hide();
        //     $('.sorting_1').hide();
        //     $('.sorting').hide();
        // });

        //select bank option
        $(document).on('change', '#bank_list', function() {
            let valSelectBank = $('#bank_list option:selected').val();
            $('#bank').val(valSelectBank);
        });

        $(document).on('click', '#btnPatientList', function() {
            $('#patientSpace').fadeIn(500);
            $('#queueSpace').hide();

        });

        $(document).on('click', '#btnQueueList', function() {
            $('#queueSpace').fadeIn(500);
            $('#patientSpace').hide();

        });

        //send invoice via wa
        $(document).on('click', '#btnSendInvoiceWa', function() {
            let phone_patient = $('.customer-phone').val();
            let invoice_number = $('#number_invoice').text();

            let conv_phone = phone_patient.replace('0', '62');
            window.open('https://wa.me/' + conv_phone + '?text=Terima%20kasih%20telah%20memilih%20hersclinic.id%20sebagai%20pilihan%20Anda.%20Berikut%20invoice%20transaksi%20anda%20%3A%0Ahttps%3A%2F%2Fsmhc.hersclinic.id%2Finvoice%2Fprint%2F' + invoice_number + '%2Fpdf');
        });

        //select variant when cashier add to cart an item
        $(document).on('click', '.btn-variant', function() {

            let price = $(this).data('price');
            let id_variant = $(this).data('idVariant');
            $('#price_temp').val(price);
            $('#price_modal').val(price);
            $('#id_variant').val(id_variant);

        });

        //add patient not queue
        $(document).on('click', '#rowPatient', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let phone = $(this).data('phone');

            $('.customer-name-space').text(name);
            $('.customer-id-space').val(id);
            $('.customer-phone').val(phone);

            if (!$('#btnClearCustomer').length) {
                $('.customer-space').append('<i class="fa fa-times text-danger ml-3" id="btnClearCustomer" style="font-size: 18px; cursor: pointer;"></i>');
            }

            $('#modalCustomer').modal('hide');
        });

        //show list transaction
        $(document).on('click', '#btnEditTransaction', function() {
            $.ajax({
                method: "GET",
                url: base_url + 'cashier/loadDataTransaction',
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function(response) {
                    $('#modal-edit-cashier-transaction').html(response);
                    $('#modal-edit-transaction-cashier').modal('show');
                    if ($('#tableTransactions').length) {
                        $('#tableTransactions').DataTable({
                            responsive: false
                        });
                    }

                    $('[data-toggle="tooltip"]').tooltip({
                        placement: 'top'
                    });

                    $('#loading').hide();
                }
            })
        });

        //select transaction to edit data
        $(document).on('click', '#editTransaction', function() {
            let invoice = $(this).data('invoice');
            //loadDataSessEditTransaction('cashier/loadDataSessEditTrasaction?invoice=' + invoice);
            $.ajax({
                method: "GET",
                url: base_url + 'cashier/showDataEditTransaction?invoice=' + invoice + '&sess=1',
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    $('#modal-edit-transaction-cashier').modal('hide');
                    $('#result-cart').html(response);
                    $('#table-cart').slimScroll({
                        height: '300px',


                    });
                    $('#number_invoice').text(invoice);
                    $('body').attr('data-edit', 1);

                    $('#loading').hide();
                }
            });
        });

        //refund (today transaction)
        $(document).on('click', '.refundTransaction', function() {
            let invoice_number = $(this).data('invoice');
            $('#modalReasonRefund').modal('show');

            $('#invoice_number_refund').val(invoice_number);
        });

        //reason option changed
        $(document).on('change', '#reason', function() {
            let val_reason = $('#reason option:selected').val();

            if (val_reason == 'Other..') {
                $('.another_reason').fadeIn(500);
            } else {
                $('.another_reason').fadeOut(350);
            }
        });

        //refund transaction
        $(document).on('click', '#btnRefundTrans', function() {
            let invoice = $('#invoice_number_refund').val();
            let reason = $('#reason option:selected').val();
            let another_reason = $('#another_reason').val();
            $.ajax({
                method: "GET",
                url: base_url + 'cashier/refund?invoice=' + invoice + '&reason=' + reason + '&another_reason=' + another_reason,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    VanillaToasts.create({
                        title: data.title,
                        text: data.msg,
                        type: data.type,
                        positionClass: 'topRight',
                        timeout: 2000
                    });
                    if (data.statusCode == 200) {
                        let arr_id_product_refund = JSON.parse(data.id_product_refund);


                        $.each(arr_id_product_refund, function(key, value) {
                            $('#sisaStock' + value.id_product).html(`<span>Stock : ${value.curr_stock}</span>`);
                        });
                        $('#modal-edit-transaction-cashier').modal('hide');
                        $('#modalReasonRefund').modal('hide');
                    }
                    $('#loading').hide();
                }
            })
        });

        //clear customer
        $(document).on('click', '#btnClearCustomer', function() {
            if ($('#id_queue_val').val() == "") {
                $('.customer-id-space').val("");
                $('.customer-name-space').text("New Customer");
                $(this).remove();
            } else {
                $('.customer-id-space').val("");
                $('.customer-name-space').text("New Customer");
                $('#id_queue_val').val("");

                $.ajax({
                    method: "POST",
                    url: base_url + 'cashier/clearcartqueue',
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    success: function(response) {
                        loadDataTableCart('cashier/loadDataTableCart');
                        loadTotVal('cashier/loadTotVal');
                        $('#itemCode').focus();
                        $('#loading').hide();

                    }
                });
            }


        });

        $(document).on('show.bs.modal', '.modal', function() {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });

        //cek if page reloaded
        if (performance.navigation.type == 1) {
            //clearCart();
            $('#btnPay').attr('disabled', true);
        }

        $('#table-cart').slimScroll({
            height: '300px',
            axis: 'both'

        });

        $("input[name='qty_modal']").TouchSpin({
            min: 1
        });

        //$('#switch1').prop('checked', false)



        if ($('#dataTableActivity').length) {
            $('#dataTableActivity').DataTable({
                responsive: false
            });
        }

        $('.items').slimScroll({
            height: '630px'
        });


        let countItem = $('.hitung-item').length;

        if (countItem < 8) {
            $('#btnLoadMoreData').remove();
        }


        $('#number_invoice').text(generateInvoice());
        $('#struk').attr('src', base_url + 'cashier/struk/' + $('#number_invoice').text());

        //show modal add to cart
        $(document).on('click', '#btnAddToCart', function() {

            let id = $(this).data('id');
            let id_category = $(this).data('category');
            let qty = 1;
            let price = $(this).data('price');
            let purchase_price = $(this).data('purchasePrice');
            let title = $(this).data('title');
            //let conv_title = title.split(" ").join("%20");
            let conv_title = encodeURIComponent(title);
            let stock = $(this).data('stock');

            $('#modalAddToCart').modal('show');

            $('.title_modal').text(title);
            $('#id_modal').val(id);
            $('#price_modal').val(price);
            $('#purchase_price_modal').val(purchase_price);
            $('#title_modal').val(conv_title);
            $('#stock_modal').val(stock);
            $('#category_modal').val(id_category);
            $('#price_default').val(price);
            //temp price
            $('#price_temp').val(price);





        });

        $('#modalAddToCart').on('show.bs.modal', function() {
            $('#btnModalAddToCart').attr('disabled', true);
        });

        $('#modalAddToCart').on('shown.bs.modal', function() {
            let id = $('#id_modal').val();
            let price_default = $('#price_default').val();

            $.ajax({
                method: "GET",
                url: base_url + 'cashier/loadDataVariant?id=' + id,
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function(response) {
                    $('.variant-space').html(response);
                    $('#btnVariantDefault').attr('data-price', price_default);
                    $("#loading").hide();
                    $('#btnModalAddToCart').removeAttr('disabled');
                }
            });
        });

        //add to cart
        let countDisc = "<?= isset($countDiscount) ? $countDiscount : 0;  ?>";
        $(document).on('click', '#btnModalAddToCart', function() {
            let id = $('#id_modal').val();
            let id_category = $('#category_modal').val();
            let id_variant = $('#id_variant').val() != "" ? $('#id_variant').val() : "";
            let price = Number($('#price_modal').val());
            let purchase_price = Number($('#purchase_price_modal').val());
            let price_temp = Number($('#price_temp').val());
            let title = $('#title_modal').val();
            let stock = $('#stock_modal').val();
            let qty = Number($('#qty_modal').val());
            let result = new Array();
            let potongan = new Array();
            let convDisc = Number(countDisc);
            let status_form = $('body').data('edit');
            let invoice = $('#number_invoice').text();
            let get_discount_price = $('#discount_price').val();
            let discount_price_temp = get_discount_price.split(".").join("");
            let discount_price = Number(discount_price_temp);
            let discount;
            //let hitung = 0;
            if (discount_price == '') {
                if (countDisc != 0) {
                    for (var i = 0; i <= convDisc - 1; i++) {
                        let value = $('#switch' + i).prop('checked');
                        if (value == true) {


                            let disc = Number($('#switch' + i).val());

                            if (result[i - 1] != undefined) {
                                potongan[i] = result[i - 1] * disc / 100;
                                result[i] = result[i - 1] - (potongan[i]);
                            } else {
                                potongan[i] = price * disc / 100;
                                result[i] = price - (potongan[i]);
                            }

                            price = result[i];

                            //result[i+1] = result[i];
                            //$('#price_modal').val(result[i]);


                        }

                        //discount[i] = potongan[i-1] + potongan[i+1];

                    }
                }
                discount = potongan.reduce((a, b) => a + b, 0);
            } else {
                discount = price_temp - discount_price;
                price = price_temp - discount;
            }



            let price_sebelum = price_temp;
            //let discount_sebelum = discount * qty;
            console.log(discount);



            $.ajax({
                method: "POST",
                url: base_url + 'cashier/insert/?id=' + id + '&id_category=' + id_category + '&qty=' + qty + '&purchase_price=' + purchase_price + '&price=' + price + '&title=' + title + '&stock=' + stock + '&discount=' + discount + '&price_sebelum=' + price_sebelum + '&id_variant=' + id_variant,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    $('#loading').hide();
                    if (data.statusCode == 200) {
                        if (status_form == "") {
                            loadDataTableCart('cashier/loadDataTableCart');
                        } else {
                            loadDataTableCartEdit('cashier/showDataEditTransaction?invoice=' + invoice)
                        }
                        loadTotVal('cashier/loadTotVal');
                        let cekStock = data.sisaStock;
                        $('.button' + id + ' button').data('stock', cekStock);
                        $('.button' + id + ' button').attr('data-stock', cekStock);
                        $('#sisaStock' + id + ' span').text('Stock : ' + cekStock);
                        $('#btnPay').removeAttr('disabled');
                        $('#itemCode').focus();
                        clearFormAddToCart();
                        $('#modalAddToCart').modal('hide');
                    } else if (data.statusCode == 202) {
                        alert(data.msg);
                    }


                }
            });
        });


        $(document).on('keyup', '#discount_price', function() {
            let bilangan = $(this).val();
            $(this).val(formatRupiah(bilangan));
            $('.discount-percent input[type=checkbox]').prop('checked', false);
        });

        $(document).on('change', '.discount-percent input[type=checkbox]', function() {
            $('#discount_price').val('');
        });

        //discount

        // for (var i = 0; i <= 1; i++) {
        //     $(document).on('change', '#switch' + i, function() {
        //         let value = $(this).prop('checked');
        //         let price = Number($('#price_modal').val());
        //         let price_temp = Number($('#price_temp').val());
        //         let result;
        //         if (value == true) {
        //             let disc = Number($(this).val());

        //             result = price - (price * disc / 100);
        //             $('#disc_sebelum').val(price * disc / 100);

        //         } else {
        //             let disc = Number($(this).val());
        //             let disc_sebelum = Number($('#disc_sebelum').val());
        //             result = price + disc_sebelum;
        //             $('#disc_sebelum').val("");

        //         }


        //         $('#price_modal').val(result);
        //     });
        // }


        //end add to cart



        //add to cart with itemCode
        $(document).on('change', '#itemCode', function() {
            let itemCode = $(this).val();
            let qty = 1;
            if (itemCode.length == 10) {

                $.ajax({
                    method: "POST",
                    url: base_url + 'cashier/insert_by_itemCode/' + itemCode + '/' + qty,
                    success: function(data) {
                        var data = JSON.parse(data);

                        if (data.statusCode == 200) {
                            loadDataTableCart('cashier/loadDataTableCart');
                            loadTotVal('cashier/loadTotVal');
                            $('#itemCode').val("");

                            let cekStock = data.sisaStock;
                            $('.button' + itemCode + ' button').data('stock', cekStock);
                            $('.button' + itemCode + ' button').attr('data-stock', cekStock);
                            $('#sisaStock' + itemCode + ' span').text('Stock : ' + cekStock);
                            $('#btnPay').removeAttr('disabled');
                        } else if (data.statusCode == 202) {
                            alert(data.msg);
                            $('#itemCode').val("");
                        }
                    }
                });


            }
        });

        //delete item in cart
        $(document).on('click', '.clear-items', function() {
            let rowid = $(this).data('rowid');
            let id_product = $(this).data('id');
            let qty = $(this).data('qty');
            let status_form = $('body').data('edit');
            let invoice_number = $('#number_invoice').text();
            $.ajax({
                method: "POST",
                url: base_url + 'cashier/delete',
                data: {
                    rowid: rowid,
                    id: id_product,
                    qty: qty
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    let data = JSON.parse(response);

                    if (data.statusCode == 200) {
                        $('#sisaStock' + data.id_product).html(`<span>Stock : ${data.update_stock}</span>`);
                        if (status_form == "") {
                            loadDataTableCart('cashier/loadDataTableCart');
                        } else {
                            loadDataTableCartEdit('cashier/showDataEditTransaction?invoice=' + invoice_number);
                        }
                        loadTotVal('cashier/loadTotVal');

                        if (data.count == 0) {
                            $('#btnPay').attr('disabled', true);
                        }
                    } else {
                        VanillaToasts.create({
                            title: data.title,
                            text: data.msg,
                            type: data.type,
                            positionClass: 'topRight',
                            timeout: 2000
                        });
                    }

                    $('#loading').hide();
                }
            });
        });

        //delete item in cart from db
        $(document).on('click', '.clear-items-db', function() {
            let id_product = $(this).data('idProduct');
            let invoice_number = $(this).data('invoiceNumber');


            $.ajax({
                method: "GET",
                url: base_url + 'cashier/save_deleted_data_edit_transaction?id_product=' + id_product + '&invoice=' + invoice_number,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    $('#' + id_product).remove();
                    //loadDataTableCartEdit('cashier/showDataEditTransaction?invoice=' + invoice_number);
                    if ($('.data-items-db').length == 0) {
                        $('.old-data-space').remove();
                    }

                    $('#loading').hide();
                }
            });
        });
    });

    $(function() {
        let kali = 0;
        //cash payment and set money_change
        $(document).on('keyup', '#cash_payment', function() {
            let bilangan = $(this).val();
            $(this).val(formatRupiah(bilangan));


            let totalValue = $('#totalValueModal').text();
            let totalValueConv = totalValue.split(".").join("");
            let bilanganConv = bilangan.split(".").join("");


            if (bilangan != "") {
                let money_change = Number(bilanganConv) - Number(totalValueConv);
                if (money_change < 0) {
                    $('#money_change').val('-' + formatRupiah(money_change));

                } else {
                    $('#money_change').val(formatRupiah(money_change));

                }
            } else {
                $('#money_change').val("");
            }




        });

        //condition if modal pay show
        $('#modalPay').on('shown.bs.modal', function() {

            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%',
                allowClear: true,
                placeholder: "Choose the option",

            });
            //focus on input
            $('#cash_payment').focus();

            let invoice = $('#number_invoice').text();
            let disc = $('#tot_disc').val();
            let subtot = $('#subtotal_cart').val();
            let purchase_price = $('#purchase_price').val();
            let id_customer = $('.customer-id-space').val();
            $('#invoice').val(invoice);
            $('#discount_total').val(disc);
            $('#subtotal').val(subtot);
            $('#purchasePriceTotal').val(purchase_price);
            $('#id_customer').val(id_customer);



        });


        //add transaction to db
        $(document).on('submit', '#formPay', function(e) {

            e.preventDefault();
            let data = $(this).serialize();
            let number_invoice = $('#invoice').val();
            let id_queue = $('#id_queue_val').val();
            let cash_payment = $('#cash_payment').val();
            let total = Number($('#total').val());
            let cash_payment_conv = Number(formatBackRupiah(cash_payment));

            if (cash_payment_conv >= total) {
                $.ajax({
                    method: "POST",
                    url: id_queue == '' ? base_url + 'cashier/pay' : base_url + 'cashier/pay/' + id_queue,
                    data: data,
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    success: function(data) {
                        var data = JSON.parse(data);

                        if (data.statusCode == 200) {
                            $('#modalPay').modal('hide');
                            //$('#struk').attr('src', '<?= base_url("cashier/struk/") ?>' + number_invoice);
                            $('#cash_payment_val').text($('#cash_payment').val());
                            $('#money_change_val').text($('#money_change').val());
                            $('.btnAddToCart').attr('disabled', true);
                            $("#btnPay").attr('disabled', true);
                            $("#btnReset").show();
                            $('#itemCode').attr('readonly', true);
                            $('#formPay')[0].reset();
                            cetakStruk();
                            $('.status_pay').val(1);
                            if ($('.customer-id-space').val() != "") {
                                $('#btnSendInvoiceWa').show();
                            }


                        }

                        $('#loading').hide();



                    }
                });
            } else {
                alert('Payment is not enough');
            }



        });





        //show detail activity transaction
        $(document).on('click', '#detailTransaction', function(e) {
            e.preventDefault();
            let invoice = $(this).data('invoice');
            $.ajax({
                method: "POST",
                url: base_url + 'activity/detail/' + invoice,
                beforeSend: function() {
                    $('#loading').show();
                },

                success: function(response) {
                    $('#modal_detail_invoice').html(response);
                    $('#modalDetailInvoice').modal('show');
                    $('#frames').html('<iframe src="' + base_url + '/cashier/invoice/' + invoice + '"' +
                        'id="invoice" name="invoice" frameborder="0" style="display: none;"></iframe>');
                    $('#loading').hide();
                }
            });
        });

        //reset transaction
        $(document).on('click', '#btnReset', function() {
            clearCart();
            $(this).hide();
            $('#btnSendInvoiceWa').hide();
            $('#itemCode').focus();
        });

        //click button print invoice in activity transaction
        $(document).on('click', '#btnPrintInvoice', function() {
            window.frames['invoice'].print();
        });


        //filter item cashier section
        const treatment = '102001';
        const product = '102002';
        const btnFilterTreatment = document.querySelector('.btnFilterTreatment');
        const btnFilterProduct = document.querySelector('.btnFilterProduct');
        const btnBackToDefault = document.querySelector('.btnBackToDefault');
        const inputSearchItems = document.getElementById('searchItems');
        const space_items = document.querySelector('.space_items');
        const items = document.querySelector('.items');
        const search_items = document.getElementById('searchItems');


        btnFilterTreatment.addEventListener('click', function() {
            let id = this.dataset.id;
            search_items.value = "";
            $.ajax({
                method: "POST",
                url: base_url + 'cashier/filter/' + id,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    let data = JSON.parse(response);

                    if (data.statusCode == 200) {
                        items.innerHTML = data.html;


                        btnFilterTreatment.classList.remove('btn-hers-outline');
                        btnFilterTreatment.classList.add('btn-hers');

                        btnFilterProduct.classList.remove('btn-hers');
                        btnFilterProduct.classList.add('btn-hers-outline');


                        $('.items').slimScroll({
                            height: '630px'
                        });

                        kali = 0;
                        $('#btnLoadMoreData').attr('data-category', treatment);
                        let countItem = $('.hitung-item').length;

                        if (countItem < 8) {
                            $('#btnLoadMoreData').remove();
                        }


                    } else {
                        alert('fail');
                    }

                    $('#loading').hide();
                }
            });
        });

        btnFilterProduct.addEventListener('click', function() {
            let id = this.dataset.id;
            search_items.value = "";
            $.ajax({
                method: "POST",
                url: base_url + 'cashier/filter/' + id,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    let data = JSON.parse(response);

                    if (data.statusCode == 200) {
                        items.innerHTML = data.html;



                        btnFilterProduct.classList.remove('btn-hers-outline');
                        btnFilterProduct.classList.add('btn-hers');

                        btnFilterTreatment.classList.remove('btn-hers');
                        btnFilterTreatment.classList.add('btn-hers-outline');

                        $('.items').slimScroll({
                            height: '630px'
                        });

                        kali = 0;

                        $('#btnLoadMoreData').attr('data-category', product);

                        let countItem = $('.hitung-item').length;

                        if (countItem < 8) {
                            $('#btnLoadMoreData').remove();
                        }
                    } else {
                        alert('fail');
                    }

                    $('#loading').hide();
                }
            });
        });

        btnBackToDefault.addEventListener('click', function() {
            search_items.value = "";
            $.ajax({
                method: "POST",
                url: base_url + 'cashier/filter',
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    let data = JSON.parse(response);

                    if (data.statusCode == 200) {
                        items.innerHTML = data.html;

                        btnFilterProduct.classList.remove('btn-hers');
                        btnFilterProduct.classList.add('btn-hers-outline');

                        btnFilterTreatment.classList.remove('btn-hers');
                        btnFilterTreatment.classList.add('btn-hers-outline');

                        $('.items').slimScroll({
                            height: '630px'
                        });

                        kali = 0;

                        let countItem = $('.hitung-item').length;

                        if (countItem < 8) {
                            $('#btnLoadMoreData').remove();
                        }
                    }

                    $('#loading').hide();
                }
            });
        });

        inputSearchItems.addEventListener('keyup', function() {
            let searchVal = this.value;
            let searchValTemp = searchVal.split(' ').join('%20');

            if (searchValTemp != '') {


                $.ajax({
                    method: "POST",
                    url: base_url + 'cashier/search/' + searchValTemp,
                    beforeSend: function() {

                    },
                    success: function(response) {
                        let data = JSON.parse(response);

                        if (data.statusCode == 200) {
                            items.innerHTML = data.html;

                            $('.items').slimScroll({
                                height: '630px'
                            });

                            kali = 0;


                            let countItem = $('.hitung-item').length;

                            if (countItem < 8) {
                                $('#btnLoadMoreData').remove();
                            }

                            btnFilterProduct.classList.remove('btn-hers');
                            btnFilterProduct.classList.add('btn-hers-outline');

                            btnFilterTreatment.classList.remove('btn-hers');
                            btnFilterTreatment.classList.add('btn-hers-outline');
                        }
                    }
                });
            } else {
                $.ajax({
                    method: "POST",
                    url: base_url + 'cashier/filter',
                    beforeSend: function() {

                    },
                    success: function(response) {
                        let data = JSON.parse(response);

                        if (data.statusCode == 200) {
                            items.innerHTML = data.html;

                            $('.items').slimScroll({
                                height: '630px'
                            });

                            kali = 0;

                            btnFilterProduct.classList.remove('btn-hers');
                            btnFilterProduct.classList.add('btn-hers-outline');

                            btnFilterTreatment.classList.remove('btn-hers');
                            btnFilterTreatment.classList.add('btn-hers-outline');
                        }
                    }
                });
            }
        });


        //load more data
        let perPage = 8 / 2;
        let total_pages = Number('<?php isset($total_product) ? print $total_product : "" ?>');

        $(document).on('click', '#btnLoadMoreData', function() {

            let page = Number($('#btnLoadMoreData').data('page'));
            let jenis_kategori = $('#btnLoadMoreData').data('category');
            let search_val = $('#searchItems').val();
            let searchValTemp = search_val.split(' ').join('%20');
            let status_pay = Number($('.status_pay').val());
            //console.log(search_val);
            if (page < total_pages - 1) {

                kali = kali + 2;
                page = page * kali;

                // if (jenis_kategori == undefined) {
                //     if (search_val == '') {
                //         loadMoreData(page, status_pay);
                //     } else {
                //         loadMoreData(page, status_pay, '', searchValTemp);
                //     }
                // } else {
                //     loadMoreData(page, status_pay, jenis_kategori);

                // }

                loadMoreData(page, status_pay, jenis_kategori, searchValTemp);




            }
            console.log(searchValTemp);
            console.log(jenis_kategori);
            $(this).remove();
            console.log(kali);





        });

        // $('.items').scroll(function() {

        //     if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {


        //         if (perPage < total_pages - 1) {
        //             loadMoreData(perPage);
        //             perPage = perPage * 2;
        //         }

        //         console.log($(this).scrollTop() + $(this).innerHeight());
        //         console.log($(this)[0].scrollHeight);



        //     }
        // });

        //cms
        //data pelanggan

        //condition if modal customer show
        $('#modalCustomer').on('shown.bs.modal', function() {
            loadDataCustomer();


        });

        $('.collapse').on('shown.bs.collapse', function() {
            $('#btnAddCustomer').text('Cancel');
        });

        $('.collapse').on('hidden.bs.collapse', function() {
            $('#btnAddCustomer').html('<i class="fa fa-plus mr-2"></i>New Customer');

        });

        //add data customer
        $(document).on('submit', '#formAddCustomer', function(e) {
            e.preventDefault();
            let data = $(this).serialize();

            $.ajax({
                url: base_url + 'customer/insert',
                method: "POST",
                data: data,
                beforeSend: function() {

                },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.statusCode == 200) {
                        loadDataCustomer();
                        $('#formAddCustomer')[0].reset();
                    } else if (data.statusCode == 201) {
                        // do something
                    } else {
                        if (data.error == true) {
                            if (data.name_error != '') {
                                $('#name_error').html(data.name_error);

                            } else {
                                $('#name_error').html('');
                            }

                            if (data.phone_error != '') {
                                $('#phone_error').html(data.phone_error);
                            } else {
                                $('#phone_error').html('');
                            }
                        }
                    }

                }
            });
        });

        //show form edit
        $(document).on('click', '#btnEditCustomer', function() {
            let id = $(this).data('id');

            if ($('.data-space' + id).is(':hidden')) {
                $('.edit-space' + id).hide();
                $('#btnSubmitEditCustomer' + id).hide();
                $('.data-space' + id).show();
                $('.edit-btn-space' + id + ' #btnEditCustomer').removeClass('fa-chevron-down').addClass('fa-chevron-right');
            } else {
                $('.edit-space' + id).show();
                $('#btnSubmitEditCustomer' + id).show();
                $('.data-space' + id).hide();
                $('.edit-btn-space' + id + ' #btnEditCustomer').removeClass('fa-chevron-right').addClass('fa-chevron-down');

            }



        });



        //update data customer
        $(document).on('click', '.btnSubmitEditCustomer', function() {
            let id = $(this).data('id');
            let name = $('#nameEditCustomer' + id).val();
            let phone = $('#phoneEditCustomer' + id).val();
            let email = $('#emailEditCustomer' + id).val();

            $.ajax({
                url: base_url + 'customer/update/' + id + '/' + name + '/' + phone + '/' + email,
                method: "POST",
                beforeSend: function() {

                },
                success: function(response) {
                    let data = JSON.parse(response);

                    if (data.statusCode == 200) {
                        //alert('berhasil');
                        $('.data-space' + id + ' .customer-name').text(name);
                        $('.data-space' + id + ' .customer-phone').text(phone);
                        $('.data-space' + id + ' .customer-email').text(email);
                        $('.edit-space' + id).hide();
                        $('#btnSubmitEditCustomer' + id).hide();
                        $('.data-space' + id).show();
                        $('.edit-btn-space' + id + ' #btnEditCustomer').removeClass('fa-chevron-down').addClass('fa-chevron-right');
                    }
                }
            });
        });

        jQuery(document).on('click', '#rowCustomer', function() {
            let id = jQuery(this).data('id');
            let name = jQuery(this).data('name');
            let id_queue = jQuery(this).data('queue');
            let phone = jQuery(this).data('phone');


            jQuery.ajax({
                url: base_url + 'customer/add_treatment/' + id_queue,
                method: "POST",
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    let data = JSON.parse(response);

                    if (data.statusCode == 200) {
                        $('.customer-name-space').text(name);
                        $('.customer-id-space').val(id);
                        $('.customer-phone').val(phone);

                        loadDataTableCart('cashier/loadDataTableCart');
                        loadTotVal('cashier/loadTotVal');
                        let cekStock = data.sisaStock;
                        for (var i = 0; i < cekStock.length; i++) {
                            console.log(cekStock[i].sisaStock);
                            $('.button' + cekStock[i].idProduct + ' button').data('stock', cekStock[i].sisaStock);
                            $('.button' + cekStock[i].idProduct + ' button').attr('data-stock', cekStock[i].sisaStock);
                            $('#sisaStock' + cekStock[i].idProduct + ' span').text('Stock : ' + cekStock[i].sisaStock);
                        }

                        if (!$('#btnClearCustomer').length) {
                            $('.customer-space').append('<i class="fa fa-times text-danger ml-3" id="btnClearCustomer" style="font-size: 18px; cursor: pointer;"></i>');
                        }

                        $('#btnPay').removeAttr('disabled');
                        $('#itemCode').focus();
                        clearFormAddToCart();
                        $('#loading').hide();
                        $('#modalCustomer').modal('hide');
                        $('#id_queue_val').val(id_queue);

                        //console.log(cekStock[0].sisaStock);

                    }
                }
            });
        });

    });

    $(document).on('change', '#selectFilterActivity', function() {
        let value = $('#selectFilterActivity option:selected').val();
        if (value == "date") {
            $('#dateAreaa').show(600);
            $('#monthArea').hide();
            $('#yearArea').hide();
        } else if (value == "month") {
            $('#monthArea').show(600);
            $('#dateAreaa').hide();
            $('#yearArea').hide();
        } else {
            $('#yearArea').show(600);
            $('#monthArea').hide();
            $('#dateAreaa').hide();
        }

        $('.btn-submit-activity').show(600);
    });

    $('#filter-space').on('show.bs.collapse', function() {
        $('.btnFilterActivity').html('<i class="ti-close mr-2"></i>Close');
    });

    $('#filter-space').on('hide.bs.collapse', function() {
        $('.btnFilterActivity').html('<i class="ti-filter mr-2"></i>Filter');
    });

    $(document).on('submit', '#formFilterActivity', function(e) {
        e.preventDefault();
        let selectFilter = $('#selectFilterActivity option:selected').val();

        let data = $(this).serializeArray();
        console.log(data[1].value);
        $.ajax({
            method: "POST",
            url: base_url + 'activity/filter/' + selectFilter,
            data: data,
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(response) {
                $('.data-activity').html(response);
                $('#dataTableActivity').DataTable({
                    responsive: false
                });


                $('#loading').hide();
            }
        });
    });

    $(document).on('click', '.btnResetActivity', function() {
        $.ajax({
            method: "POST",
            url: base_url + 'activity/reset',
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(response) {
                $('.data-activity').html(response);
                $('#dataTableActivity').DataTable({
                    responsive: false
                });

                $('#filter-space').collapse('hide');


                $('#loading').hide();
            }
        });
        //alert('ok');
    });

    $(document).on('click', '#btnViewTransaction', function() {
        let id_customer = $(this).data('id');

        $.ajax({
            url: base_url + 'activity/get_customer_transaction',
            method: "GET",
            data: {
                id_customer: id_customer
            },
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(response, status, xhr) {
                $('#modalCustomerTransaction').html(response);
                $('#modal-customer-transaction').modal('show');
                //$('#modal-customer-transaction .modal-dialog').addClass('modal-dialog-scrollable');
                $('#loading').hide();
            },
            error: function(xhr, status, error) {
                VanillaToasts.create({
                    title: 'Error!',
                    text: error,
                    type: 'error',
                    positionClass: 'topRight',
                    timeout: 2000
                });
                $('#loading').hide();
            }
        });
    });

    //load data customer transaction
    // function loadDataCustomerTransaction()
    // {
    //     $.ajax({
    //         url: base_url + 'activity/load_customer_transaction',
    //         method: "GET,

    //     });
    // }

    //function helper
    function updateDataCustomer(id) {
        $(document).on('submit', '#formEditCustomer' + id, function(e) {
            e.preventDefault();

            alert('ok');
        });
    }

    //load data customer
    function loadDataCustomer() {
        $.ajax({
            url: base_url + 'customer',
            method: "POST",
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(response) {
                let data = JSON.parse(response);
                $('.customers-data').html(data.html);
                $('#dataTable3').DataTable({
                    responsive: false,
                    "order": [
                        [2, "asc"]
                    ], //or asc 
                    "columnDefs": [{
                        "targets": 2,
                        "type": "date-eu"
                    }],
                });

                $('#dataTable6').DataTable({
                    responsive: false,
                    "order": [
                        [2, "asc"]
                    ], //or asc 
                    "columnDefs": [{
                        "targets": 2,
                        "type": "date-eu"
                    }],
                });

                // $('.sorting_desc').hide();
                // $('.sorting_asc').hide();
                // $('.sorting_1').hide();
                // $('.sorting').hide();

                if (data.countCustomer > 1) {
                    $('.titleModalCustomer').text(data.countCustomer + ' Patients (In Queue)');
                } else if (data.countCustomer == 1) {
                    $('.titleModalCustomer').text(data.countCustomer + ' Patient (In Queue)');
                } else {
                    $('.titleModalCustomer').text('No Patient (In Queue)');
                }

                $('#loading').hide();

            }
        });
    }

    function cetakStruk() {
        $('.frame_space').html('<iframe src="' + base_url + '/cashier/invoice/' + $('#number_invoice').text() + '"' +
            'id="struk" name="struk" frameborder="0" style="display: none;"></iframe>');
        window.frames['struk'].print();
    }

    function loadFrames() {
        document.getElementById('struk').contentDocument.location.reload(true);
    }
    //load more data
    function loadMoreData(page, status_pay, category = '', search = '') {
        // let link_url = base_url + 'cashier/loadMoreData?page=' + page;

        // if (category != '') {
        //     link_url = base_url + 'cashier/loadMoreData?page=' + page + '&category=' + category;
        // }

        // if (search != '') {
        //     link_url = base_url + 'cashier/loadMoreData?page=' + page + '&search=' + search;
        // }
        var link_url = '';
        if (category == '' && search == '') {
            link_url = base_url + 'cashier/loadMoreData?page=' + page;
        } else if (category == '') {
            link_url = base_url + 'cashier/loadMoreData?page=' + page + '&search=' + search;
        } else {
            link_url = base_url + 'cashier/loadMoreData?page=' + page + '&category=' + category;
        }
        $.ajax({
            url: link_url,
            type: "GET",
            beforeSend: function() {

            },

            success: function(response) {
                let data = JSON.parse(response);

                if (data.statusCode == 200) {
                    $('.items').append(data.html);

                    $('.items').slimScroll({
                        height: '630px'
                    });

                    let countItem = $('.hitung-item').length;


                    if (countItem >= data.total_product) {
                        $('#btnLoadMoreData').hide();
                    }

                    if (status_pay == 1) {
                        $('.btnAddToCart').attr('disabled', true);
                    }
                }
            }
        });
    }


    //load data cart
    function loadDataTableCart(url) {
        $.ajax({
            type: "POST",
            url: base_url + url,
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(response) {
                $('#result-cart').html(response);
                $('#table-cart').slimScroll({
                    height: '300px',


                });

                $('#loading').hide();
            }
        });
    }

    //load data cart for edit
    function loadDataTableCartEdit(url) {
        $.ajax({
            method: "GET",
            url: base_url + url,
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(response) {
                $('#result-cart').html(response);
                $('#table-cart').slimScroll({
                    height: '300px',


                });

                $('#loading').hide();
            }
        })
    }

    function loadDataSessEditTransaction(url) {
        $.ajax({
            method: "GET",
            url: base_url + url,
            beforeSend: function() {
                //$('#loading').show();
            },
            success: function(response) {


                //$('#loading').hide();
            }
        })
    }

    //load totval
    function loadTotVal(url) {
        $.ajax({
            type: "POST",
            url: base_url + url,
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(response) {
                $('#totalValueModal').text(formatRupiah(response));
                $('#subtotal').val(response);
                $('#total').val(response);
                // if(response == 0) {
                //     $('#btnPay').attr('disabled', true);
                // }
                $('#loading').hide();

            }
        });
    }


    //format Rupiah
    function formatRupiah(angka, prefix = '') {

        var number_string = angka.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        //return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        return rupiah;
    }

    //format Rupiah
    function formatBackRupiah(angka, prefix = '') {

        var number_string = angka.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '' : '';
            rupiah += separator + ribuan.join('');
        }

        rupiah = split[1] != undefined ? rupiah + '' + split[1] : rupiah;
        //return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        return rupiah;
    }

    function testing() {
        $('.cart-space tbody').append('<td>Tes</td>' +
            '<td style="text-align: right;">100000</td>'
        );
    }


    //function for generate invoice random based on date
    function generateInvoice() {
        let d = new Date();
        let random = Math.floor(10000 + Math.random() * 90000);

        let year = d.getFullYear();
        let month = d.getMonth() + 1;
        let date = d.getDate();

        let invoice = 'TR' + year.toString() + month.toString() + date.toString() + random.toString();

        return invoice;
    }

    function clearCart() {
        $.ajax({
            method: "POST",
            url: base_url + 'cashier/clear_cart',
            beforeSend: function() {

            },
            success: function(data) {
                var data = JSON.parse(data);

                if (data.statusCode == 200) {
                    loadDataTableCart('cashier/loadDataTableCart');
                    loadTotVal('cashier/loadTotVal');
                    $('#number_invoice').text(generateInvoice());
                    $('.btnAddToCart').removeAttr('disabled');
                    $("#cash_payment_val").text("");
                    $("#money_change_val").text("");
                    $('#itemCode').removeAttr('readonly');
                    $('#struk').attr('src', base_url + 'cashier/struk/' + $('#number_invoice').text());
                    $('.customer-name-space').text('New Customer');
                    $('#btnClearCustomer').remove();
                    $('.customer-id-space').val("");
                    $('.status_pay').val(0);


                }
            }
        });
    }

    function clearFormAddToCart() {
        $('#qty_modal').val("1");
    }
</script>