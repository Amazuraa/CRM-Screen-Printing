<li class="nav-header">
    <div class="dropdown profile-element">
        <!-- <img alt="image" style="width: 120px; object-fit: contain;" 
             src="<?php echo base_url('images/spk_matrogob.png');?>"/> -->
             
        <a class="dropdown-toggle" href="">
        
            <span class="block m-t-xs font-bold"><i class="fa fa-user"></i> <?php echo $userNama; ?></span>
            <span class="text-muted text-xs block"><?php echo $userAkses; ?></span>
        </a>
    </div>
    <div class="logo-element">
        MT
    </div>
</li>

<?php 
    $json_page = json_decode($userPage, true);

    foreach ($json_page as $read) 
    {
?>
        <li>
            <a href="<?php echo base_url($read['Link']);?>">
                <i class="fa fa-home"></i> 
                <span class="nav-label"><?php echo $read['Page']; ?></span>  
            </a>
        </li>
<?php
    }
?>
