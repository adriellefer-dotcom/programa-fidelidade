<?php

session_start();

session_destroy();

header("Location: consulta.php");

exit();

?>