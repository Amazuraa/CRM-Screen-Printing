<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">

        <div class="col-lg-8">
            <div class="ibox ">
                <div class="ibox-title">
                    <h2>Konfigurasi Formula Sablon</h2>
                    <div class="ibox-tools m-t-sm">
                        <button type="button" class="btn btn-xs" style="border-radius: 100px;" 
                                data-toggle="modal" data-target="#myModal">
                            &nbsp;<i class="fa fa-info" style="font-size: 13px; color: gray;"></i>&nbsp;
                        </button>
                    </div>
                </div>
                <div class="ibox-content sk-loading">
                    <!-- Sub-Content -->
                    <?php $this->load->view($Sub_Spinner); ?>

                    <!-- Sub-Content -->
                    <?php $this->load->view($Sub_Biaya_Tab); ?>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- FAQ-Content -->
<?php $this->load->view($Sub_FAQ); ?>