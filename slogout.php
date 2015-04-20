<?php
require_once 'core/init.php';
require 'steamauth/steamauth.php';
session_start();
session_destroy();
Redirect::to('index.php');