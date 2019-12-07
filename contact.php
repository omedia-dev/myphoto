<?php
	$data = file_get_contents('php://input');
	$exploded =  explode('&', $data);

	$_phone = explode('=', $exploded[0]);
	$_name = explode('=', $exploded[1]);
	$_address = explode('=', $exploded[2]);
	$_message = explode('=', $exploded[3]);

	for ($x = 4; $x < count($exploded); $x++) {
		$_photo[] = explode('=', $exploded[$x]);
	}

	foreach ($_photo as $ph) {
		$photo[] = $ph[1];
	}

	$name = $_name[1];
	$phone = $_phone[1];
	$msg = $_message[1];
	$address = $_address[1];
	$to = 'instamagnitik.cor@gmail.com';
	$from = 'zakaz@instamagnitik.ru';
	$subject = '=?UTF-8?B?'.base64_encode("Заказ с Instamagnitik.ru!").'?=';

	$body = "\nИмя: {$name}\nТелефон: {$phone}\nАдрес: {$address}\nКомментарий: \"{$msg}\"";

	email($from, $name, $to, $subject, $body, $photo);

	function email($mail_from, $from_name, $mail_to, $subject, $message, $file) {
		$uid = md5(time()); // Create unique boundary from timestamps 
		$headers = array();
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "From: {$from_name} <{$mail_from}>";
		$headers[] = "Reply-To: {$mail_from}";
		$headers[] = "Content-Type: multipart/message; boundary=\"{$uid}\"";
		$headers[] = "This is a multi-part message in MIME format.";
		$headers[] = "--{$uid}";
		$headers[] = "Content-Type:text/plain; charset=utf-8"; // Set message content type
		$headers[] = "Content-Transfer-Encoding: 7bit";
		$headers[] = $message; // Dump message

		if (count($file) > 0) {
			for ($i = 0; $i < count($file); $i++) {
				$headers[] = "--{$uid}";
				$file_name = "photo{$i}.png"; // Get file name
				$img = str_replace('data:image/png;base64,', '', $file[$i]);
				$img = str_replace(' ', '+', $img);
				$file_contents = chunk_split($img); 
				$headers[] = "Content-Type:image/png; name=\"{$file_name}\""; // Set content type and file name
				$headers[] = "Content-Transfer-Encoding: base64"; // Set file encoding base
				$headers[] = "Content-Disposition: attachment; filename=\"{$file_name}\""; // Set file Disposition
				$headers[] = $file_contents; // Dump file
			}
		}

		$headers[] = "--{$uid}--"; //End boundary

		if (mail($mail_to, $subject, '', implode("\r\n", $headers) )) {
			echo 'SUCCESS';
		} else {
			echo 'FAIL';
		}
	}
?>