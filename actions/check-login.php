<?php
require('../bootstrap.php');

if (signin_check($dbh)) {
    echo 1;
} else {
    echo 0;
}
