<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>  
  <link rel="stylesheet" href="css/preparedcards.css"/>  
  <title>FantaZy Cards - Наши работы</title>  
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <!-- Add jQuery library -->  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Add fancyBox -->
  <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
  <script src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
  <!-- Optionally add helpers - button, thumbnail and/or media -->
  <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" media="screen" />
  <script src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
  <script src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
  <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" media="screen" />
  <script src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

  <script>
    $(document).ready(function() {
      $('nav li:nth-child(4)').addClass("activeNavItem");      
      $(".fancybox").fancybox( {
        padding: 10,
        beforeLoad: function() {          
          this.title = "<div class='aligntocenter'>\
                          <span class='formcall' onclick='callForm()'>Заказать</span>\
                        </div>\
                        <form onsubmit='return false'>\
                          <p>Ваши комментарии к заказу:<br/>\
                            <textarea name='comments'></textarea>\
                          </p>\
                          <p>Email:<br/>\
                            <input name='email' type='email' id='validateemail'>\
                          </p>\
                          <p id='tel'>Телефон:<br/>\
                            <input name='tel' type='tel'>\
                          </p>\
                            <input type='hidden' name='filename' value='" + $(this.element).data('filename') + "'>\
                            <input type='hidden' name='extension' value='" + $(this.element).data('extension') + "'>\
                              <div class='aligntocenter'>\
                                <input type='submit' value='Отправить заказ' class='formbutton' onclick='sendAjax()'>\
                              </div>\
                        </form>";                                                          
        },
        helpers : {
          title : {
              type: 'inside'
          },
          overlay: {
            locked: false
          }
        }                                        
      });  

      $('#close').click(function () {        
        $('#mask, #dialog').hide();
        document.body.style.overflow = 'auto';
      });

      $('#mask').click(function () {
          $(this).hide();
          $('#dialog').hide();
          document.body.style.overflow = 'auto';
      });            
    });
    
    function callForm() {
      $(".formcall").css("display", "none");
      $("form").css("display", "block");
      $( "textarea" ).focus();
      $.fancybox.update();
    }

    function isValidEmailAddress(emailAddress) {
      var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
      return pattern.test(emailAddress);
    }

    function sendAjax(){  
      var email = $("#validateemail").val();

      if (email == "" || !isValidEmailAddress(email)) {
        $("form input[name=email]").addClass("error");        
      } else {                    
        $.ajax({
          type: "POST",
          url: "order.php",
          data: $("form").serialize(),
          async: false,
          success: function(data) {
            if(data == "true") {
              modalWin("#dialog");
            } else {
              alert("Что-то пошло не так... Ваш заказ не был отправлен.\nИспользуйте телефон для оставления заказа!");
            }
            
            $("textarea[name=comments]").val("");
            $("form input[name=email]").val(""); 
            $("form input[name=tel]").val("");   
            if ($("form input[name=email]").hasClass("error")) {
              $("form input[name=email]").removeClass("error");              
            }        
            $(".formcall").css("display", "inline");
            $("form").css("display", "none");
            $.fancybox.update();
          }            
        });
      }                                  
    }     

    function modalWin(id){
      var windWidth = $(window).width();
      document.body.style.overflow = 'hidden';
      var maskHeight = $(window).height();
      var maskWidth = $(window).width();
      $('#mask').css({'width':maskWidth,'height':maskHeight, 'top':window.pageYOffset, 'left':0});            
      $('#mask').fadeTo("fast",0.7);
      $(id).css('top',  window.pageYOffset + maskHeight/2 - $(id).height());
      $(id).css('left', windWidth/2 - $(id).width()/1.8);
      $(id).fadeIn();
    }  
  </script>

</head>
<body>
  <div id="page_wrapper">

    <?php 
      include $_SERVER['DOCUMENT_ROOT']."/includes/header.html"; 
      include $_SERVER['DOCUMENT_ROOT']."/includes/navigation.html"; 
    ?>
    
    <div id='content_wrapper'> 
      <h1>Ознакомьтесь с нашими работами:</h1>   
      <?php      
        $directory = "img/portfolio/";
        $files = scandir($directory);                
        for ($i=0; $i < count($files); $i++) { 
          $currentFile = $files[$i];
          $ext = pathinfo($currentFile)['extension'];
          $nameWithoutExt = basename($currentFile,'.' . $ext);
          if ($currentFile != '.' && $currentFile != '..') {            
            echo "<div class='imgdiv'><a class='fancybox' rel='gallery' title=' ' href='" . 
                  $directory . $currentFile ."' data-filename='" . $nameWithoutExt . 
                  "' data-extension='" . $ext . "'><img src='" . $directory . 
                  $currentFile . "' alt='image-" . $nameWithoutExt . "'/></a></div>";            
          }        
        }                                      
      ?>
    </div>   
    <div id="before_footer"></div> 

    <?php include $_SERVER['DOCUMENT_ROOT']."/includes/footer.html"; ?>

  </div>

  <!--Модальное окно -->
  <div id="dialog">
    <p>Ваш заказ отправлен! <br/>
       В течение суток мы перезвоним Вам для уточнения всех деталей <br/>
       и для воплощения Вашего пожелания в реальность!!</p>
    <span id="close">Ок</span>
  </div>
  <div id="mask"></div>
</body>
</html>