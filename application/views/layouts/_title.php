<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left"><?= $title; ?></h4>
                <ul class="breadcrumbs pull-left">
                    <?php foreach ($this->uri->segments as $segment) :  ?>
                        <?php
                        $url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
                        $is_active =  $url == $this->uri->uri_string;
                        ?>

                        <?php if (!$is_active) : ?>
                            <!-- tidak aktif -->
                            <li><a href="<?= base_url($url); ?>"><?= $segment == 'admin' ? 'Dashboard' : ucfirst($segment); ?></a></li>
                        <?php else : ?>
                            <!-- aktif -->
                            <li><span><?= $segment == 'admin' ? 'Dashboard' : ucfirst($segment); ?></span></li>
                        <?php endif ?>


                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                <img class="avatar user-thumb" src="<?= base_url(); ?>assets/images/author/avatar.png" alt="avatar">
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?= $this->session->userdata('name'); ?> <i class="fa fa-angle-down"></i></h4>
                <div class="dropdown-menu">
                    <!-- <a class="dropdown-item" href="#">My Profile</a> -->
                    <a class="dropdown-item" href="<?= base_url() . 'auth/logout' ?>">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>