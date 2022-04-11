<?php 
    require('VFAQ_Pertanyaan.php'); 
    $main = null;

    if ($Mode_FAQ == "Produksi")
    {
        $x = file_get_contents("VFAQ_Test.json", true);
        $main = json_decode($x, true);
    }
?>

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content animated fadeInLeft">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                	<span aria-hidden="true">&times;</span>
                	<span class="sr-only">Close</span></button>

                <i class="fa fa-question-circle modal-icon m-l-lg"></i>
                <h4 class="modal-title"><?php echo $main['judul']; ?></h4>
                <small class="font-bold">Pertanyaan singkat yang sering ditanyakan</small>
            </div>
            <div class="modal-body">
            	<div class="m-t-md">
                    <?php 
                        print_r($main);
                    ?>

    				<div class="faq-item">
                        <div>
                            <a data-toggle="collapse" href="#faq1" class="faq-question">
                            	<i class="fa fa-angle-right"></i>
                            	&nbsp; Apa itu Tenaga Kerja?
                            </a>
                        </div>
                        <div>
                            <div id="faq1" class="panel-collapse collapse ">
                                <div class="faq-answer">
                                	<p>
                                        It is a long established fact that a reader will be distracted by the
                                        readable content of a page when looking at its layout. The point of
                                        using Lorem Ipsum is that it has a more-or-less normal distribution of
                                        letters, as opposed to using 'Content here, content here', making it
                                        look like readable English.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div>
                            <a data-toggle="collapse" href="#faq2" class="faq-question">
                            	<i class="fa fa-angle-right"></i>&nbsp; Bagaimana cara kerjanya?
                            </a>
                        </div>
                        <div>
                            <div id="faq2" class="panel-collapse collapse ">
                                <div class="faq-answer">
                                    <p>
                                        It is a long established fact that a reader will be distracted by the
                                        readable content of a page when looking at its layout. The point of
                                        using Lorem Ipsum is that it has a more-or-less normal distribution of
                                        letters, as opposed to using 'Content here, content here', making it
                                        look like readable English.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>