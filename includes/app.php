<?php 

require 'functions.php';
require 'database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conect DB
use Model\ActiveRecord;
ActiveRecord::setDB($db);