<?php

//add category modal 
$this->load->view('pages/admin/category/modal/modal_add_category');

//add variant modal
$this->load->view('pages/admin/inventory/modal/modal_add_variant');

//add store modal
$this->load->view('pages/admin/store/modal/modal_add_store');
?>

<div id="modalEditCategory">

</div>

<div id="modalEditStore">

</div>

<div id="modalEditInventory">

</div>

<?php $this->load->view('pages/admin/discount/modal/modal_add_discount'); ?>

<div id="modalEditDiscount">

</div>

<?php $this->load->view('pages/admin/libraries/incoming_items/modal/modal_add_product_in'); ?>

<div id="modalEditProductIn">

</div>

<?php $this->load->view('pages/admin/doctor/modal/modal_add_doctor'); ?>

<div id="modalEditDoctor">

</div>

<?php $this->load->view('pages/admin/therapist/modal/modal_add_therapist'); ?>

<div id="modalEditTherapist">

</div>

<div id="modalAddSchedule">

</div>

<div id="modalViewSchedule">

</div>

<div id="modal_detail_refund">

</div>

<?php $this->load->view('pages/admin/libraries/move_items/modal/modal_move_items'); ?>