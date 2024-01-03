<div class="m-t-md">
<form action="<?php echo site_url('Welcome/Produksi_AddPekerja'); ?>" method="post">

<?php 
    for($i = 0; $i < 10; $i++)
    {
?>
    <div class="faq-item devMode Pekerja-List" style="padding-top: 0px; padding-bottom: 0px;">
        <div>
            <a data-toggle="collapse" href="#pekerja<?php echo $i; ?>" class="faq-question">
            	<i class="fa fa-user"></i>&nbsp; <label class="Pekerja-Nama">-</label>
            </a>
            <small><i class="fa fa-clock-o"></i>
            	&nbsp; Bergabung di Produksi pada&nbsp; - &nbsp;<label class="Pekerja-Tanggal"></label>
            </small>
        </div>
        <div>
            <div id="pekerja<?php echo $i; ?>" class="panel-collapse collapse ">
                <div class="faq-answer" style="padding-top: 0px; padding-bottom: 0px;">
                	<p>
                    <table class="table table-bordered tab-presensi-parent">
					<tbody>
						<tr>
							<th class="bg-info" colspan="3">
								Data Presensi Produksi
							</th>
							<?php
								for ($j = 0; $j < 20; $j++)
								{ 
							?>
								<tr class="tab-presensi devMode" style="background-color: white;">
	    							<td width="30px;"><i class="fa fa-calendar-o"></i></td>
	    							<td><span class="tab-presensi-tgl">-</span></td>
	    							<td width="30px;"><i class="fa fa-check"></i></td>
	    						</tr>	
							<?php
								}
							?>
							
						</tr>
					</tbody>
                    </table>
                	</p>
                </div>
            </div>
        </div>
        <hr>
    </div>

<?php
    }
?>
	<div class="<?php echo ($userAkses == 'Pekerja') ? 'devMode' : '' ; ?>">
		<input type="text" name="input_id_produksi" class="input_id_produksi devMode">
		<center>
			<select class="select2 form-control m-t-sm" multiple="multiple" style="width: 87%;" 
					data-placeholder="&nbsp&nbsp&nbsp- Tenaga Kerja -&nbsp"
					name = "input_pekerja[]">

				<?php
				if(!empty($DataUser))
				{
					foreach($DataUser as $ReadDS)
					{
				?>
						<option value="<?php echo $ReadDS->id_user; ?>">
							<?php echo $ReadDS->nama_user; ?>
						</option>
				<?php
					}
				}
				?>
			</select>

		    <input type="submit" name="btn_simpan" class="btn btn-primary m-t-sm" value="Tambah Baru">&nbsp;
		</center>
	</div>
</form>

<hr class="m-t">

<?php
	if (!empty($DataProduksi)) 
	{
		foreach ($DataProduksi as $ReadDS) 
		{
?>
	<a class="btn btn-info btn-sm m-t-sm btn-presensi devMode" href="<?php echo site_url('Welcome/Produksi_Presensi/'.$ReadDS->id_produksi) ?>" style="width: 100%;">
		<span class="sp-no devMode"><i class="fa fa-arrow-circle-right"></i>&nbsp; Presensi Produksi</span>
		<span class="sp-yes devMode"><i class="fa fa-check"></i>&nbsp; Kamu Sudah Melakukan Presensi</span>
	</a>
<?php
		}
	}
?>
</div>