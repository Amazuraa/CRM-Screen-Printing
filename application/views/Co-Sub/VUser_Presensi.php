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
    $(document).ready(function()
    {
        var btn_kehadiran   = $(".btn-kehadiran");
        var btn_produksi    = $(".btn-produksi");

        btn_kehadiran.click(function()
        {
            var idx = btn_kehadiran.index(this);

            $(".btn-kehadiran-icon").eq(idx).toggleClass("fa-caret-right");
            $(".btn-kehadiran-icon").eq(idx).toggleClass("fa-caret-down");
            
            $(".tab-produksi").eq(idx).hide();
            $(".tab-kehadiran").eq(idx).toggle();
        });

        btn_produksi.click(function()
        {
            var idx = btn_produksi.index(this);

            $(".btn-produksi-icon").eq(idx).toggleClass("fa-caret-right");
            $(".btn-produksi-icon").eq(idx).toggleClass("fa-caret-down");

            $(".tab-kehadiran").eq(idx).hide();
            $(".tab-produksi").eq(idx).toggle();
        });
    });
</script>

<table class="table table-hover table-bordered m-t-md">
    <thead>
        <tr>
            <th style="width:40px;">#</th>
            <th>Nama</th>
            <th class="text-center">Kehadiran</th>
            <th class="text-center">Produksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!empty($DataPresensi))
            {
                $i = 1;
                foreach ($DataPresensi as $read) 
                {
            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                            <?php 
                                foreach ($DataUser as $r) 
                                {
                                    if ($r->id_user == $read->id_user)
                                    {
                                        echo $r->nama_user;
                                        break;
                                    }
                                }
                            ?>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-link btn-sm btn-kehadiran" style="padding: 0;">
                                <i class="fa fa-caret-right btn-kehadiran-icon"></i>&nbsp;&nbsp; 
                                <?php
                                    $json_data_presensi = json_decode($read->data_presensi, true);
                                    echo count($json_data_presensi)." Hari";
                                ?>
                            </button>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-link btn-sm btn-produksi" style="padding: 0;">
                                <i class="fa fa-caret-right btn-produksi-icon"></i>&nbsp;&nbsp; 
                                <?php
                                    $json_data_presensi_produksi = json_decode($read->data_presensi_produksi, true);
                                    echo count($json_data_presensi_produksi)." Produksi";
                                ?>
                            </button>
                        </td>
                    </tr>
                    <tr class="tab-kehadiran devMode">
                        <td colspan="4">
                            <center>
                                <table class="table table-hover table-bordered m-t-xs" style="width: 80%;">
                                <tbody>
                                    <tr class="bg-info">
                                        <th style="width:40px;" class="text-center">#</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Jam</th>
                                    </tr>
                                    <?php
                                        $j = 1;
                                        foreach ($json_data_presensi as $r) 
                                        {
                                    ?>

                                    <tr>
                                        <td style="width:40px;" class="text-center"><?php echo $j; ?></td>
                                        <td class="text-center"><?php echo $r['tanggal']; ?></td>
                                        <td class="text-center"><?php echo $r['jam']; ?></td>
                                    </tr>

                                    <?php
                                            $j++;
                                        }
                                    ?>
                                </tbody>
                                </table>
                            </center>
                        </td>
                    </tr>
                    <tr class="tab-produksi devMode">
                        <td colspan="4">
                            <center>
                                <table class="table table-hover table-bordered m-t-xs" style="width: 80%;">
                                <tbody>
                                    <tr class="bg-info">
                                        <th style="width:40px;" class="text-center">#</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Jam</th>
                                    </tr>
                                    <?php
                                        $j = 1;
                                        foreach ($json_data_presensi_produksi as $r) 
                                        {
                                    ?>
                                    <tr>
                                        <td style="width:40px;" class="text-center"><?php echo $j; ?></td>
                                        <td class="text-center"><?php echo $r['id_produksi']; ?></td>
                                        <td class="text-center"><?php echo count($r['tanggal'])." Hari"; ?></td>
                                    </tr>
                                    <?php
                                            $j++;
                                        }
                                    ?>
                                </tbody>
                                </table>
                            </center>
                        </td>
                    </tr>
                <?php
                $i++;
            }}
        ?>
    </tbody>
</table>