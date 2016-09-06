<?php
/**
 * File: proxy.php
 * This file exists to allow the server to communicate cross site to the jisho api site.
 * Javascript is unable to send a direct request due to chrome's security policies.
 * Somehow this workaround works. So eh.
 */
header('Content-Type: text/html; charset=utf-8');
echo file_get_contents("http://jisho.org/api/v1/search/words?keyword=".$_GET['keyword']);
?>
