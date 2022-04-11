<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrogob</title>
    <link href="<?php echo base_url('template/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('template/font-awesome/css/font-awesome.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('template/css/plugins/iCheck/custom.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('template/css/animate.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('template/css/style.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('template/css/plugins/chosen/bootstrap-chosen.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('template/css/plugins/jsTree/style.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('template/css/plugins/select2/select2.min.css');?>" rel="stylesheet">

    <!-- Ladda style -->
    <link href="<?php echo base_url('template/css/plugins/ladda/ladda-themeless.min.css');?>" rel="stylesheet">

    <script src="<?php echo base_url('template/js/jquery-3.2.1.min.js')?>"></script>

    <script src="<?php echo base_url('node_modules/html2canvas/dist/html2canvas.js')?>"></script>
    <script src="<?php echo base_url('node_modules/html2canvas/dist/html2canvas.esm.js')?>"></script>
    <script src="<?php echo base_url('node_modules/html2canvas/dist/html2canvas.min.js')?>"></script>

    <style type="text/css" media="print">
        th {
            -webkit-print-color-adjust: exact; 
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <?php $this->load->view($menu); ?>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#">
                            <i class="fa fa-bars"></i> 
                        </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="<?php echo base_url('Welcome/Logout');?>">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="wrapper wrapper-content">
                <!-- Content-->
                <?php $this->load->view($content); ?>
                <!-- end content -->
                <div class="footer">
                    <div>
                        <strong>Copyright</strong> Matrogob Screen Printing &copy; 2021
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Mainly scripts -->
 
    <script src="<?php echo base_url('template/js/popper.min.js');?>"></script>
    <script src="<?php echo base_url('template/js/bootstrap.js');?>"></script>
    <script src="<?php echo base_url('template/js/plugins/metisMenu/jquery.metisMenu.js');?>"></script>
    <script src="<?php echo base_url('template/js/plugins/slimscroll/jquery.slimscroll.min.js');?>"></script>

    <!-- Flot -->
    <script src="<?php echo base_url('template/js/plugins/flot/jquery.flot.js');?>"></script>
    <script src="<?php echo base_url('template/js/plugins/flot/jquery.flot.tooltip.min.js');?>"></script>
    <script src="<?php echo base_url('template/js/plugins/flot/jquery.flot.spline.js');?>"></script>
    <script src="<?php echo base_url('template/js/plugins/flot/jquery.flot.resize.js');?>"></script>
    <script src="<?php echo base_url('template/js/plugins/flot/jquery.flot.pie.js');?>"></script>
    <script src="<?php echo base_url('template/js/plugins/flot/jquery.flot.symbol.js');?>"></script>
    <script src="<?php echo base_url('template/js/plugins/flot/jquery.flot.time.js');?>"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url('template/js/inspinia.js');?>"></script>
    <script src="<?php echo base_url('template/js/plugins/pace/pace.min.js');?>"></script>

    <!-- jQuery UI -->
    <script src="<?php echo base_url('template/js/plugins/jquery-ui/jquery-ui.min.js');?>"></script>

    <!-- Datatables  -->
    <script src="<?php echo base_url('template/js/plugins/dataTables/datatables.min.js');?>"></script>
    <script src="<?php echo base_url('template/js/plugins/dataTables/dataTables.bootstrap4.min.js');?>"></script>

     <!-- Datepicker  -->
    <script src="<?php echo base_url('template/js/plugins/datapicker/bootstrap-datepicker.js');?>"></script>
    
     <!-- Clockpicker  -->
    <script src="<?php echo base_url('template/js/plugins/clockpicker/clockpicker.js'); ?>"></script>
    <script src="<?php echo base_url('template/js/plugins/jasny/jasny-bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('template/js/plugins/footable/footable.all.min.js') ?>"></script>

    <!-- Chosen -->
    <script src="<?php echo base_url('template/js/plugins/chosen/chosen.jquery.js') ?>"></script>

    <!-- iCheck -->
    <script src="<?php echo base_url('template/js/plugins/iCheck/icheck.min.js') ?>"></script>

    <!-- JS Tree -->
    <script src="<?php echo base_url('template/js/plugins/jsTree/jstree.min.js') ?>"></script>

    <!-- Select-2 -->
    <script src="<?php echo base_url('template/js/plugins/select2/select2.full.min.js') ?>"></script>

    <!-- Ladda -->
    <script src="<?php echo base_url('template/js/plugins/ladda/spin.min.js') ?>"></script>
    <script src="<?php echo base_url('template/js/plugins/ladda/ladda.min.js') ?>"></script>
    <script src="<?php echo base_url('template/js/plugins/ladda/ladda.jquery.min.js') ?>"></script>

    <style>
        .jstree-open > .jstree-anchor > .fa-folder:before {
            content: "\f07c";
        }

        .jstree-default .jstree-icon.none {
            width: 0;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });

        $('.chosen-select').chosen({width: "100%"});
        $('.chosen-select2').chosen({width: "100%"});

        $(document).ready(function(){
            $('#jstree1').jstree({
                'core' : {
                    'check_callback' : true
                },
                'plugins' : [ 'types', 'dnd' ],
                'types' : {
                    'default' : {
                        'icon' : 'fa fa-folder'
                    },
                    'html' : {
                        'icon' : 'fa fa-file-code-o'
                    },
                    'svg' : {
                        'icon' : 'fa fa-file-picture-o'
                    },
                    'css' : {
                        'icon' : 'fa fa-file-code-o'
                    },
                    'img' : {
                        'icon' : 'fa fa-file-image-o'
                    },
                    'js' : {
                        'icon' : 'fa fa-file-text-o'
                    }
                }
            });
        });        

    </script>
        
</body>
</html>
