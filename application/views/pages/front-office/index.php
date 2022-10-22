<div class="main-content-inner">
    <div class="container-fluid">
        <div class="row">


            <!-- Statistics area start -->
            <div class="col-lg-7 col-md-6">
                <div class="card mt-4">
                    <div class="card-body">
                        <h4 class="header-title">List of Patients</h4>

                        <a href="<?= base_url("front-office/export-to-excel-patients"); ?>" class="btn btn-sm btn-rounded btn-success" id="btnExportToExcel"><i class="fa fa-file-excel-o mr-1"></i>Export to Excel</a>
                        <button class="btn btn-sm btn-rounded btn-hers-primary" id="btnAddPatientData" data-toggle="modal" data-target="#modalAddPatient"><i class="fa fa-plus mr-1"></i>Patient Data</button>
                        <div class="tableListPatients">
                            <div class="text-center">
                                <img src="<?= base_url("assets/images/load/load.svg"); ?>" style="width: 100px;" alt="load-animate">
                                <h6 class="mt-2">Please Wait...</h6>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- Statistics area end -->
            <!-- Advertising area start -->
            <div class="col-lg-5 col-md-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mt-4">

                            <div class="card-body">
                                <h4 class="header-title">Patient Queue (<?= date('d M Y'); ?>)</h4>

                                <div class="tableQueue">

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card mt-4">

                            <div class="card-body">
                                <h4 class="header-title">Add Therapist for This Queue (<?= date('d M Y'); ?>)</h4>

                                <div class="tableQueueProgress">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Advertising area end -->




        </div>
    </div>
</div>