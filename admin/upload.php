<?php   
  // Проверяем загружен ли файл
  if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
  {
    $directory = htmlspecialchars($_POST["directory"]);
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
    // Если файл загружен успешно, перемещаем его
    // из временной директории в конечную
    move_uploaded_file($_FILES["filename"]["tmp_name"], "../img/$directory/" . $_FILES["filename"]["name"]);
  } else {
    echo("Ошибка загрузки файла");
  }
  header("Location: " . $_SERVER["HTTP_REFERER"]);
  exit;
?>