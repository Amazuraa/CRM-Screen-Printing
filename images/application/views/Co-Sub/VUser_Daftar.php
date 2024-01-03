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
            if(!empty($DataUser)){
                foreach ($DataUser as $value) {?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td class="tab-nama-user"><?php echo $value->nama_user; ?></td>
                        <td><?php echo $value->username; ?></td>
                        <td class="tab-telp-user"><?php echo $value->telp_user; ?></td>
                        <td >
                            <button type="button" class="btn btn-white btn-sm btn-update" data-toggle="modal" 
                                    data-target="#<?php echo $Sub_Modal_IdUpdate; ?>">
                                <i class="fa fa-pencil"></i>&nbsp; Ubah
                            </button>
                            <a href="<?php echo site_url('Welcome/User_Delete/'. $value->id_user.''); ?>" class="btn btn-white btn-sm"><i class="fa fa-eraser"></i>&nbsp; Hapus</a>
                        </td>
                        <td class="tab-id-user devMode"><?php echo $value->id_user; ?></td>
                    </tr>
                <?php
                $i++;
            }}
        ?>
    </tbody>
</table>