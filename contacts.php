<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>  
  <link rel="stylesheet" href="css/contacts.css"/>  
  <title>FantaZy Cards - Наши контакты</title>    
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <script>
    $(document).ready(function() {
      $('nav li:nth-child(5)').addClass("activeNavItem");      
    });
  </script>
</head>
<body>
  <div id="page_wrapper">
    
    <?php 
      include $_SERVER['DOCUMENT_ROOT']."/includes/header.html"; 
      include $_SERVER['DOCUMENT_ROOT']."/includes/navigation.html"; 
    ?>
    
    <div id="content_wrapper">        
        <p>Время работы 9:00-22:00</p>
        <div class='contacts'>
          <p>Иванов Иван<br/>lalala.lala@gmail.com<br/>+7-999-999-99-99</p>
        </div>
        <div class='contacts'>
          <p>Иванов Иван<br/>lalala.lala@gmail.com<br/>+7-999-999-99-99</p>
        </div>
        <div class='contacts'>
          <p>Иванов Иван<br/>lalala.lala@gmail.com<br/>+7-999-999-99-99</p>
        </div>
        <div class='contacts'>
          <p>Иванов Иван<br/>lalala.lala@gmail.com<br/>+7-999-999-99-99</p>
        </div>
        <p><a href="#">Группа ВК</a></p>              
    </div>    
    <div id="before_footer"></div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/includes/footer.html"; ?>

  </div>
</body>
</html>