<?php
require('vendor/autoload.php');
header("Content-Type: json");
use Cloutier\PhpIpfsApi\IPFS;
$ipfs = new IPFS("localhost", "8080", "5001");

$error = false;
$response = array();
if(isset($_FILES["file"]))
{
	if ($_FILES['file']['error'] != UPLOAD_ERR_OK)
	{
		$error = 'Upload failed';
	}
	elseif ($_FILES["file"]["tmp_name"] != "" && $_FILES["file"]["tmp_name"] != null)
	{
		$contents = file_get_contents($_FILES["file"]["tmp_name"]);
		if ($contents != false && strlen($contents) > 0)
		{
			$hash = $ipfs->add($contents);
			$response['status'] = 'success';
			$response['message'] = 'uploaded successfully';
			$response['hash'] = $hash;
		}
		else
		{
			$error = 'Upload error';
		}
	}
	else
	{
		$error = 'Upload error';
	}
}
else
{
	$error = 'No file uploaded';
}
if ($error)
{
	header('HTTP/1.1 400 Bad Request');
	echo $error;
}
else
{
	echo json_encode($response);
}
?>