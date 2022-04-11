<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Matrogob | Login</title>

    <link href="<?= base_url('template/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('template/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('template/img/icon.jpg') ?>" type="image/gif"> 
    <link href="<?=  base_url('template/css/animate.css')?>" rel="stylesheet">
    <link href="<?= base_url('template/css/style.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('template/css/plugins/sweetalert/sweetalert.css') ?>" rel="stylesheet">
   
</head>

<body class="white-bg" style="margin-top: -60px;">

    <div class="middle-box text-center loginscreen animated fadeInDown" style="margin-left: 250px">
        <div>
            <div>
                <h1 class="text-bold" style="margin-left: -100px; margin-top: 100px; font-size: 35px; font-weight: bold; color: #2C3E50 ;"><span style="margin-left: -350px;">Matrogob</span> <br><span style="margin-left: -360px;">Screen Printing</span> <br>

            </div>
             
            <span style="margin-left: -372px; position: absolute;"> 
                </span><br>
            
            <form class="m-t" action="<?= base_url('Login') ?>" method="post">
                
                <div class="form-group" style="margin-left: -130px; position:;">
                    <input style="background-color: #EAECEE; border: 1px; border-radius: 10px; margin-left: -92px; height: 50px; margin-top: 40px; position: absolute;"  type="text" class="form-control" name="txt_user" placeholder="Username" required="">
                </div>
                <br>
                <div class="form-group" style="margin-left: -130px;">
                    <input style="background-color: #EAECEE; border: 1px; border-radius: 10px; margin-left: -92px; height: 50px; position: absolute; margin-top: 100px;" type="password" class="form-control" name="txt_pass" placeholder="Password" required="">
                </div>
                <br>
               
                <input type="submit" name="btn_login" style="background-color: #2C3E50; margin-top: 150px; margin-left: -250px; color: white; width: 100px; border-radius: 10px; height: 40px; box-shadow: none;" value="Login" class="btn">
               
        
            </form>
            <div>
                <a style=" position: relative; margin-left: -250px; color: black; " href=""><small style="font-weight: bold;">Lupa Password?</small></a>
            </div>
        </div>
    </div>
    <div class="float-right">
        <img style="margin-right: -0px; margin-top: -550px;" sizes="1000" height="800px" width="" src="<?= base_url('template/img/dashboardlogo.jpg') ?>">
    </div>
    <!-- Mainly scripts -->
    <script src="<?= base_url('template/js/jquery-3.1.1.min.js'); ?>"></script>
    <script src="<?= base_url('template/js/bootstrap.js'); ?>"></script>
    <script src="<?php echo base_url('template/js/plugins/metisMenu/jquery.metisMenu.js');?>"></script>
    <script src="<?php echo base_url('template/js/plugins/slimscroll/jquery.slimscroll.min.js');?>"></script>
    
</body>

</html>
