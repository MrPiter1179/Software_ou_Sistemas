<?php
$con = mysqli_connect("localhost","root","","mokumbu");
if (mysqli_connect_errno())
  {
  echo "Falha na conexão com MySQL: " . mysqli_connect_error() ." | Contacta a equipe Mo-kumbu";
  }
?>