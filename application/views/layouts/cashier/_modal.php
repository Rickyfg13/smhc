<?php

if ($this->session->userdata('role') == 'cashier') {
    //modal bayar transaksi
    $this->load->view('pages/cashier/modal/modal_payment');
}


?>


<?php if ($this->session->userdata('role') == 'cashier') : ?>
    <!-- modal detail invoice -->
    <div id="modal_detail_invoice">

    </div>
<?php endif ?>
<?php


if ($this->session->userdata('role') == 'cashier') {
    //modal add to cart
    $this->load->view('pages/cashier/modal/modal_add_to_cart');
}
?>

<?php

if ($this->session->userdata('role') == 'cashier') {
    //modal cms
    $this->load->view('pages/customer/modal/modal_customer');
    $this->load->view('pages/cashier/modal/modal_reason_refund');
}

//modal add patient/customer
$this->load->view('pages/front-office/modal/modal_add_patient');

?>

<?php if ($this->session->userdata('role') == 'cashier') : ?>
    <div id="modal-edit-cashier-transaction">
        
    </div>

    <div id="modalCustomerTransaction">
        
    </div>

    <div id="modalEditPatient">
        
    </div>

    <div id="modalAddTherapist">
        
    </div>
<?php endif ?>