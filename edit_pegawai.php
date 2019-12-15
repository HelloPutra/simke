<?php
	require 'functions/function_pegawai.php';
	include_once 'layout/header.php';
	include_once 'layout/sidebar.php';

	if (isset($_POST['submit'])) {
		echo "SUBMITED";
	}

	$id = $_GET['edit'];
	$getPegawai = editData($id); $no = 1;
	foreach ($getPegawai as $data) {
?>		
		<!-- BEGIN CONTEN -->
		<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
			<div class="ui container grid">
				<div class="row">
					<div class="fifteen wide computer sixteen wide phone centered column">
						<h2><i class="users icon"></i> FORM TAMBAH PEGAWAI</h2>
						<div class="ui divider"></div>
						<div class="ui grid">
							<div class="sixteen wide computer sixteen wide phone centered column">
								<form action="functions/function_pegawai.php" method="POST">
					                <div class="ui stacked segment">
					                    <div class="ui form">
					                        <div class="two fields">
					                        	<input type="hidden" name="id_pegawai" value="<?= $data['id_pegawai'] ?>">
					                            <div class="field">
					                                <label>NIK</label>
					                                <input type="text" name="nik" placeholder="" maxlength="15" value="<?= $data['nik'] ?>">
					                            </div>
					                            <div class="field">
					                                <label>Status Pegawai</label>
						                            <select name="status_pegawai" id="" class="ui dropdown">
						                            	<option value="lama" <?=$data['status_pegawai'] == 'lama' ? 'selected' : '';?>>PEGAWAI LAMA</option>
						                            	<option value="baru" <?=$data['status_pegawai'] == 'baru' ? 'selected' : '';?>>PEGAWAI BARU</option>
						                            </select>
					                            </div>
					                        </div>
					                        <div class="two fields">
					                            <div class="field">
					                                <label>NAMA LENAGKAP</label>
					                                <input type="text" name="nama_lengkap" placeholder="" value="<?= $data['nama_lengkap'] ?>">
					                            </div>
					                            <div class="field">
					                                <label>NO HP</label>
					                                <input type="text" name="no_hp" placeholder="" maxlength="15" value="<?= $data['no_hp'] ?>">
					                            </div>
					                        </div> 
					                        <div class="two fields">
					                            <div class="field">
					                                <label>ALAMAT</label>
					                                <textarea name="alamat"> <?= $data['alamat'] ?></textarea>
					                            </div>
					                        </div>
					                    </div>
					                    <br>
					                    <input type="hidden" name="update">
					                    <button class="ui blue button">
					                        <i class="save icon"></i>
					                        SIMPAN
					                    </button>
					                    <a class="ui button" href="kelola_pegawai.php">
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