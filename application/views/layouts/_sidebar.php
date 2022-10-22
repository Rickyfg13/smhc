<div class="sidebar-menu bg-white-custom">
    <div class="sidebar-header bg-white-custom">
        <div class="logo bg-white-custom">
            <a href="index.html"><img src="<?= base_url() ?>assets/images/logo/logo.png" alt="logo"></a>
            <!-- <h2 class="" style="color: var(--primary-color);">Kasir<span style="color: var(--secondary-color); font-weight: bold;">Ku</span></h2> -->
            <h6 class="mt-3">Admin Panel</h6>
        </div>
    </div>
    <?php if ($this->session->userdata('role') == 'admin') : ?>
        <div class="main-menu">

            <div class="menu-inner">
                <div class="text-center">
                    <div class="d-flex justify-content-center">
                        <select class="form-control form-control-sm" style="border-top: 0;border-left: 0; border-right: 0; border-radius: 0; margin-right: 25px; margin-left: 25px; margin-bottom: 30px;" id="storeSelect">
                            <?php foreach (getStore() as $row) :  ?>
                                <option value="<?= $row['id_store']; ?>" <?php echo $this->session->userdata('id_store') == $row['id_store'] ? "selected" : "" ?>><?= $row['name_store']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                </div>
                <nav>
                    <ul class="metismenu" id="menu">
                        <li class="<?= $nav_title == "dashboard" ? "active" : "" ?>"><a href="<?= base_url("admin"); ?>"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>


                        <li class="<?= $nav_title == "library" ? "active" : "" ?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-package"></i><span>Library</span></a>
                            <ul class="collapse">
                                <li class="<?= $detail_title == "inventory" ? "active dust" : "" ?>"><a href="<?= base_url("admin/inventory"); ?>"><i class="ti-dropbox-alt mr-2"></i>Inventory</a></li>
                                <li class="<?= $detail_title == "incoming_items" ? "active dust" : "" ?>"><a href="<?= base_url("admin/libraries/incoming-items"); ?>"><i class="ti-tag mr-2"></i>Incoming Items</a></li>
                                <li class="<?= $detail_title == "move_items" ? "active dust" : "" ?>"><a href="<?= base_url("admin/libraries/move-items"); ?>"><i class="fa fa-mail-forward mr-2"></i>Move Items</a></li>
                                <li class="<?= $detail_title == "items_sales" ? "active dust" : "" ?>"><a href="<?= base_url("admin/libraries/items-sales"); ?>"><i class="fa fa-cubes mr-2"></i>Items Sales</a></li>

                            </ul>
                        </li>
                        <li class="<?= $nav_title == "refund" ? "active" : "" ?>"><a href="<?= base_url("admin/refund"); ?>"><i class="fa fa-reply"></i><span>Refund Transaction</span></a></li>

                        <li class="<?= $nav_title == "data_staff" ? "active" : "" ?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>Staff Data</span></a>
                            <ul class="collapse">
                                <li class="<?= $detail_title == "doctor" ? "active" : "" ?>"><a href="<?= base_url("admin/doctor"); ?>"><i class="fa fa-stethoscope"></i><span>Doctor</span></a></li>
                                <li class="<?= $detail_title == "therapist" ? "active" : "" ?>"><a href="<?= base_url("admin/therapist"); ?>"><i class="fa fa-heart-o"></i><span>Therapist</span></a></li>
                            </ul>
                        </li>
                        <!-- <li class="<?= $nav_title == "kasir" ? "active" : "" ?>"><a href="<?= base_url("cashier"); ?>" target="_blank"><i class="fa fa-barcode"></i><span>Cashier</span></a></li> -->
                        <li class="<?= $nav_title == "discount" ? "active" : "" ?>"><a href="<?= base_url("admin/discount"); ?>"><i class="fa fa-tags"></i><span>Add Discount</span></a></li>
                        <li class="<?= $nav_title == "schedule" ? "active" : "" ?>"><a href="<?= base_url("admin/schedule"); ?>"><i class="ti-time"></i><span>Add Doctor Schedule</span></a></li>
                        <li class="<?= $nav_title == "report" ? "active" : "" ?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-file-o"></i><span>Report</span></a>
                            <ul class="collapse">
                                <li class="<?= $detail_title == "report_sales" || $detail_title == "report_sales_product" || $detail_title == "report_sales_perdays" ? "active dust" : "" ?>">
                                    <a href="#"><i class="fa fa-file-text-o mr-2"></i>Sales Report</a>
                                    <ul class="collapse">
                                        <li class="<?= $detail_title == "report_sales" ? "active" : "" ?>"><a href="<?= base_url("admin/report/sales"); ?>"><i class="fa fa-file-text-o mr-2"></i>Based Invoice</a></li>
                                        <!-- <li class="<?= $detail_title == "report_sales_product" ? "active" : "" ?>"><a href="<?= base_url("admin/report/sales-product"); ?>"><i class="fa fa-file-text-o mr-2"></i>Based Products</a></li> -->
                                        <li class="<?= $detail_title == "report_sales_perdays" ? "active" : "" ?>"><a href="<?= base_url("admin/report/sales-perdays"); ?>"><i class="fa fa-file-text-o mr-2"></i>Per Days</a></li>
                                    </ul>
                                </li>

                                <!-- <li class="<?= $detail_title == "report_tracking_product" ? "active dust" : "" ?>"><a href="<?= base_url("admin/report/tracking-product"); ?>"><i class="fa fa-file-text-o mr-2"></i>Tracking Product Report</a></li> -->


                            </ul>
                        </li>
                        <li class="<?= $nav_title == "data_master" ? "active" : "" ?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-database"></i><span>Master Data</span></a>
                            <ul class="collapse">
                                <li class="<?= $detail_title == "category" ? "active dust" : "" ?>"><a href="<?= base_url("admin/category"); ?>"><i class="ti-tag mr-2"></i>Category</a></li>
                                <li class="<?= $detail_title == "store" ? "active dust" : "" ?>"><a href="<?= base_url("admin/store"); ?>"><i class="ti-home mr-2"></i>Store</a></li>


                            </ul>
                        </li>


                        <!-- <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Sidebar
                                Types
                            </span></a>
                        <ul class="collapse">
                            <li><a href="index.html">Left Sidebar</a></li>
                            <li><a href="index3-horizontalmenu.html">Horizontal Sidebar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Charts</span></a>
                        <ul class="collapse">
                            <li><a href="barchart.html">bar chart</a></li>
                            <li><a href="linechart.html">line Chart</a></li>
                            <li><a href="piechart.html">pie chart</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i><span>UI Features</span></a>
                        <ul class="collapse">
                            <li><a href="accordion.html">Accordion</a></li>
                            <li><a href="alert.html">Alert</a></li>
                            <li><a href="badge.html">Badge</a></li>
                            <li><a href="button.html">Button</a></li>
                            <li><a href="button-group.html">Button Group</a></li>
                            <li><a href="cards.html">Cards</a></li>
                            <li><a href="dropdown.html">Dropdown</a></li>
                            <li><a href="list-group.html">List Group</a></li>
                            <li><a href="media-object.html">Media Object</a></li>
                            <li><a href="modal.html">Modal</a></li>
                            <li><a href="pagination.html">Pagination</a></li>
                            <li><a href="popovers.html">Popover</a></li>
                            <li><a href="progressbar.html">Progressbar</a></li>
                            <li><a href="tab.html">Tab</a></li>
                            <li><a href="typography.html">Typography</a></li>
                            <li><a href="form.html">Form</a></li>
                            <li><a href="grid.html">grid system</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-slice"></i><span>icons</span></a>
                        <ul class="collapse">
                            <li><a href="fontawesome.html">fontawesome icons</a></li>
                            <li><a href="themify.html">themify icons</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-table"></i>
                            <span>Tables</span></a>
                        <ul class="collapse">
                            <li><a href="table-basic.html">basic table</a></li>
                            <li><a href="table-layout.html">table layout</a></li>
                            <li><a href="datatable.html">datatable</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="invoice.html"><i class="ti-receipt"></i> <span>Invoice Summary</span></a></li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>Pages</span></a>
                        <ul class="collapse">
                            <li><a href="login.html">Login</a></li>
                            <li><a href="login2.html">Login 2</a></li>
                            <li><a href="login3.html">Login 3</a></li>
                            <li><a href="register.html">Register</a></li>
                            <li><a href="register2.html">Register 2</a></li>
                            <li><a href="register3.html">Register 3</a></li>
                            <li><a href="register4.html">Register 4</a></li>
                            <li><a href="screenlock.html">Lock Screen</a></li>
                            <li><a href="screenlock2.html">Lock Screen 2</a></li>
                            <li><a href="reset-pass.html">reset password</a></li>
                            <li><a href="pricing.html">Pricing</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-exclamation-triangle"></i>
                            <span>Error</span></a>
                        <ul class="collapse">
                            <li><a href="404.html">Error 404</a></li>
                            <li><a href="403.html">Error 403</a></li>
                            <li><a href="500.html">Error 500</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-align-left"></i> <span>Multi
                                level menu</span></a>
                        <ul class="collapse">
                            <li><a href="#">Item level (1)</a></li>
                            <li><a href="#">Item level (1)</a></li>
                            <li><a href="#" aria-expanded="true">Item level (1)</a>
                                <ul class="collapse">
                                    <li><a href="#">Item level (2)</a></li>
                                    <li><a href="#">Item level (2)</a></li>
                                    <li><a href="#">Item level (2)</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Item level (1)</a></li>
                        </ul>
                    </li> -->
                    </ul>
                </nav>
            </div>
        </div>
    <?php endif ?>

    <?php if ($this->session->userdata('role') == 'admin_store') : ?>
        <div class="main-menu">

            <div class="menu-inner">
                <nav>
                    <ul class="metismenu" id="menu">



                        <li class="<?= $nav_title == "library" ? "active" : "" ?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-package"></i><span>Library</span></a>
                            <ul class="collapse">
                                <li class="<?= $detail_title == "inventory" ? "active dust" : "" ?>"><a href="<?= base_url("admin/inventory"); ?>"><i class="ti-dropbox-alt mr-2"></i>Inventory</a></li>
                                <li class="<?= $detail_title == "incoming_items" ? "active dust" : "" ?>"><a href="<?= base_url("admin/libraries/incoming-items"); ?>"><i class="ti-tag mr-2"></i>Incoming Items</a></li>
                                <li class="<?= $detail_title == "move_items" ? "active dust" : "" ?>"><a href="<?= base_url("admin/libraries/move-items"); ?>"><i class="fa fa-mail-forward mr-2"></i>Move Items</a></li>
                                <li class="<?= $detail_title == "items_sales" ? "active dust" : "" ?>"><a href="<?= base_url("admin/libraries/items-sales"); ?>"><i class="fa fa-cubes mr-2"></i>Items Sales</a></li>

                            </ul>
                        </li>
                        <li class="<?= $nav_title == "discount" ? "active" : "" ?>"><a href="<?= base_url("admin/discount"); ?>"><i class="fa fa-tags"></i><span>Add Discount</span></a></li>


                    </ul>
                </nav>
            </div>
        </div>
    <?php endif ?>

    <?php if ($this->session->userdata('role') == 'finance') : ?>
        <div class="main-menu">

            <div class="menu-inner">
                <nav>
                    <ul class="metismenu" id="menu">
                        <li class="<?= $nav_title == "dashboard" ? "active" : "" ?>"><a href="<?= base_url("admin"); ?>"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>

                        <li class="<?= $nav_title == "report" ? "active" : "" ?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-file-o"></i><span>Report</span></a>
                            <ul class="collapse">
                                <li class="<?= $detail_title == "report_sales" || $detail_title == "report_sales_product" || $detail_title == "report_sales_perdays" ? "active dust" : "" ?>">
                                    <a href="#"><i class="fa fa-file-text-o mr-2"></i>Sales Report</a>
                                    <ul class="collapse">
                                        <li class="<?= $detail_title == "report_sales" ? "active" : "" ?>"><a href="<?= base_url("admin/report/sales"); ?>"><i class="fa fa-file-text-o mr-2"></i>Based Invoice</a></li>
                                        <!-- <li class="<?= $detail_title == "report_sales_product" ? "active" : "" ?>"><a href="<?= base_url("admin/report/sales-product"); ?>"><i class="fa fa-file-text-o mr-2"></i>Based Products</a></li> -->
                                        <li class="<?= $detail_title == "report_sales_perdays" ? "active" : "" ?>"><a href="<?= base_url("admin/report/sales-perdays"); ?>"><i class="fa fa-file-text-o mr-2"></i>Per Days</a></li>
                                    </ul>
                                </li>

                                <!-- <li class="<?= $detail_title == "report_tracking_product" ? "active dust" : "" ?>"><a href="<?= base_url("admin/report/tracking-product"); ?>"><i class="fa fa-file-text-o mr-2"></i>Tracking Product Report</a></li> -->


                            </ul>
                        </li>




                    </ul>
                </nav>
            </div>
        </div>
    <?php endif ?>
</div>