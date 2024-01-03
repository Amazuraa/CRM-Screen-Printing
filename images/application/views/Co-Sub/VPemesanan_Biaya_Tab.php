<script>
    $(document).ready(function(){
        var biaya_mode = '<?php echo $Mode_Biaya; ?>';

        if (biaya_mode == "Pembukuan")
        {   Mode_Pembukuan();   }
    });

    function Mode_Pembukuan()
    {
        $(".r-rumus").hide();
        $(".c-rincian").eq(8).hide();
        $(".c-rincian").eq(9).hide();
        $(".c-rincian").eq(10).hide();

        $(".tab-bahan").hide();
    }
</script>

<table class="table table-hover table-bordered">
    <thead>
        <tr style="height: 45px;">
            <th style="vertical-align: middle; background-color: #FFBF86; color: #B85C38;">
            	Rincian Pembiayaan</th>
            <th class="text-right" style="vertical-align: middle; background-color: #FFBF86; color: #B85C38;">
            	Biaya</th>
            <th class="text-center r-rumus" style="vertical-align: middle; background-color: #FFBF86; color: #B85C38;">
            	Rumus</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $FormulaBiaya = json_decode($DataFormula->biaya_formula, true);

		if(!empty($FormulaBiaya))
		{
			foreach($FormulaBiaya as $ReadDS)
			{
	?>
            <tr class="c-rincian">
                <td><?php echo $ReadDS['rincian']; ?></td>
                <td class="text-right"><?php echo number_format($ReadDS['biaya'],0,",","."); ?></td>
               	<td class="r-rumus"><?php echo $ReadDS['rumus']; ?></td>
            </tr>
    <?php
    		}
    	}
    ?>
    </tbody>
</table>

<table class="table table-hover table-bordered tab-bahan">
    <thead>
    <tr style="height: 45px;" class="daftar_bahan">
        <th style="vertical-align: middle; background-color: #BCFFB9; color: #055052;">
        	Daftar Bahan</th>
        <?php
            $DetailBahan = json_decode($DataBahan->detail_bahan, true);
			if(!empty($DetailBahan))
			{
				$DetailUkuran = json_decode($DetailBahan[0]['ukuran'], true);

				foreach($DetailUkuran as $ReadDS)
				{
		?>
				<th class="text-center" style="vertical-align: middle; background-color: #BCFFB9; color: #055052;"><?php echo $ReadDS; ?></th>
		<?php
				}
			}
		?>
    </tr>
    </thead>
    <tbody>
    <?php
		if(!empty($DetailBahan))
		{
			foreach($DetailBahan as $ReadDS)
			{
	?>
    <tr class="daftar_bahan">
        <td><?php echo $ReadDS['nama']; ?></td>
       	
       	<?php
			$DetailHarga = json_decode($ReadDS['harga'], true);
            $DetailUkuran = json_decode($ReadDS['ukuran'], true);

            $i = 0;
			foreach($DetailHarga as $read)
			{
		?>
			<td class="text-right"><?php echo number_format($read,0,",",","); ?></td>
		<?php
                $i++;
			}
		?>
    </tr>
    <?php
    		}
    	}
    ?>
    </tbody>
</table>

<table class="table table-hover table-bordered">
    <thead>
    <tr style="height: 45px;" class="daftar_polyfilm">
        <th style="vertical-align: middle; background-color: #A9F1DF; color: #34656D;">Daftar Biaya Polyfilm</th>
        <th class="text-right" style="vertical-align: middle; background-color: #A9F1DF; color: #34656D;">Biaya</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $FormulaSablon = json_decode($DataFormula->sablon_formula, true);
		if(!empty($FormulaSablon))
		{
			foreach($FormulaSablon as $ReadDS)
			{
	?>
    <tr class="daftar_polyfilm">
		<td><?php echo $ReadDS['ukuran']; ?></td>
		<td class="text-right"><?php echo number_format($ReadDS['polyfilm'],0,",",","); ?></td>
	</tr>
	<?php
			}
		}
	?>
    </tbody>
</table>

<table class="table table-hover table-bordered">
    <thead>
    <tr style="height: 45px;" class="daftar_tinta">
        <th style="vertical-align: middle; background-color: #FFAEC0; color: #9B5151;">
        	Daftar Tinta Sablon</th>
    	<?php
			if(!empty($DataTinta))
			{
				foreach($DataTinta as $ReadDS)
				{
		?>    
        <th class="text-right" style="vertical-align: middle; background-color: #FFAEC0; color: #9B5151;">
        	<?php echo $ReadDS->detail_tinta; ?></th>
        <?php
        		}
        	}
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
		if(!empty($FormulaSablon))
		{
			foreach($FormulaSablon as $ReadDS)
			{
				$Tinta = json_decode($ReadDS['tinta'], true);
	?>
    <tr class="daftar_tinta">
		<td><?php echo $ReadDS['ukuran']; ?></td>
		<?php
			if(!empty($Tinta))
			{
				foreach($Tinta as $read)
				{
		?>
			<td style="text-align: right;"><?php 
				echo number_format($read['biaya'],0,",",",");?></td>
        <?php
        		}
        	}
        ?>
		
	</tr>
	<?php
			}
		}
	?>
    </tbody>
</table>