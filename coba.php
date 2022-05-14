<?php
  include('./config/mail.php');
  
  if(mail("stefanus.adesetiawan@gmail.com", "Check Email", "A simple message.", $headers)){
      echo "Success";
  }else{
      echo "Failed";
  }
?>