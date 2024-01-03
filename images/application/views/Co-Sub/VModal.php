<div class="modal inmodal" id="Modal-Main" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content animated fadeInLeft">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                	<span aria-hidden="true">&times;</span>
                	<span class="sr-only">Close</span></button>
                <h4 class="modal-title">Title</h4>
                <small class="font-bold">Pertanyaan singkat yang sering ditanyakan</small>
            </div>
            <div class="modal-body">
            	<div class="m-t-md">
                    <!-- Sub-Content -->
                    <?php $this->load->view($Sub_Modal_Content); ?>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>