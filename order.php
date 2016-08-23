<?php
  
  $sendto   = "vsevolod.fandeev@gmail.com";  
  $filen = isset($_POST[filename]) ? $_POST[filename] : "";
  if ($filen != "") {
    $ext = isset($_POST[extension]) ? $_POST[extension] : "";
    $file_name = "img/portfolio/" . $filen . "." . $ext;  // Прикрепляемый файл
  }
  $comments = isset($_POST[comments]) ? $_POST[comments] : "";
  $email = isset($_POST[email]) ? $_POST[email] : "";
  $tel = isset($_POST[tel]) ? $_POST[tel] : "";
  $createdimg = isset($_POST[createdimg]) ? $_POST[createdimg] : "";

  if ($comments == "") $comments = "Без комментариев!";
  if ($email == "") $email = "Не был указан!";
  if ($tel == "") $tel = "Не был указан!";

  // Формирование заголовка письма
  $subject  = "Информация о заказе 'Fantasy-cards.ru'";  
  $bound = "separator"; // Разделитель, по которому будет отделяться письмо от файла
  $headers  = "MIME-Version: 1.0\r\n";  
  $headers .="Content-Type: multipart/mixed; boundary=\"$bound\""; 

  // Формирование тела письма
  $msg = "\n\n--$bound\n";
  $msg .= "Content-type: text/html; charset=\"UTF-8\"\n";
  $msg .= "Content-Transfer-Encoding: quoted-printable\n\n";
  $msg .= "<html><body style='font-family:Arial,sans-serif;'>";
  $msg .= "<h2>Комментарии к заказу:</h2>\r\n";
  $msg .= "<p>$comments</p>\r\n";
  $msg .= "<h2>Email:</h2>\r\n";
  $msg .= "<p>$email</p>\r\n";
  $msg .= "<h2>Телефон:</h2>\r\n";
  $msg .= "<p>$tel</p>\r\n";
  $msg .= "</body></html>";
  
  if ($filen != "") {
    $file = fopen($file_name,"rb"); // Открываем отправляемый файл
  }
          
  // Записываем в переменную вторую часть письма
  $msg .= "\n\n--$bound\n";
  $msg .= "Content-Type: application/octet-stream;";
  $msg .= "name=\"";

  if ($filen != "") {
    $msg .= basename($file_name);
  } else {
    $msg .= "Заказ.png";
  }

  $msg .= "\"\n";
  $msg .= "Content-Transfer-Encoding:base64\n";
  $msg .= "Content-Disposition:attachment\n\n";

  if ($filen != "") {
    $msg .= base64_encode(fread($file,filesize($file_name)));
  } else {
    $msg .= $createdimg;
  }

  $msg .= "\n$bound--\n\n";

  // отправка сообщения
  if(@mail($sendto, $subject, $msg, $headers)) {
     echo "true";
  } else {
     echo "false";
  }

?>