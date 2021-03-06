<?php
	require 'functions/function_arus_kas.php';
	include_once 'layout/header.php';
	include_once 'layout/sidebar.php';

	if (isset($_POST['submit'])) {
		echo "SUBMITED";
	}

	$id_ak_data = $_GET['id'];
	$getdetailak = getdetailak($id_ak_data); $no = 1;
	foreach ($getdetailak as $data) {
?>		
		<!-- BEGIN CONTEN -->
		<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
			<div class="ui container grid">
				<div class="row">
					<div class="fifteen wide computer sixteen wide phone centered column">
						<h2><i class="briefcase icon"></i> FORM ARUS KAS</h2>
						<div class="ui divider"></div>
						<div class="ui grid">
							<div class="sixteen wide computer sixteen wide phone centered column">
								<form action="functions/function_arus_kas.php" method="POST">
					                <div class="ui stacked segment">
					                	<input type="hidden" name="id_ak_data" value="<?= $id_ak_data ?>">
					                	<input type="hidden" name="id_periode" value="<?= $data['id_periode'] ?>">
					                    <div class="ui form">
				                            <div class="field">
				                                <label>Tanggal</label>
				                                <div class="ui calendar" id="standard_calendar">
				                                	<input type="text" name="tgl_masuk" placeholder="YYYY-MM-DD" value="<?= $data['tgl_masuk'] ?>">
				                                </div>
				                            </div>
				                            <div class="field">
				                                <label>Pilih Akun</label>
					                            <select name="id_akun" id="id_akun" class="ui dropdown">
					                            	<?php $getAkun = getAkun();
					                            		foreach ($getAkun as $i) { ?>
							                            	<option value="<?= $i['id_akun'] ?>" <?=$data['id_akun'] == $i['id_akun'] ? 'selected' : '';?>><?= $i['nama_akun'] ?> (<?= $i['kode_akun'] ?>)</option>
							                        <?php } ?>
					                            </select>
				                            </div>
				                            <div class="field">
				                                <label>Saldo Awal</label>
				                                <div class="ui right labeled input">
				                                	<label for="amount" class="ui label">Rp</label>
													<input type="number" name="saldo_awal" id="awal_saldo" placeholder="3000000" maxlength="15" value="<?= $data['saldo_awal'] ?>" onkeyup="hitung_total()">
				                                </div>
				                            </div>
				                            <div class="field">
				                                <label>Pilih Transaksi</label>
					                            <select name="id_transaksi" id="id_transaksi" class="ui dropdown">
					                            	<?php $getTrans = getTrans();
					                            		foreach ($getTrans as $t) { ?>
							                            	<option value="<?= $t['id_transaksi'] ?>" <?=$data['id_transaksi'] == $t['id_transaksi'] ? 'selected' : '';?>><?= $t['keterangan'] ?> (Rp<?= number_format($t['total_trans'], 0 , '' , '.' ) ?>)</option>
							                        <?php } ?>
					                            </select>
				                            </div>
				                            <div class="field">
				                                <label>Saldo Akhir</label>
				                                <div class="ui right labeled input">
				                                	<label for="amount" class="ui label">Rp</label>
													<input type="number" name="saldo_akhir" id="saldo_akhir" placeholder="3000000" maxlength="15" value="<?= $data['saldo_akhir'] ?>">
				                                </div>
				                            </div>
					                    </div>
					                    <br>
					                    <input type="hidden" name="updateak">
					                    <button class="ui blue button">
					                        <i class="save icon"></i>
					                        SIMPAN
					                    </button>
					                    <a class="ui button" href="detail_periode_kas.php?data=<?=$data['id_periode']?>">
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
	};
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