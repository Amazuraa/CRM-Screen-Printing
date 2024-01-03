<script>
	$(document).ready(function()
	{
		var btn_child = $(".btn-child");
		var btn_child_icon = $(".btn-child-icon");
		var btn_g_child = $(".btn-g-child");
		var btn_g_child_icon = $(".btn-g-child-icon");


		btn_child.click(function(){
			var idx = btn_child.index(this);

			btn_child_icon.eq(idx).toggleClass("fa-folder");
			btn_child_icon.eq(idx).toggleClass("fa-folder-open");

			$(".folder-child").eq(idx).toggle();
		});

		btn_g_child.click(function(){
			var idx = btn_g_child.index(this);

			btn_g_child_icon.eq(idx).toggleClass("fa-folder");
			btn_g_child_icon.eq(idx).toggleClass("fa-folder-open");

			$(".folder-g-child").eq(idx).toggle();
		});
	});
</script>

<div class="m-t-lg">
    <!-- <button class="btn btn-primary btn-block"><i class="fa fa-upload"></i>&nbsp; Import Data</button> -->
    <!-- <button class="btn btn-info btn-block"><i class="fa fa-download"></i>&nbsp; Export Data</button> -->
	
	<!-- <div class="hr-line-dashed m-b-xl"></div> -->

	<center><h3>Folder Pembukuan</h3></center>
	<div class="hr-line-dashed m-b-md"></div>
	<div id="" class="m-b-md">
	    <ul style="padding-left: 25px; padding-top: 10px;">
	        <li style="list-style: none;"><i class="fa fa-circle-o"></i>&nbsp; Pembukuan
	        <ul style="padding-left: 10px; padding-top: 5px;">
            	<?php
            		if (!empty($Map)) 
            		{
            			foreach ($Map as $key => $value) 
            			{
            	?>
	        			<li style="list-style: none;"> 
	        				<button class="btn btn-sm btn-link btn-child" style="padding-left: 10px; padding-top: 0;">
	        					<i class="fa <?php echo (stripslashes($key) == date('Y')) ? 'fa-folder-open' : 'fa-folder' ; ?> btn-child-icon"></i>
	        					&nbsp; <?php echo stripslashes($key); ?>
	        				</button>
		                <ul style="padding-left: 30px;" class="folder-child <?php echo (stripslashes($key) == date('Y')) ? '' : 'devMode' ; ?>">
	                    	<?php
	                    		foreach ($value as $readKey => $readVal) 
	                    		{
	                    	?>
	                    	
		                    	<li style="list-style: none;">
		                    		<button class="btn btn-sm btn-link btn-g-child" style="padding: 1px;">
		                    			<i class="fa fa-folder btn-g-child-icon"></i>
			        					&nbsp; <?php echo stripslashes($readKey); ?>
			        				</button>
		                    	<ul style="padding-left: 25px;" class="folder-g-child devMode">
		                    		<?php
			                    		foreach ($readVal as $lastVal) 
			                    		{
			                    	?>

			                    		<li style="list-style: none; padding-bottom: 5px;">
			                    			<a href="<?php echo site_url('Welcome/Pembukuan/'.$key.$readKey); ?>"
			                    				class="btn btn-sm btn-link" style="padding: 2px;">
			                    				<i class="fa fa-file-o"></i>
			                    				&nbsp; <?php echo $lastVal; ?>	
				                    		</a>
			                    		</li>

		                    		<?php
		                    			}
		                    		?>
		                    	</ul>
		                    	</li>

	                    	<?php
	                    		}
	                    	?>
		                </ul>
		                </li>
            	<?php
            			}
            		}
            	?>
            </ul>
	        </li>
	    </ul>
	</div>
</div>