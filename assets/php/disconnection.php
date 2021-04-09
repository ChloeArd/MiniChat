<?php
session_start();
// We destroy the variables of our session.
session_unset();
// We destroy our session.
session_destroy();

header("Location: ../../index.php");
