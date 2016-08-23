var DragManager = new function() {

  var dragObject = {};
  var self = this;
  var keypressed = false, move = false, rotate = false;

  function onKeyDown(e) {    
    var ev = e || document.event;
    var keyCode = ev.which || ev.keyCode;
    if (keyCode == 17 && !move) keypressed = true;    
  }

  function onKeyUp(e) {    
    var ev = e || document.event;
    var keyCode = ev.which || ev.keyCode;
    if (keyCode == 17) {
      if (rotate) onMouseUp(e);
      keypressed = false;    
      move = false;
    }
  }

  function onMouseDown(e) {
    if (e.which != 1) return;    
    var elem = $(e.target).closest('.draggable')[0];
    if (!elem) return;
    dragObject.elem = elem; //присвоится элемент с классом 'draggable'
    // запомним, что элемент нажат на текущих координатах pageX/pageY
    dragObject.downX = e.pageX;
    dragObject.downY = e.pageY;
    return false;
  }

  function onMouseMove(e) {
    if (!dragObject.elem) return; // элемент не зажат
    if (!dragObject.avatar) { // если перенос не начат...
      var moveX = e.pageX - dragObject.downX;
      var moveY = e.pageY - dragObject.downY;
      // если мышь передвинулась в нажатом состоянии недостаточно далеко
      if (Math.abs(moveX) < 3 && Math.abs(moveY) < 3) return;
      // начинаем перенос
      dragObject.avatar = createAvatar(e); // создать аватар
      if (!dragObject.avatar) { // отмена переноса, нельзя "захватить" за эту часть элемента
        dragObject = {};
        return;
      }
      // аватар создан успешно
      startDrag(e); // отобразить начало переноса
    }
    // отобразить перенос объекта при каждом движении мыши
    if (keypressed) {
      move = false;       
      if (parseInt(e.pageY) % 5 == 0) $(dragObject.avatar).rotate(e.pageY);  //поворот на 5 градусов               
      rotate = true;
    } else {
      move = true;
      dragObject.avatar.style.left = e.pageX - dragObject.avatar.offsetWidth / 2 + 'px';
      dragObject.avatar.style.top = e.pageY - dragObject.avatar.offsetHeight / 2 + 'px';
    }
    return false;
  }

  function onMouseUp(e) {
    if (dragObject.avatar) { // если перенос идет                
      finishDrag(e);      
      dragObject.avatar.style.cursor = 'pointer';  
      move = false;
      keypressed = false; 
      rotate = false;   
    }
    // перенос либо не начинался, либо завершился
    // в любом случае очистим "состояние переноса" dragObject
    dragObject = {};
  }

  function finishDrag(e) {    
    var dropElem = findDroppable(e);

    if (!keypressed) {
      if (!dropElem) {
        if (!rotate) self.onDragCancel(dragObject);
      } else if (move) self.onDragEnd(dragObject);    
    }    
    document.body.style.cursor = 'default';
  }

  function createAvatar(e) {
    // запомнить старые свойства, чтобы вернуться к ним при отмене переноса
    var avatar;
    if  (dragObject.elem.classList.contains("onfield")) {
      avatar = dragObject.elem;
    }
    else {
      avatar = dragObject.elem.cloneNode(true);
      avatar.classList.add("onfield");
    }        
    avatar.remove = function() {
      document.body.removeChild(avatar);
    };
    return avatar;
  }

  function startDrag(e) {
    var avatar = dragObject.avatar;
    // инициировать начало переноса
    if (!keypressed) {
      document.body.appendChild(avatar);      
      avatar.style.position = 'absolute';
      avatar.style.cursor = 'move';
    } else {
      document.body.style.cursor = 's-resize';
      avatar.style.cursor = 's-resize';
    }
    
    avatar.style.zIndex = 100;    
  }

  function findDroppable(event) {
    // спрячем все перенесенные элементы на рабочей области
    var imgsOnField = document.getElementsByClassName('onfield');
    for (var i = 0; i < imgsOnField.length; i++) {
      imgsOnField[i].hidden = true;
    }    
    // получить самый вложенный элемент под курсором мыши
    var elem = document.elementFromPoint(event.clientX, event.clientY);
    // показать все перенесенные элементы на рабочей области обратно
    for (var i = 0; i < imgsOnField.length; i++) {
      imgsOnField[i].hidden = false;
    }
    //dragObject.avatar.hidden = false;
    if (elem == null)  return null;  // такое возможно, если курсор мыши "вылетел" за границу окна

    return $(elem).closest('.droppable')[0];
  }

  document.onmousemove = onMouseMove;
  document.onmouseup = onMouseUp;
  document.onmousedown = onMouseDown;
  document.onkeydown = onKeyDown;  
  document.onkeyup = onKeyUp;

  this.onDragEnd = function(dragObject) {
    var workfield = document.getElementById("workfield");    
    workfield.appendChild(dragObject.avatar);     
    var fieldcoords = getCoords(workfield);
    dragObject.avatar.style.top = parseFloat(dragObject.avatar.style.top) - fieldcoords.top + "px";
    dragObject.avatar.style.left = parseFloat(dragObject.avatar.style.left) - fieldcoords.left + "px";          
  };
  this.onDragCancel = function(dragObject) {
    dragObject.avatar.remove();
  };
};

function getCoords(elem) { // кроме IE8-
  var box = elem.getBoundingClientRect();
  return {
    top: box.top + pageYOffset,
    left: box.left + pageXOffset
  };
}