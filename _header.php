<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require 'vendor/autoload.php';
$entityManager = require 'bootstrap.php';

require 'Class/DateTimeFormat.php';
require 'Class/UserSession.php';
require 'Class/BaseHydrate.php';
$userSession = new UserSession();