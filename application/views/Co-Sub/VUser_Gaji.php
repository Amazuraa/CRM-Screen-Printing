<?php 
    $json_gaji = json_decode($DataUserGaji->user_gaji, true);
?>

<table class="table table-hover table-bordered" >
    <thead>
        <tr>
            <th style="width:40px;">#</th>
            <th>Detail</th>
            <th>Upah</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
            if(!empty($json_gaji)){
                foreach ($json_gaji as $key => $value) {?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $key; ?></td>
                        <td><?php echo $value; ?></td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm btn-update" data-toggle="modal" 
                                    data-target="#">
                                <i class="fa fa-pencil"></i>&nbsp; Ubah
                            </button>
                        </td>
                    </tr>
                <?php
                $i++;
            }}
        ?>
    </tbody>
</table>