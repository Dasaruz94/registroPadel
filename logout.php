<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 4/08/16
 * Time: 12:07 PM
 */




SESSION_START();

SESSION_UNSET();

SESSION_DESTROY();

header('Location: index.php?e=logout');
?>
