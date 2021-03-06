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
						<h2><i class="users cog icon"></i> FORM EDIT PENGGUNA</h2>
						<div class="ui divider"></div>
						<div class="ui grid">
							<div class="sixteen wide computer sixteen wide phone centered column">
								<form action="functions/function_pengguna.php" method="POST">
					                <div class="ui stacked segment">
					                    <div class="ui form">
					                    	<?php
					                    		$id 	= $_GET['id'];
					                    		$get 	= showData($id);
					                    	?>
					                    	<?php foreach ($get as $data) { ?>
					                        <div class="two fields">
					                            <div class="field">
					                                <label>EMAIL</label>
					                                <input type="text" name="email" placeholder="" value="<?= $data['email'] ?>">
					                            </div>
					                            <div class="field">
					                                <label>ROLE</label>
						                            <select name="role" id="" class="ui dropdown">
						                            	<?php $role = ($data['role'] == 1) ? 'ADMIN' : (($data['role'] == 2) ? 'AKUNTAN' : (($data['role'] == 3) ? 'DIREKTUR' : 'MANAGER')) ?>
						                            	<option value="<?= $data['role'] ?>" default><?= $role ?></option>
						                            	<option value="1">ADMIN</option>
						                            	<option value="2">AKUNTAN</option>
						                            	<option value="3">DIREKTUR</option>
						                            	<option value="4">MANAGER</option>
						                            </select>
					                            </div>
					                        </div>
					                        <div class="two fields">
					                            <div class="field">
					                                <label>USERNAME</label>
					                                <input type="text" name="username" placeholder="" value="<?= $data['username'] ?>">
					                            </div>
					                            <div class="field">
					                                <label>PASSWORD</label>
					                                <input type="password" name="password" placeholder="" value="" required="">
					                            </div>
					                        </div>
					                        <input type="hidden" name="id_pegawai" value="<?= $data['id_pegawai'] ?>"> 
					                        <?php } ?>
					                    </div>
					                    <br>
					                    <input type="hidden" name="edit">
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