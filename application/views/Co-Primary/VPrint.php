<?php $Mode = $this->uri->segment(3); ?>

<script>
	$(document).ready(function()
	{
		// -------------------------------------------- DEV MODE
		var mode = '<?php echo $Mode; ?>';

		if (mode != 'Dev')
			$(".devMode").hide();
	});
</script>

<script>
	function printDiv(divName) 
    {
    	if (document.getElementById('landscape-option').checked)
    	{
    		var css = '@page { size: landscape; }',
		    head = document.head || document.getElementsByTagName('head')[0],
		    style = document.createElement('style');

			style.type = 'text/css';
			style.media = 'print';

			if (style.styleSheet)
			  style.styleSheet.cssText = css;
			else
			  style.appendChild(document.createTextNode(css));
			
			head.appendChild(style);
    	}

         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }

    $(document).ready(function (){

        // Bind normal buttons
        Ladda.bind( '.ladda-button',{ timeout: 2000 });

        // Bind progress buttons and simulate loading progress
        Ladda.bind( '.progress-demo .ladda-button',{
            callback: function( instance ){
                var progress = 0;
                var interval = setInterval( function(){
                    progress = Math.min( progress + Math.random() * 0.1, 1 );
                    instance.setProgress( progress );

                    if( progress === 1 ){
                        instance.stop();
                        clearInterval( interval );
                    }
                }, 200 );
            }
        });


        var l = $( '.ladda-button-demo' ).ladda();

        l.click(function(){
            // Start loading
            l.ladda( 'start' );

            // Do something in backend and then stop ladda
            setTimeout(function(){
                html2canvas(document.getElementById("printableArea")).then(function(canvas){

	                var imageData = canvas.toDataURL("image/jpeg", 0.9);
	                var newData = imageData.replace(/^data:image\/jpeg/, "data:application/octet-stream");

	                $("#btn-download-act").attr("download", "Image_Name.png").attr("href", newData);
	                
	            });
            },500);

            setTimeout(function(){
                l.ladda('stop');

	            $("#btn-download-act").show();
	            $("#btn-download").hide();
            },2100);

        });
    });

</script>

<div class="wrapper wrapper-content animated fadeInRight">

	<div class="ibox-content">
		<button class="ladda-button ladda-button-demo btn btn-primary btn-outline" id="btn-download" data-style="zoom-in">
			<i class="fa fa-refresh"></i>&nbsp; Export Gambar
		</button>
		<a class="btn btn-primary btn-outline devMode" id="btn-download-act" href="#">
			<i class="fa fa-download"></i>&nbsp; Download Gambar
		</a>
		&nbsp;
		<button class="btn btn-primary btn-outline" onclick="printDiv('printableArea')">
			<i class="fa fa-print"></i>&nbsp; Print
		</button>
		&nbsp;
		<span class="i-checks">
			<label><input type="checkbox" id="landscape-option"> <i></i>&nbsp; Landscape Print</label>
		</span>
	</div>
    <div class="row printArea" id="printableArea">
	    <div class="col-lg-12">	
	        <div class="ibox-content p-xl">
                <?php $this->load->view($Sub_Content); ?>
         	</div>
	    </div>
	</div>
</div>