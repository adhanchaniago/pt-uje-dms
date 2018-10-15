<?php  

	session_start();
	session_unset();

	$data['status'] = 'OK';
	$data['message'] = 'Terima kasih telah menggunakan PT. UJE Control Panel!';
	$data['url'] = '/login.php';

	echo json_encode($data);

?>