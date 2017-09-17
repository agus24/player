<?php
require "boot.php";

Player::boot();

$files = Player::getFile();

if(isset($_POST['req']))
{
    $req = $_POST['req'];
    if($req == 'download') {
        $command = '/usr/local/bin/node /usr/local/var/www/htdocs/music/downloader/index.js audio '.$_POST['link'];
        exec($command);
    }
    if($req == "getData"){
        echo json_encode(Player::getFile());
    }
}
else
{
    return require "index.view.php";
}
