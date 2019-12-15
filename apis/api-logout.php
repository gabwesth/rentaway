<?php
// IT IS THE EASIEST PAGE
session_start(); // start remembering
// Forget everything about that specific browser
session_destroy(); 
header('Location: ../src/home-page/home-page.php');
