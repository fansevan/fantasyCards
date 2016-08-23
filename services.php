<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>  
  <link rel="stylesheet" href="css/services.css"/>  
  <title>FantaZy Cards - Наши услуги</title>    
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>    
  <script async src="scripts/dragmanager.js"></script>

  <script>    
    $(document).ready(function() {
      $('nav li:nth-child(2)').addClass("activeNavItem");      

      var $currentMenu;
      $('#content_wrapper li').click(function() {
        $this = $(this);
        if ($currentMenu == undefined) {
          $currentMenu = $this;
          $currentMenu.next().show("slow");
          $currentMenu.addClass("activeListItem");
        } else if ($currentMenu.get(0) != $this.get(0)) {
          $currentMenu.next().hide("slow");     
          $currentMenu.removeClass("activeListItem");                                         
          $currentMenu = $this;
          $currentMenu.next().show("slow");
          $currentMenu.addClass("activeListItem");
        } else {
          $currentMenu.next().hide("slow");
          $currentMenu.removeClass("activeListItem");   
          $currentMenu = undefined;
        }           
      });
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
      <ul>
        <li>Поздравительные открытки</li>
        <div class='divforp'>
          <p>
            Мы готовы воплотить Ваши фантазии в реальность! На нашем сайте Вы можете стать автором открытки. 
            Вы проектируете ее на сайте и отправляете нам заказ, а мы свяжемся с Вами в течение суток для 
            уточнения всех моментов. Также на сайте Вы можете просто выбрать понравившуюся Вам открытку из 
            предлагаемых в нашем портфолио и сделать заказ, сразу оставив свои дополнительные пожелания.
          </p>
          <div id='bigdiv'>
            <div class='imgdiv'> 
              <img src="img/services/01.jpg" alt='Пример1'/>
            </div>   
            <div class='imgdiv'> 
              <img src="img/services/02.jpg" alt='Пример2'/>
            </div>          
          </div>
        </div>
        <li>Пригласительные</li>
        <div class='divforp'>
          <p>
            Мы поможем создать Вам индивидуальные пригласительные для Вашего торжественного события – свадьбы, 
            дня рождения, новоселья – повод может быть любым. Получив пригласительное, созданное по индивидуальному 
            заказу, гость будет приятно удивлен и сделает всё возможное, чтобы посетить Ваше торжество.
          </p>
          <div id='bigdiv'>
            <div class='imgdiv'> 
              <img src="img/services/03.jpg" alt='Пример1'/>
            </div>   
            <div class='imgdiv'> 
              <img src="img/services/04.jpg" alt='Пример2'/>
            </div>          
          </div>
        </div> 
        <li>Оформление сертификатов</li>
        <div class='divforp'>
          <p>
            Возможно, Вы сами оказываете какие-то услуги? Тогда мы с радостью поможем Вам создать индивидуальные 
            сертификаты. В этом случае мы также постараемся учесть все моменты – вид деятельности, Ваш 
            корпоративный стиль и другие Ваши пожелания.
          </p>  
          <div id='bigdiv'>
            <div class='imgdiv'> 
              <img src="img/services/05.jpg" alt='Пример1'/>
            </div>   
            <div class='imgdiv'> 
              <img src="img/services/06.jpg" alt='Пример2'/>
            </div>          
          </div>       
        </div>
        <li>Упаковка подарка</li>
        <div class='divforp'>
          <p>
            Вы уже приобрели сам подарок? В этом случае мы готовы предложить Вам свои услуги по упаковке подарка 
            – ведь она тоже может быть особенной. Это может быть не просто упаковочная бумага и бантик. Мы поможем 
            Вам воплотить Ваши фантазии по упаковке подарка в реальность, сделаем для этого всё возможное.
          </p>
          <div id='bigdiv'>
            <div class='imgdiv'> 
              <img src="img/services/07.jpg" alt='Пример1'/>
            </div>   
            <div class='imgdiv'> 
              <img src="img/services/08.jpg" alt='Пример2'/>
            </div>          
          </div>        
        </div>
        <li>Украшение бутылок</li> 
        <div class='divforp'>   
          <p>
            Еще одно из наших направлений – декор бутылок. В этом случае полет фантазии точно может быть! Цвета, 
            фактура, краски, декор различными элементами!... Можете смело предлагать нам все Ваши идеи и затем 
            можете либо украсить Ваш интерьер, либо подарить такой особенный hand-made подарок.
          </p>  
          <div id='bigdiv'>
            <div class='imgdiv'> 
              <img src="img/services/09.jpg" alt='Пример1'/>
            </div>   
            <div class='imgdiv'> 
              <img src="img/services/10.jpg" alt='Пример2'/>
            </div>          
          </div> 
        </div>         
        <li>Украшение фужеров</li>  
        <div class='divforp'> 
          <p>
            Как правило, это делается для свадьбы. Поэтому, дорогие молодожены, можете обозначить нам Ваши 
            пожелания, описать, как будет проходить Ваша свадьба, а мы декорируем фужеры максимально подходящие 
            под Ваш стиль. Но также это можно делать не только на свадьбу, а, к примеру, на новоселье. 
            И в этом случае мы индивидуально подберем декор.
          </p>    
          <div id='bigdiv'>
            <div class='imgdiv'> 
              <img src="img/services/11.jpg" alt='Пример1'/>
            </div>   
            <div class='imgdiv'> 
              <img src="img/services/12.jpg" alt='Пример2'/>
            </div>          
          </div>         
        </div>
        <li>Создание декораций</li>   
        <div class='divforp'>   
          <p>
            Всё чаще в интернете мы видим, как красиво можно украсить интерьер в связи с различными 
            приближающимися праздниками. Венок – это, пожалуй, одно из самых распространенных украшений на 
            Новый год и Рождество. Рассказывайте, в каком стиле выполнена Ваша квартира, какие цвета преобладают, 
            а мы подберем Вам наиболее подходящий вид венка. А если Вы хотите преподнести его в качестве подарка 
            и не знаете никаких параметров, мы постараемся создать такой венок, который точно не оставит 
            равнодушным получателя и он обязательно найдет ему подходящее местечко в своей квартире.
          </p>       
          <div id='bigdiv'>
            <div class='imgdiv'> 
              <img src="img/services/13.jpg" alt='Пример1'/>
            </div>   
            <div class='imgdiv'> 
              <img src="img/services/14.jpg" alt='Пример2'/>
            </div>          
          </div>
        </div>
      </ul>
      <br/>       
      <p>
        *** Это тот перечень услуг, который в большей степени пользуется популярностью. Но всё зависит от Вас, 
        вернее, от Вашей фантазии! Включайте воображение, звоните нам и рассказывайте все Ваши идеи – наша 
        команда сделает всё возможное, чтобы воплотить Ваш индивидуальный заказ в реальность.
      </p>
    </div>  
    <div id="before_footer"></div>  

    <?php include $_SERVER['DOCUMENT_ROOT']."/includes/footer.html"; ?>
    
  </div>
</body>
</html>