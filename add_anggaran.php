<?php
	require 'functions/function_anggaran.php';
	include_once 'layout/header.php';
	include_once 'layout/sidebar.php';
	$periode = $_GET['periode'];
?>		
		<!-- BEGIN CONTEN -->
		<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
			<div class="ui container grid">
				<div class="row">
					<div class="fifteen wide computer sixteen wide phone centered column">
						<h2><i class="handshake outline icon"></i> FORM ANGGARAN</h2>
						<div class="ui divider"></div>
						<?php 
						$getRencana = getRencana();
						if ($getRencana) {
							$rencanaAnggaran = $getRencana[0]['total_trans'];
						}else{
							$rencanaAnggaran = 0;
						}

						?>
						<div class="ui grid">
							<div class="sixteen wide computer sixteen wide phone centered column">
								<form action="functions/function_anggaran.php" method="POST">
					                <div class="ui stacked segment">
					                	<input type="hidden" name="id_periode" value="<?=$periode?>">
					                	<input type="hidden" name="rencana_anggaran" value="<?=$rencanaAnggaran?>">
					                	<input type="hidden" name="realisasi_anggaran" value="0">
					                    <div class="ui form">
				                            <div class="field">
				                                <label>Rencana Anggaran</label>
				                                <h4>Rp<?=$rencanaAnggaran?></h4>
				                            </div>
				                            <hr>
				                            <div class="field">
				                                <label>Jenis Anggaran</label>
				                                <select name="id_jenis_anggaran" id="" class="ui dropdown">
					                            	<?php $jenis = getJenis(); foreach ($jenis as $jns) { ?>
					                            		<option value="<?= $jns['id_jenis_anggaran'] ?>"><?= $jns['pos_anggaran'] ?></option>
					                            	<?php } ?>
					                            </select>
				                            </div>
				                            <div class="field">
				                                <label>Status</label>
				                                <select name="status" id="status" class="ui dropdown">
				                            		<option value="Disetujui">Disetujui</option>
				                            		<option value="Tidak Disetujui">Tidak Disetujui</option>
					                            </select>
				                            </div>
					                    </div>
					                    <br>
					                    <input type="hidden" name="addag">
					                    <button class="ui blue button">
					                        <i class="save icon"></i>
					                        SIMPAN
					                    </button>
					                    <a class="ui button" href="detail_periode_anggaran.php?data=<?=$periode?>">
					                        <i class="cancel icon"></i>
					                        BATAL
					                    </a>
					                </div>
					            </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END CONTENT -->
<?php
	include_once 'layout/footer.php';
?>
<script type="text/javascript">
	$('#standard_calendar')
	  .calendar({
	  	monthFirst: false,
	    type: 'date',
	    today: 'true',
	    formatter: {
	        date: function (date, settings) {
	          if (!date) return '';
	               return date.toLocaleString('en-us', {year: 'numeric', month: '2-digit', day: '2-digit'}).replace(/(\d+)\/(\d+)\/(\d+)/, '$3-$1-$2');
	        }
	    }
	  })
	;

	// function hitung_total() {
	// 	var saldo_awal = parseInt(document.getElementById('awal_saldo').value);
	// 	var saldo_berjalan = parseInt(document.getElementById('bulan_berjalan').value);
	// 	var total_saldo = saldo_awal + saldo_berjalan;
	// 	// console.log(total_saldo);
	// 	document.getElementById("saldo_akhir").value = total_saldo;
	// }

	$(document).ready(function() {
		
	});
</script>