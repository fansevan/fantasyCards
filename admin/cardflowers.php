<?php 
  require_once "start.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>  
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="../css/style.css"/>
  <link rel="stylesheet" href="admin.css"/>
  <title>Админ-панель: Цветы</title>     
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="functions.js"></script>  
</head>

<body>
  <div id="page_wrapper">
    <main>
      <div id="content_wrapper">
        <div id='tomain'>
          <a href="http://fantasy-cards.ru">На главную 'Fantasy-cards'</a>
        </div>
      	<h1>Цветы</h1><br/>
        <a href="index.php">Портфолио</a>
        <a href="cardbackground.php">Фон открытки</a>
        <a href="cardstickers.php">Наклейки</a>
        <a href="cardstrasses.php">Стразы</a>
        <a href="cardwoodenorns.php">Деревянные украшения</a><br/>
        <?php      
          $directory = "../img/cards/flowers/";
          $files = scandir($directory);                
          for ($i=0; $i < count($files); $i++) { 
            $currentFile = $files[$i];
            $ext = pathinfo($currentFile)['extension'];
            $nameWithoutExt = basename($currentFile,'.' . $ext);
            if ($currentFile != '.' && $currentFile != '..') {            
              echo "<div class='imgdiv'><img class='imgflowers' src='" . $directory . 
                    $currentFile . "' alt='image-" . $nameWithoutExt . "'/><p>" .
                    $currentFile . "<button onclick='deleteImage(\"flowers\", \"" . $nameWithoutExt . "\",\"" . 
                    $ext . "\");'>Удалить</button></p></div>";            
            }        
          }                                      
        ?> 
        <form action="upload.php" method="post" enctype="multipart/form-data">
          <input type="file" name="filename" accept="image/*" onchange="document.getElementById('uploadButton').style.display = 'inline';">
          <input type='hidden' name='directory' value='flowers'/>
          <input type="submit" value="Загрузить" id="uploadButton"><br>
        </form>          
      </div>
    </main>    
  </div>  
</body>
</html>