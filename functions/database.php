<?php
	$host	= "ar-rozzaq.mekanikserver.com";
	$uname	= "agrapana_dev";
	$pass	= "ontherock";
	$db 	= "agrapana_dev";
	$conn 	= mysqli_connect($host, $uname, $pass, $db);
	if (mysqli_connect_errno()) {
		echo "Koneksi Database Gagal : ".mysqli_connect_errno();
	}
?>
<!-- 
	~~~~~~~~~~~~~~~~~
	H : muhkanda.tech
	U : jwwunqak_simke
	P : @Adminer2019
	DB:jwwunqak_simke
	~~~~~~~~~~~~~~~~~
	H : remotemysql.com
	U : bSghyCT7Rh
	P : N4iw7pNeLr
	DB: bSghyCT7Rh
	~~~~~~~~~~~~~~~~~
	H : localhost
	U : root
	P : 
	DB: db_simke_local
	~~~~~~~~~~~~~~~~~
	/ ~
 -->