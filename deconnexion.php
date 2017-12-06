<?php
  // Suppression du cookie "sid"
  setcookie('sid', '', -1);
  header('Location: index.php');
  exit();
?>