<?php
	require 'functions/function_pengguna.php';
	include_once 'layout/header.php';
	include_once 'layout/sidebar.php';
?>		
		<!-- BEGIN CONTEN -->
		<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
			<div class="ui container grid">
				<div class="row">
					<div class="fifteen wide computer sixteen wide phone centered column">
						<h2><i class="users cog icon"></i> FORM TAMBAH PENGGUNA</h2>
						<div class="ui divider"></div>
						<div class="ui grid">
							<div class="sixteen wide computer sixteen wide phone centered column">
								<form action="functions/function_pengguna.php" method="POST">
					                <div class="ui stacked segment">
					                    <div class="ui form">
					                        <div class="two fields">
					                            <div class="field">
					                                <label>PILIH PEGAWAI</label>
						                            <select name="id_pegawai" id="" class="ui dropdown">
						                            <?php $all = getPengguna();?>
									    			<?php foreach ($all as $data) { ?>
						                            	<option value="<?php echo $data['id_pegawai'] ?>"><?php echo $data['nama_lengkap'] ?></option>
						                            <?php } ?>
						                            </select>
					                            </div>
					                            <div class="field">
					                                <label>ROLE</label>
						                            <select name="role" id="" class="ui dropdown">
						                            	<option value="1">ADMIN</option>
						                            	<option value="2">AKUNTAN</option>
						                            	<option value="3">DIREKTUR</option>
						                            	<option value="4">MANAGER</option>
						                            </select>
					                            </div>
					                        </div>
					                        <div class="three fields">
					                        	<div class="field">
					                                <label>EMAIL</label>
					                                <input type="text" name="email" placeholder="">
					                            </div>
					                            <div class="field">
					                                <label>USERNAME</label>
					                                <input type="text" name="username" placeholder="">
					                            </div>
					                            <div class="field">
					                                <label>PASSWORD</label>
					                                <input type="password" name="password" placeholder="">
					                            </div>
					                        </div> 
					                    </div>
					                    <br>
					                    <input type="hidden" name="add">
					                    <button class="ui blue button">
					                        <i class="save icon"></i>
					                        SIMPAN
					                    </button>
					                    <a class="ui button" href="kelola_pengguna.php">
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