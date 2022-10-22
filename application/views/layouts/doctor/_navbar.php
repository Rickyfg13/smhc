<div class="header-area header-bottom">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-9  d-none d-lg-block">
                <div class="horizontal-menu">
                    <nav>
                        <ul id="nav_menu">

                            <li class="<?= $nav_title == "doctor" ? "active" : ""  ?>">
                                <a href="<?= base_url('doctor'); ?>"><i class="ti-layout-grid2"></i>
                                    <span>Manage</span></a>

                            </li>

                            <li class="<?= $nav_title == "medical_records_history" ? "active" : ""  ?>">
                                <a href="<?= base_url('doctor/medical-records-history'); ?>"><i class="ti-view-list-alt"></i>
                                    <span>Medical Records History</span></a>

                            </li>


                            <!-- <li class="<?= $nav_title == "transaction_activity" ? "active" : "" ?>">
                                <a href="<?= base_url('activity'); ?>"><i class="ti-map-alt"></i> <span>Transaction Activity</span></a>
                            </li> -->
                        </ul>
                    </nav>
                </div>
            </div>
            
            <!-- mobile_menu -->
            <div class="col-12 d-block d-lg-none">
                <div id="mobile_menu"></div>
            </div>
        </div>
    </div>
</div>