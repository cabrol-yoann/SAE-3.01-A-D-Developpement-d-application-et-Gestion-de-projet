<?php
$path_parts = pathinfo("/forum/index.php");
echo '<pre>';
print_r($path_parts); // Affiche Array ( [dirname] => /forum [basename] => index.php [extension] => php )
echo '</pre>';
?>