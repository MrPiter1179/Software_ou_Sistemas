<?php
include("config.php");
session_start();
if(!isset($_SESSION["email"])){
header("Location: login.php");
exit();
}

$sess_email = $_SESSION["email"];
$sql = "SELECT user_id, pnome, snome, email, profile_path FROM usuarios WHERE email = '$sess_email'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $userid=$row["user_id"];
    $pnome = $row["pnome"];
    $snome = $row["snome"];
    $username =$row["pnome"]." ".$row["snome"];
    $useremail=$row["email"];
    $userprofile="uploads/".$row["profile_path"];
  }
} else {
    $userid="GHX1Y2";
    $username ="ProfPiter";
    $useremail="exemplo@dominio.com";
    $userprofile="Uploads/default_profile.png";
}
?>