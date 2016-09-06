<?php
header('Content-Type: text/html; charset=utf-8');
echo file_get_contents("http://jisho.org/api/v1/search/words?keyword=".$_GET['keyword']);

?>