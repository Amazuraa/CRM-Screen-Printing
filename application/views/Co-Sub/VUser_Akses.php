<table class="table table-hover table-bordered" >
    <thead>
        <tr>
            <th style="width:40px;">#</th>
            <th>Nama Page</th>
            <th style="width:100px;">Akses</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
            if(!empty($json_page)){
                foreach ($json_page as $read) {?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $read['Page']; ?></td>
                        <td><i class="fa fa-check"></i></td>
                    </tr>
                <?php
                $i++;
            }}
        ?>
    </tbody>
</table>