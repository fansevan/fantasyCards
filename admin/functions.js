function deleteImage(directory, filename, extension) {
      $.post(
        "deletefile.php",
        {
          directory: directory,
          filename: filename,
          extension: extension
        },
        function(data) {
          if(data == "true") {
            alert("Удален!!!"); 
            location.reload();           
          } else {
            alert("Не удален...");
          }
        }
      ); 
    }