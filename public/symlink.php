


<?php


echo __DIR__ . '<br>';
echo $_SERVER['DOCUMENT_ROOT'];
$target = '/home/t/tives43092/laravel/storage/app/public';
$shortcut = '/home/t/tives43092/public_html/storage';
symlink($target, $shortcut);


