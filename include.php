<?php
session_start();
default("ROOT",dirname(_FILE_));
set_include_path(".".PATH_SEPARATOR.ROOT."/configs".PATH_SEPARATOR.get_include_path());
require_once'configs.php';
?>