<?php
session_start(); // Always start session first
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location: ../index.php"); // Optional: redirect to homepage
exit;
?>