<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>  
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>  
  <link rel="stylesheet" href="css/about.css"/> 
  <title>FantaZy Cards - Главная</title>    
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <script>
    $(document).ready(function() {
      $('nav li:nth-child(1)').addClass("activeNavItem");      
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
    	<p>
        Нет никого и ничего дороже, чем близкие нам люди. 
        И самое большое счастье – видеть их счастливые глаза 
        и дарить им радость. Подарки, подготовленные с любовью, 
        а главное, своими руками, помогут порадовать самых 
        дорогих и близких Вам людей!
      </p>
      <p>
        С FantaZy Cards у Вас есть уникальная возможность стать 
        дизайнером собственной открытки! Индивидуальные пожелания 
        по наполнению hand-made открытки Вы можете оставлять в 
        комментариях при создании он-лайн заказа, а также 
        связавшись с нами по телефону.
      </p>      
      <p>
        Мы предлагаем широкий спектр услуг, с полным перечнем которых 
        Вы можете ознакомиться в разделе «Наши услуги».        
      </p> 
      <div id='bigdiv'>
        <div class='imgdiv'> 
          <img src="img/about/1.jpg" alt='Пример1'/>
        </div>   
        <div class='imgdiv'> 
          <img src="img/about/2.jpg" alt='Пример2'/>
        </div>
        <div class='imgdiv'> 
          <img src="img/about/3.jpg" alt='Пример3'/>
        </div>
        <div class='imgdiv'> 
          <img src="img/about/4.jpg" alt='Пример4'/>
        </div>
      </div>          
      <p>
        А тем, кто хочет сам научиться воплощать свои идеи в 
        уникальные произведения искусства, мы предлагаем возможность 
        проведения персональных и групповых мастер классов! Вы 
        сможете посмотреть на работу нашего мастера, познакомиться с 
        различными материалами для проектирования hand-made открыток, 
        а самое главное – своими руками создать открытку для Ваших 
        родных и близких!
      </p>
      <p>
        Стоимость услуги рассчитывается индивидуально. После оформления 
        заказа наш администратор в течение суток свяжется с Вами для 
        уточнения всех деталей и пожеланий!
      </p>
    </div>    
    <div id="before_footer"></div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/includes/footer.html"; ?>   
  </div>
</body>
</html>