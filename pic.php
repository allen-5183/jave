<?php
  session_start();
  header("Content: image/png");
  $a = imagecreate(40, 30);
  $b = imagecolorallocate($a, 255,255,255);
  $c = imagecolorallocate($a, 0, 0, 0);

  $_SESSION['rnd'] = sprintf("%04d", rand(0, 10000));
  imagestring($a, 5, 0, 0, $_SESSION['rnd'], $c);
  imagepng($a);
?>