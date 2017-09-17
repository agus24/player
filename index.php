<?php
require "boot.php";

Player::boot();

$files = Player::getFile();
return require "index.view.php";
