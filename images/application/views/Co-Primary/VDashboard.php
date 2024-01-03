<?php ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h2>Presensi Pekerja</h2>
                    <div class="ibox-tools m-t-sm">
                        <button type="button" class="btn btn-xs" style="border-radius: 100px;" 
                                data-toggle="modal" data-target="#myModal">
                            &nbsp;<i class="fa fa-info" style="font-size: 13px; color: gray;"></i>&nbsp;
                        </button>
                    </div>
                </div>
                <div class="ibox-content sk-loading" style="padding-top: 0px; padding-left: 18px;">
                    <!-- Sub-Content -->
                    <?php $this->load->view($Sub_Spinner); ?>

                    <!-- Sub-Content -->
                    <?php $this->load->view($Sub_Presensi_User); ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h2>Chart Penjualan</h2>
                    <div class="ibox-tools m-t-sm">
                        <button type="button" class="btn btn-xs" style="border-radius: 100px;" 
                                data-toggle="modal" data-target="#myModal">
                            &nbsp;<i class="fa fa-info" style="font-size: 13px; color: gray;"></i>&nbsp;
                        </button>
                    </div>
                </div>
                <div class="ibox-content sk-loading" style="padding-top: 0px; padding-left: 18px;">
                    <!-- Sub-Content -->
                    <?php //$this->load->view($Sub_Spinner); ?>

                    <!-- Sub-Content -->
                    <?php $this->load->view($Sub_Chart_Penjualan); ?>
                </div>
            </div>
        </div>
    </div>
</div>