<?php $Mode = $this->uri->segment(3); ?>

<script>
	$(document).ready(function()
	{
		// -------------------------------------------- DEV MODE
		var mode = '<?php echo $Mode; ?>';

		if (mode != 'Dev')
			$(".devMode").hide();
		
		$(".select2").select2();
	});
</script>

<script>
    $(document).ready(function()
	{
        var btn_update = $(".btn-update");

        btn_update.click(function(){
            var idx = parseInt(btn_update.index(this));
            var nama_user = $(".tab-nama-user").eq(idx).html();
            var telp_user = $(".tab-telp-user").eq(idx).html();
            var id_user   = $(".tab-id-user").eq(idx).html();

            $(".input-id-user").val( id_user );
            $(".input-nama-user").val( nama_user );
            $(".input-telp-user").val( telp_user );
        });
	});
</script>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">

        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h2>Daftar Tenaga Kerja</h2>
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

                    <div class="m-t-md">
	    				<div class="tabs-container">
	                        <ul class="nav nav-tabs" role="tablist">
	                            <li><a id="link-1" class="nav-link active" data-toggle="tab" 
	                            	   href="#tab-1">Active</a></li>
	                            <li><a id="link-2" class="nav-link" data-toggle="tab" 
	                            	   href="#tab-2">Inactive</a></li>
	                        </ul>
	                        <div class="tab-content">
	                            <div role="tabpanel" id="tab-1" class="tab-pane active">
	                                <div class="panel-body">
                                    <button type="button" class="btn btn-xs m-b-md" style="border-radius: 100px; float:right;" 
                                            data-toggle="modal" data-target="#<?php echo $Sub_Modal_IdAdd; ?>">
                                        &nbsp;<i class="fa fa-plus" style="font-size: 13px; color: gray;"></i>&nbsp; Tambah Baru &nbsp;
                                    </button>

	                  					<!-- Sub-Content -->
                                        <?php $this->load->view($Sub_Daftar_User); ?>  
	                                </div>
	                            </div>
	                            <div role="tabpanel" id="tab-2" class="tab-pane">
	                                <div class="panel-body">
	                                	<!-- Sub-Content -->
                                        <?php $this->load->view($Sub_Trash_User); ?>                  						
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h2>Konfigurasi Akses</h2>
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

                    <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php
                                if (!empty($DataUserConfig))
                                {
                                    $i = 1;
                                    foreach ($DataUserConfig as $read) 
                                    {
                            ?>
                                    <li>
                                        <a class="nav-link <?php echo ($i == 1)?'active':''; ?>" data-toggle="tab" 
                                           href="#akses-<?php echo $i; ?>">
                                            <?php echo $read->user_akses ?>
                                        </a>
                                    </li>
                            <?php
                                        $i++;
                                    }
                                }
                            ?>
                            
                            <li><a class="nav-link" data-toggle="tab" href="#akses-<?php echo $i; ?>">Buat Akses</a></li>
                        </ul>
                        <div class="tab-content">
                            <?php
                                if (!empty($DataUserConfig))
                                {
                                    $i = 1;
                                    foreach ($DataUserConfig as $read) 
                                    {
                            ?>
                                    <div role="tabpanel" id="akses-<?php echo $i; ?>" class="tab-pane <?php echo ($i == 1)?'active':''; ?>">
                                        <div class="panel-body">
                                            <?php 
                                                $sub['json_page'] = json_decode($read->user_page, true); 

                                                // Sub-Content
                                                $this->load->view($Sub_Akses_User, $sub);
                                            ?>
                                        </div>
                                    </div>
                            <?php
                                        $i++;
                                    }
                                }
                            ?>
                            
                            <div role="tabpanel" id="akses-<?php echo $i; ?>" class="tab-pane">
                                <div class="panel-body">
                                    B                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h2>Formula Upah Tenaga Kerja</h2>
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
                    <?php $this->load->view($Sub_Gaji_User); ?>      
                </div>
            </div>
        </div>

    </div>
</div>

<!-- FAQ-Content -->
<?php $this->load->view($Sub_FAQ); ?>

<!-- Modal-Content -->
<?php $this->load->view($Sub_Modal_Add); ?>
<?php $this->load->view($Sub_Modal_Update); ?>