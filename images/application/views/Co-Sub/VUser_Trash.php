<table class="table table-hover table-bordered" >
    <thead>
        <tr>
            <th style="width:40px;">#</th>
            <th>Nama</th>
            <th>Username</th>
            <th>No.Handphone</th>
            <th style="width:170px;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
            if(!empty($DataUserTrash)){
                foreach ($DataUserTrash as $value) {?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->nama_user; ?></td>
                        <td><?php echo $value->username; ?></td>
                        <td><?php echo $value->telp_user; ?></td>
                        <td >
                            <a href="<?php echo site_url('Welcome/User_Restore/'. $value->id_user.''); ?>" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i>&nbsp; Restore</a>
                        </td>
                    </tr>
                <?php
                $i++;
            }}
        ?>
    </tbody>
</table>