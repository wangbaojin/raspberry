<?php 

file_put_contents("testaa.txt",$_POST, FILE_APPEND);
$a['status'] = 'success';
echo json_encode($a);


?>
