<?php   
  $directory = htmlspecialchars($_POST["directory"]);  
  $filename = htmlspecialchars($_POST["filename"]); 
  $extension = htmlspecialchars($_POST["extension"]);   

  switch ($directory) {
    case 'background':
      $directory = "cards/background";
      break;
    case 'flowers':
      $directory = "cards/flowers";
      break;
    case 'stickers':
      $directory = "cards/stickers";
      break;
    case 'strasses':
      $directory = "cards/strasses";
      break;    
    case 'woodenorns':
      $directory = "cards/woodenorns";
      break;    
  }

  if(unlink("../img/$directory/$filename.$extension")) {
     echo "true";
  } else {
     echo "false";
  }
?>