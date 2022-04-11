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

<?php 
    $json_user_config = json_decode($DataUserConfig->user_gaji, true); 
    $insentif   = $json_user_config['Insentif_Harian'];
    $akomodasi  = $json_user_config['Akomodasi_Harian'];
    $tunjangan  = $json_user_config['Tunjangan_Produksi'];
?>

<table class="table table-hover m-t-md">
    <thead>
        <tr>
            <th class="bg-success" style="width:40px;">#</th>
            <th class="bg-success">Nama Pekerja</th>
            <th class="text-center bg-success">Presensi Kerja</th>
            <th class="text-center bg-success" style="width: 130px;">Insentif Kerja</th>
            <th class="text-center bg-success" style="width: 130px;">Akomodasi Kerja</th>
            <th class="text-center bg-success" style="width: 110px;">Tunjangan</th>
            <th class="text-center bg-success">Produksi</th>
            <th class="text-center bg-success">Pendapatan</th>
            <th class="text-center bg-success">Akumulasi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $upah_pekerja = array();

            if(!empty($DataPresensi))
            {
                $i = 1;

                $detail_pekerja = array();

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
                                        $detail_pekerja['id_user'] = $r->id_user;
                                        $detail_pekerja['nama_user'] = $r->nama_user;

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
                                    $sum_presensi = count($json_data_presensi);
                                    $detail_pekerja['jumlah_presensi'] = $sum_presensi;

                                    echo $sum_presensi." Hari ";
                                ?>
                            </button>
                        </td>
                        <td class="text-right" style="background-color: #fafafa;">
                            <?php 
                                $sum_insentif = $sum_presensi * $insentif;
                                $detail_pekerja['insentif'] = $sum_insentif;

                                echo number_format($sum_insentif,0,",",","); ?> &nbsp; &nbsp;
                        </td>
                        <td class="text-right" style="background-color: #fafafa;">
                            <?php 
                                $sum_akomodasi = $sum_presensi * $akomodasi;
                                $detail_pekerja['akomodasi'] = $sum_akomodasi;

                                echo number_format($sum_akomodasi,0,",",","); ?> &nbsp; &nbsp;
                        </td>
                        <td class="text-right" style="background-color: #fafafa;">
                            <?php 
                                $sum_tunjangan = $sum_presensi * $tunjangan;
                                $detail_pekerja['tunjangan'] = $sum_tunjangan;

                                echo number_format($sum_tunjangan,0,",",","); ?> &nbsp; &nbsp;
                        </td>
                        <td class="text-center">
                            <button class="btn btn-link btn-sm btn-produksi" style="padding: 0;">
                                <i class="fa fa-caret-right btn-produksi-icon"></i>&nbsp;&nbsp; 
                                <?php
                                    $json_data_presensi_produksi = json_decode($read->data_presensi_produksi, true);
                                    $detail_pekerja['produksi'] = count($json_data_presensi_produksi);
                                    
                                    echo count($json_data_presensi_produksi)." Produksi";
                                ?>
                            </button>
                        </td>
                        <td class="text-right" style="background-color: #fafafa;">
                            <?php 
                                $pendapatan = 0;

                                foreach ($json_data_presensi_produksi as $read) 
                                {
                                    if ($read['pendapatan'] != "")
                                        $pendapatan += $read['pendapatan'];
                                }

                                $detail_pekerja['pendapatan'] = $pendapatan;
                                echo number_format($pendapatan,0,",",",");
                            ?> &nbsp; &nbsp;
                        </td>
                        <td class="text-right bg-info">
                            <?php 
                                $sum_akumulasi = $sum_insentif + $sum_akomodasi + $sum_tunjangan + $pendapatan;
                                $detail_pekerja['akumulasi'] = $sum_akumulasi;

                                echo number_format($sum_akumulasi,0,",",","); ?> &nbsp; &nbsp;
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
                                        <th class="text-center">Jumlah Hari</th>
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

                    array_push($upah_pekerja, $detail_pekerja);
                }
            }
        ?>
    </tbody>
</table>

<textarea class="devMode txt-upah-pekerja"><?php echo json_encode($upah_pekerja); ?></textarea>