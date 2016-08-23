<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>  
  <link rel="stylesheet" href="css/createcards.css"/>  
  <title>FantaZy Cards - Создание открытки</title>  
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <!-- Add jQuery library -->  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>    
  
  <script async src="scripts/jqueryrotate2.js"></script>
  <script async src="scripts/html2canvas.js"></script>
  <script async src="scripts/dragmanager.js"></script>

  <script>    
    var $currentMenu;
    $(document).ready(function() {
      $('nav li:nth-child(3)').addClass("activeNavItem");
      $('#parametrs li').click(function() {
        $this = $(this);
        if ($currentMenu == undefined) {
          $currentMenu = $this;
          $currentMenu.next().slideDown("slow");
          $currentMenu.addClass("activeListItem");
        } else if ($currentMenu.get(0) != $this.get(0)) {
          $currentMenu.next().slideUp("slow");     
          $currentMenu.removeClass("activeListItem");                                         
          $currentMenu = $this;
          $currentMenu.next().slideDown("slow");
          $currentMenu.addClass("activeListItem");
        } else {
          $currentMenu.next().slideUp("slow");
          $currentMenu.removeClass("activeListItem");   
          $currentMenu = undefined;
        }           
      });      

      $("#divshape input").click(function() {
        $("#card").removeClass(); 
        if (activeimg !== undefined) $("#card").css("background-image", "url(" + activeimg.attr("src") + ")");
        switch ($(this).val()) {          
          case "rectangle":                
            $("#layoutcheckvert").is(":checked") ? $("#card").addClass("rectangle droppable") 
                                                 : $("#card").addClass("rectanglehoriz droppable");
            $("#divlayout input").prop('disabled', false);            
            break;
          case "square":
            $("#card").addClass("square droppable");  
            $("#divlayout input").prop('disabled', true);
            break;
          case "ellipse":
            $("#layoutcheckvert").is(":checked") ? $("#card").addClass("ellipse droppable") 
                                                 : $("#card").addClass("ellipsehoriz droppable");          
            $("#divlayout input").prop('disabled', false);
            break;
          case "circle":
            $("#card").addClass("circle droppable");  
            $("#divlayout input").prop('disabled', true);
            break;
          case "heart":
            $("#card").addClass("heart droppable");            
            $("#divlayout input").prop('disabled', true);
            if (activeimg !== undefined) $("#card").css("background-image", "url(img/heart.png), url(" + activeimg.attr("src") + ")");
        }      
      });

      $("#divlayout input").click(function() {
        $("#card").removeClass(); 
        if ($("#rect").is(":checked") && $(this).val() == "vertical") {
          $("#card").addClass("rectangle droppable");
        }
        if ($("#rect").is(":checked") && $(this).val() == "horizontal") {
          $("#card").addClass("rectanglehoriz droppable");
        }
        if ($("#elli").is(":checked") && $(this).val() == "vertical") {
          $("#card").addClass("ellipse droppable");
        }
        if ($("#elli").is(":checked") && $(this).val() == "horizontal") {
          $("#card").addClass("ellipsehoriz droppable");
        }
      });  

      var activeimg;
      $('#divbackground img').click(function() {
        if (activeimg !== undefined) activeimg.removeClass("activeImg");

        activeimg = $(this);        
        activeimg.addClass("activeImg");            

        if ($("#card").hasClass("heart")) {
          $(".heart").css("background-image" , "url(img/heart.png), url(" + $(this).attr("src") + ")");
        }
        else{
          $("#card").css("background-image" , "url(" + $(this).attr("src") + ")");  
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
      $("#orderlabel").css("display", "none");
      $("#formorder").show(); 
      $( "textarea" ).focus();     
    }
  
    function isValidEmailAddress(emailAddress) {
      var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
      return pattern.test(emailAddress);
    }

    function sendAjax(){   
      var email = $("#validateemail").val();       

      if (email == "" || !isValidEmailAddress(email)) {
        $("#formorder input[name=email]").addClass("error");        
      } else {
        html2canvas(document.getElementById("workfield"), {
                onrendered: function(canvas) {
                  var imgdata = canvas.toDataURL('image/png').replace('data:image\/png;base64,', '');                  
                  var alldata = $('form').serializeArray();
                  alldata.push({name: 'createdimg', value: imgdata});

                  $.ajax({
                    type: "post",
                    url: "order.php",
                    data: alldata,                    
                    async: false,
                    success: function(data) {
                      if(data == "true") {
                        modalWin("#dialog");            
                      } else {
                        alert("Что-то пошло не так... Ваш заказ не был отправлен.\nСделайте снимок экрана ('PrtScr') и отправьте его нам по почте!");
                      }                                      
                    }            
                  });
               
                  $("#formorder textarea[name=comments]").val("");
                  $("#formorder input:not([type='submit'])").val("");  
                  if ($("#formorder input[name=email]").hasClass("error")) {
                    $("#formorder input[name=email]").removeClass("error");                    
                  }          
                  $("#orderlabel").css("display", "inline");
                  $("#formorder").css("display", "none");           
                }                
            });
      }                                                                                          
    }

    function modalWin(id){
      document.body.style.overflow = 'hidden';
      var maskHeight = $(window).height();
      var maskWidth = $(window).width();
      $('#mask').css({'width':maskWidth,'height':maskHeight, 'top':window.pageYOffset, 'left':0});            
      $('#mask').fadeTo("fast",0.7);
      $(id).css('top',  window.pageYOffset + maskHeight/2 - $(id).height());
      $(id).css('left', maskWidth/2 - $(id).width()/2);
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
    
    <div id="content_wrapper">
      <p id ="instructions">
        Такие элементы, как "Цветы", "Наклейки", "Стразы" и "Деревянные украшения" 
        помещаются на открытку путем перетаскивания. Вы можете перетаскивать одни 
        и те же элементы необходимое число раз. Помещенные на открытку элементы
        можно вращать. Для этого используйте зажатую клавишу "Ctrl", зажмите
        левую кнопку мыши на элементе и переместите курсор мыши вверх/вниз.
        Для удаления элемента переместите его за пределы области открытки.
      </p>
      <div id='parametrs'>    
        <ul>
          <li id='shape'>Форма</li>
            <div class='divstyle' id='divshape'>
              <label>
                <input type="radio" name="shaperadio" value="rectangle" 
                  id="rect" autocomplete="off" checked> - Прямоугольник (A5)
              </label><br/>
              <label>
                <input type="radio" name="shaperadio" value="square" 
                  autocomplete="off"> - Квадрат
              </label><br/>
              <label>
                <input type="radio" name="shaperadio" value="ellipse" 
                  id="elli" autocomplete="off"> - Овал
              </label><br/>
              <label>
                <input type="radio" name="shaperadio" value="circle" 
                  autocomplete="off"> - Круг
              </label><br/>
              <label>
                <input type="radio" name="shaperadio" value="heart" 
                  autocomplete="off"> - Сердце
              </label>
            </div>
          <li id='layout'>Расположение</li>
            <div class='divstyle' id='divlayout'>
              <label>
                <input type="radio" name="layoutradio" value="vertical" 
                  id="layoutcheckvert" autocomplete="off" checked> - Вертикальное
              </label>
              <label>
                <input type="radio" name="layoutradio" value="horizontal" 
                  id="layoutcheckhoriz" autocomplete="off"> - Горизонтальное
              </label>
            </div>
          <li id='background'>Фон</li>
            <div class='divstyle' id='divbackground' autocomplete="off">              
              <?php loadImages("img/cards/background/"); ?>                  
            </div>
          <li id='flowers'>Цветы</li>
            <div class='divstyle' id='divflowers' autocomplete="off">
              <?php loadImages("img/cards/flowers/"); ?>
            </div>
          <li id='stickers'>Наклейки</li>
            <div class='divstyle' id='divstickers' autocomplete="off">
              <?php loadImages("img/cards/stickers/"); ?>                   
            </div>
          <li id='strasses'>Стразы</li>
            <div class='divstyle' id='divstrasses' autocomplete="off">
              <?php loadImages("img/cards/strasses/"); ?>                  
            </div>
          <li id='woodenorns'>Деревянные украшения</li>
            <div class='divstyle' id='divwoodenorns' autocomplete="off">
              <?php loadImages("img/cards/woodenorns/"); ?>
            </div>            
        </ul>    
      </div>
          
      <div id='workfield'>  
        <div id='card' class='rectangle droppable'>          
        </div>    
      </div>  
      
      <span id='orderlabel' onclick='callForm()'>Заказать</span>
      <form id='formorder' onsubmit='return false'>
        <p>Ваши комментарии к заказу:<br/>
          <textarea name='comments' autocomplete="off"></textarea>
        </p>
        <p>Email:<br/>
          <input class='inpfields' id='validateemail' name='email' type='email' autocomplete="off">
        </p>
        <p id='tel'>Телефон:<br/>
          <input class='inpfields' name='tel' type='tel' autocomplete="off">
        </p>              
        <div class='aligntocenter'>
          <input type='submit' value='Отправить заказ' class='formbutton' onclick='sendAjax()'>
        </div>
      </form>        
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
  

  <?php
    function loadImages($directory) {
      $outputString = "";    
      $dir = $directory;  
      $files = scandir($dir);                
      for ($i=0; $i < count($files); $i++) { 
        $currentFile = $files[$i];
        $ext = pathinfo($currentFile)['extension'];
        $nameWithoutExt = basename($currentFile,'.' . $ext);
        if ($currentFile != '.' && $currentFile != '..') {                      
          $outputString = "<div class='imgdiv'>";          
          $outputString .= "<img";      
          if ($dir != "img/cards/background/") {
            $outputString .= " class='draggable'";
          }      
          $outputString .= " src='" . $dir . $currentFile . "' alt='image-" . $nameWithoutExt . "'/>";          
          $outputString .= "</div>";            
          echo $outputString;
        }        
      }
    }
  ?>
</body>
</html>