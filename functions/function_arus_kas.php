<?php

	require_once 'database.php';
	include_once 'helper.php';

	function getPeriode() {
		global $conn;
		$sql 	= "SELECT * FROM tb_arus_kas_periode ORDER BY id_periode DESC";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getAkun() {
		global $conn;
		$sql 	= "SELECT * FROM tb_akun ORDER BY id_akun DESC";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getTrans() {
		global $conn;
		$sql 	= "SELECT tb_transaksi.id_transaksi AS id_transaksi, tb_transaksi.keterangan AS keterangan,
					IF((SUM(tb_transaksi_detail.debit) IS NULL),0, SUM(tb_transaksi_detail.debit)) AS debit,
					IF((SUM(tb_transaksi_detail.kredit) IS NULL),0, SUM(tb_transaksi_detail.kredit)) AS kredit,
					IF((SUM(tb_transaksi_detail.debit) - SUM(tb_transaksi_detail.kredit) IS NULL),0, SUM(tb_transaksi_detail.debit) - SUM(tb_transaksi_detail.kredit)) AS total_trans
				FROM tb_transaksi
				LEFT JOIN tb_transaksi_detail ON tb_transaksi.id_transaksi = tb_transaksi_detail.id_transaksi
				GROUP BY tb_transaksi.id_transaksi";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getPeriodeDetail($id_periode) {
        global $conn;
        $fixid 	= mysqli_real_escape_string($conn, $id_periode);
        $sql    = "SELECT * FROM tb_arus_kas_periode WHERE id_periode='$fixid'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
    }

    function getDataak($id_periode) {
        global $conn;
        $fixid 	= mysqli_real_escape_string($conn, $id_periode);
        $sql    = "SELECT tb_arus_kas_data.id_ak_data AS id_ak_data,
						tb_arus_kas_data.id_periode AS id_periode,
						tb_arus_kas_data.tgl_masuk AS tgl_masuk,
						tb_arus_kas_data.saldo_awal AS saldo_awal,
						tb_arus_kas_data.saldo_akhir AS saldo_akhir,
						(SELECT IF((SUM(tb_transaksi_detail.debit) - SUM(tb_transaksi_detail.kredit) IS NULL),0, SUM(tb_transaksi_detail.debit) - SUM(tb_transaksi_detail.kredit)) FROM tb_transaksi
							LEFT JOIN tb_transaksi_detail ON tb_transaksi.id_transaksi = tb_transaksi_detail.id_transaksi WHERE tb_transaksi_detail.id_transaksi = tb_arus_kas_data.id_transaksi
							GROUP BY tb_transaksi.id_transaksi) AS bulan_berjalan,
						tb_akun.*
					FROM tb_arus_kas_data
						JOIN tb_akun ON tb_arus_kas_data.id_akun = tb_akun.id_akun
						JOIN tb_transaksi ON tb_arus_kas_data.id_transaksi = tb_transaksi.id_transaksi
						WHERE tb_arus_kas_data.id_periode='$fixid'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
    }

    function getdetailak($id_ak_data) {
        global $conn;
        $fixid 	= mysqli_real_escape_string($conn, $id_ak_data);
        $sql    = "SELECT * FROM tb_arus_kas_data WHERE id_ak_data='$fixid'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
    }

	function addPeriode($periode, $keterangan, $tgl_update) {
		global $conn;
		$sql 	= "INSERT INTO tb_arus_kas_periode (periode, keterangan, tgl_update) VALUES ('$periode','$keterangan','$tgl_update')";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function addaruskas($id_periode, $id_akun, $tgl_masuk, $saldo_awal, $id_transaksi, $saldo_akhir) {
		global $conn;
		$sql 	= "INSERT INTO tb_arus_kas_data (id_periode, id_akun, tgl_masuk, saldo_awal, id_transaksi, saldo_akhir) VALUES ('$id_periode', '$id_akun', '$tgl_masuk', '$saldo_awal', '$id_transaksi', '$saldo_akhir')";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function UpdateData($id_ak_data, $id_periode, $id_akun, $tgl_masuk, $saldo_awal, $id_transaksi, $saldo_akhir) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_ak_data);
		$sql 	= "UPDATE tb_arus_kas_data SET id_periode='$id_periode', id_akun='$id_akun', tgl_masuk='$tgl_masuk', saldo_awal='$saldo_awal', id_transaksi='$id_transaksi', saldo_akhir='$saldo_akhir' WHERE id_ak_data='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function deleteData($id_ak_data) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_ak_data);
		$sql 	= "DELETE FROM tb_arus_kas_data WHERE id_ak_data='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	if (isset($_POST['addak'])) {
        $id_periode         = mysqli_real_escape_string($conn, $_POST['id_periode']);
        $id_akun         	= mysqli_real_escape_string($conn, $_POST['id_akun']);
        $tgl_masuk         	= mysqli_real_escape_string($conn, $_POST['tgl_masuk']);
        $saldo_awal        	= mysqli_real_escape_string($conn, $_POST['saldo_awal']);
        $id_transaksi    	= mysqli_real_escape_string($conn, $_POST['id_transaksi']);
        $saldo_akhir        = mysqli_real_escape_string($conn, $_POST['saldo_akhir']);
        $add_ak            = addaruskas($id_periode, $id_akun, $tgl_masuk, $saldo_awal, $id_transaksi, $saldo_akhir);
        session_start();
        unset ($_SESSION["message"]);
        if ($add_ak) {
            $_SESSION['message'] = $added;
        }else {
            $_SESSION['message'] = $failed;
        }
        header("location:../detail_periode_kas.php?data=".$id_periode);
    }

    if (isset($_POST['updateak'])) {
		$id_ak_data 		= mysqli_real_escape_string($conn, $_POST['id_ak_data']);
        $id_periode         = mysqli_real_escape_string($conn, $_POST['id_periode']);
        $id_akun         	= mysqli_real_escape_string($conn, $_POST['id_akun']);
        $tgl_masuk         	= mysqli_real_escape_string($conn, $_POST['tgl_masuk']);
        $saldo_awal        	= mysqli_real_escape_string($conn, $_POST['saldo_awal']);
        $id_transaksi    	= mysqli_real_escape_string($conn, $_POST['id_transaksi']);
        $saldo_akhir        = mysqli_real_escape_string($conn, $_POST['saldo_akhir']);
		$updateak 			= UpdateData($id_ak_data, $id_periode, $id_akun, $tgl_masuk, $saldo_awal, $id_transaksi, $saldo_akhir);
		session_start();
		unset ($_SESSION["message"]);
		if ($updateak) {			
			$_SESSION['message'] = $edited;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../detail_periode_kas.php?data=".$id_periode);
	}


	if (isset($_POST['tambah_periode'])) {
		$periode			= mysqli_real_escape_string($conn, $_POST['periode']);
		$keterangan			= mysqli_real_escape_string($conn, $_POST['keterangan']);
		$tgl_update			= date('Y-m-d');
        $add          		= addPeriode($periode, $keterangan, $tgl_update);
		session_start();
		unset ($_SESSION["message"]);
		if ($add) {
			$_SESSION['message'] = $added;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../kelola_arus_kas.php");
	}

	if (isset($_GET['periode']) && isset($_GET['hapus'])) {
        $id_periode = $_GET['periode'];
        $id_ak_data = $_GET['hapus'];
        $del = deleteData($id_ak_data);
        session_start();
        unset ($_SESSION["message"]);
        if ($del) {         
            $_SESSION['message'] = $deleted;
        }else {
            $_SESSION['message'] = $failed;
        }
        header("location:../detail_periode_kas.php?data=".$id_periode);
    }


?>