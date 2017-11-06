$(document).ready(function () {
  $('.lkBtn').hide();
var $items;
var $user = {
  email: "newuser@newuser.ru",
  first_name: "Новый Посетитель",
  id: 1,
  last_name: "Новый",
  login: "newuser",
  password: "1",
  phone: "",
  second_name: "Новый"
};
var $basket;
var $history = [];
function newOrder() {
  this.clientId = 1;
  this.totalPrice = 0;
  this.totalQuantity = 0;
  this.items = [];
  this.quantity = [];
  this.price = [];
}
var $newOrder = new newOrder();

function refreshBusket() {
  if (!$user) {
    $('.basket').append('<p class="basketMin">Товаров: 0</p>');
    $('.basket').append('<p class="basketMin">Цена: 0 р</p>');
  } else {
  $.ajax({
    type: 'POST',
    url: 'basket.php',
    dataType: 'json',
    data: 'userid=' + $user.id,
    response: 'text',
    errrep: true,
    error: function (num) {
      console.log(num);
    },
    success: function (data) {
      if (data.length == 0) {
        $sumQuantity = $newOrder.totalQuantity;
        $sumPrice = $newOrder.totalPrice;
      } else {
        $basket = data;
        var $sumQuantity = 0;
        var $sumPrice = 0;
        for (var i = 0; i < data.length; i++) {
          $sumQuantity = parseInt($sumQuantity) + parseInt(data[i].quantity);
          $sumPrice = parseInt($sumPrice) + (parseInt(data[i].price) * parseInt(data[i].quantity));
        }
      }
      $('.basketMin').remove();
      $('.basket').append('<p class="basketMin">Товаров: ' + $sumQuantity + '</p>');
      $('.basket').append('<p class="basketMin">Цена: ' + $sumPrice + ' р</p>');
    }
  });
  }
}
refreshBusket();
var $limit = 10;
var $itemsLimit = 'limit=' + $limit;
function drawItemsBlock($itemsLimit) {
  $.ajax({
  type: 'POST',
  url: 'catalog.php',
  dataType: 'json',
  data: $itemsLimit,
  response: 'text',
  errrep: true,
  error: function (num) {
    console.log(num);
  },
  success: function (data) {
      $items = data;
      for (var i = 0; i < data.length; i++) {
        $('.itemsBlock').append('<div class="item" id="itemId' + i +'"></div>');
        $('#itemId' + i).append('<img src="' + data[i].img_folder + data[i].main_photo + '" alt="">');
        $('#itemId' + i).append('<h2>' + data[i].item_name + '</h2>');
        $('#itemId' + i).append('<h3>Цена: ' + data[i].price + '</h3>');
      }

      $('.item').on('click', function () {
        var $itemId = this.id;
        $itemId = $itemId.slice(6);
        $history.push($items[$itemId].item_id);
        console.log($history);
        $('.center').append('<div class="itemShow"></div>');
        $('.itemShow').append('<h2>' + $items[$itemId].item_name + '</h2>');
        $('.itemShow').append('<div class="infoBox"></div>');
        $('.infoBox').append('<div class="imgBox"></div>');
        $('.imgBox').append('<div class="images"></div>');
        $('.imgBox').append('<div class="imgShow"></div>');
        $('.imgShow').append('<img src="' + $items[$itemId].img_folder + $items[$itemId].main_photo + '" alt="" class="actImg">');
        $('.infoBox').append('<div class="decribtionBox"></div>');
        var $str = $items[$itemId].describtion.replace(/\n/g, '<br>');
        $('.decribtionBox').append('<p>' + $str + '</p>');
        $('.itemShow').append('<h2>Цена: ' + $items[$itemId].price + ' руб.</h2>');
        $('.itemShow').append('<label>Количество<input type="number" min="0" max="' + $items[$itemId].quantity_stock + '" step="1" name="quantity" class="quantity" id="quantity" value="1"></label>');
        $('.itemShow').append('<div class="btnBox"></div>');
        $('.btnBox').append('<div id="btnBuy" class="btnItem"></div>');
        $('#btnBuy').append('<p>В корзину</p>');
        $('.btnBox').append('<div id="btnReturn" class="btnItem"></div>');
        $('#btnReturn').append('<p>Вернуться к покупкам</p>');
        var $Str = 'directory=' + $items[$itemId].img_folder;
        $.ajax({
        type: 'POST',
        url: 'read_files.php',
        dataType: 'json',
        data: $Str,
        response: 'text',
        errrep: true,
        error: function (num) {
          console.log(num);
        },
        success: function (data){
          $('.images').append('<img src="' + $items[$itemId].img_folder + $items[$itemId].main_photo + '" alt="" id="' + $items[$itemId].img_folder + $items[$itemId].main_photo + '" class="imgMin">');
          for (var i = 0; i < data.length; i++) {
            if ($items[$itemId].main_photo != data[i]){
                $('.images').append('<img src="' + $items[$itemId].img_folder + data[i] + '" alt="" id="' + $items[$itemId].img_folder + data[i] + '" class="imgMin">');
            }
          }
          $('.imgMin').on('click', function () {
            $('.actImg').remove();
            $('.imgShow').append('<img src="' + this.id + '" alt="" class="actImg">');
          });
        }
      });
        $('.btnItem').on('click', function () {
          if (this.id == 'btnBuy') {
            console.log('положить в корзину');
            if ($user.id == 1) {
              var $quntity = document.querySelector('#quantity').value;
              $newOrder.totalQuantity = parseInt($newOrder.totalQuantity) + parseInt($quntity);
              $newOrder.totalPrice = parseInt($newOrder.totalPrice) + parseInt($items[$itemId].price) * parseInt($quntity);
              $newOrder.items.push($items[$itemId].item_id);
              $newOrder.quantity.push($quntity);
              $newOrder.price.push($items[$itemId].price);
              refreshBusket();
              $('.itemShow').remove();
            } else {
                var $quntity = document.querySelector('#quantity').value;
                var $str = 'itemid=' + $items[$itemId].item_id + '&quantity=' + $quntity + '&price=' +
                $items[$itemId].price + '&userid=' + $user.id;
                $.ajax({
                  type: 'POST',
                  url: 'add_to_basket.php',
                  dataType: 'json',
                  data: $str,
                  errrep: true,
                  error: function (num) {
                    console.log(num);
                  },
                  success: function (data){
                    refreshBusket();
                  }
                });
                $('.itemShow').remove();
            }
          } else {
            $('.itemShow').remove();
          }
        });
      });
  }
  });
  }
  drawItemsBlock($itemsLimit);
  $('.btnNext').on('click', function () {
    $('.item').remove();
    $limit = $limit + 10;
    $itemsLimit = 'limit=' + $limit;
    drawItemsBlock($itemsLimit);
  });
  $('.regBtn').on('click', function () {
    if (this.id == 'enter') {
      $('.itemsBlock').append('<div class="authorisation"></div>');
      $('.regBtn').hide();
      $('.authorisation').append('<div class="login"></div>');
      $('.login').append('<label>Логин<input type="text" name="login" required autofocus class="loginIn" id="login"></label>');
      $('.login').append('<label>Пароль<input type="password" name="password" required class="loginIn" id="pwd"></label>');
      $('.login').append('<input type="submit" class="btn">');
      $('.btn').on('click', function () {
        var $log = document.querySelector('#login').value;
        var $pwd = document.querySelector('#pwd').value;
        var $logStr = 'login=' + $log + '&' + 'password=' + $pwd;
        $.ajax({
          type: 'POST',
          url: 'login.php',
          dataType: 'json',
          data: $logStr,
          response: 'text',
          errrep: true,
          error: function (num) {
            console.log(num);
          },
          success: function (data) {
              $('.authorisation').remove();
              $user = data;
              if ($user) {
                $('.errInfo').remove();
                $('.lkBtn').show();
                $('.registry').append('<p class="regText"> Здравствуйте ' + data.first_name + '</p>');
                console.log($user);
                } else {
                $('.regBtn').show();
                $('.basketMin').remove();
                $('.errInfo').remove();
                $('.registry').append('<p class="errInfo">Вы ввели неправильный логин или пароль</p>');
              }
              refreshBusket();
          }
         });
        });
    } else if (this.id == 'registration') {
            $('.itemsBlock').append('<div class="registration"></div>');
            $('.regBtn').hide();
            $('.registration').append('<h3 class="formTitle">Заполните форму регистрации</h3>');
            $('.registration').append('<div class="names"></div>');
            $('.names').append('<div id="firstName" class="namesN"></div>');
            $('#firstName').append('<label>Имя *<input type="text" name="firstName" required autofocus class="loginIn" id="firstNameIn"></label>');
            $('.names').append('<div id="secondName" class="namesN"></div>');
            $('#secondName').append('<label>Фамилия<input type="text" name="secondName" class="loginIn" id="secondNameIn"></label>');
            $('.names').append('<div id="lastName"class="namesN"></div>');
            $('#lastName').append('<label>Отчество<input type="text" name="lastName" class="loginIn" id="lastNameIn"></label>');
            $('.registration').append('<div id="contactsIn" class="names"></div>');
            $('#contactsIn').append('<div id="mail" class="namesN"></div>');
            $('#mail').append('<label>Email *<input type="email" name="email" required class="loginIn" id="emailIn"></label>');
            $('#contactsIn').append('<div id="phone" class="namesN"></div>');
            $('#phone').append('<label>Телефон<input type="phone" name="phone" class="loginIn" id="phoneIn"></label>');
            $('.registration').append('<div class="check"></div>');
            $('.check').append('<label>Использовать Email как логин <input type="checkbox" name="loginMail" class="checkIn" id="loginMail"></label>');
            $('.registration').append('<div class="loginBox"></div>');
            $('.loginBox').append('<label>Логин *<br><input type="text" name="login" class="loginIn" id="login" required></label>');
            $('.loginBox').append('<div class="pwdBox"></div>');
            $('.pwdBox').append('<label>Пароль *<br><input type="password" name="password" required class="loginIn" id="pwdIn"></label>');
            $('.pwdBox').append('<label>Введите пароль еще раз *<br><input type="password" name="password" required class="loginIn" id="pwdConfirm"></label>');
            $('#loginMail').on('change', function () {
              if (document.querySelector('#loginMail').checked == true) {
                document.querySelector('#login').value = document.querySelector('#emailIn').value;
              } else {
                document.querySelector('#login').value = '';
              }
            });
            $('.registration').append('<div class="toolTip2">Заполните обязательные поля *</div>');
            $('#firstName').append('<div class="toolTip">Имя должно содержать только буквы</div>');
            $('#mail').append('<div class="toolTip1">Введите корректный E-mail</div>');
            $('.toolTip').hide();
            $('.toolTip1').hide();
            $('.toolTip2').hide();
            $('.registration').append('<input type="submit" class="btn">');
            var $nameOk = false;
            var $mailOk = false;
            var $firstNameIn = document.querySelector('#firstNameIn').value;
            var $secondNameIn = document.querySelector('#secondNameIn').value;
            var $lastNameIn = document.querySelector('#lastNameIn').value;
            var $emailIn = document.querySelector('#emailIn').value;
            var $phoneIn = document.querySelector('#phoneIn').value;
            var $login = document.querySelector('#login').value;
            var $pwd = document.querySelector('#pwdIn').value;
            var $pwdCheck = document.querySelector('#pwdConfirm').value;
            var $regExpName = /[a-zA-Zа-яА-я]/i;
            var $regExpMail = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i;
            $('#firstNameIn').on('input', function () {
              $firstNameIn = document.querySelector('#firstNameIn').value;
              if ($regExpName.test($firstNameIn) == false) {
                $('.toolTip').show();
              } else {
                $('.toolTip').hide();
                $nameOk = true;
              }
            });
            $('#emailIn').on('input', function () {
              $emailIn = document.querySelector('#emailIn').value;
              if ($regExpMail.test($emailIn) == false) {
                $('.toolTip1').show();
              } else {
                $('.toolTip1').hide();
                $mailOk = true;
              }
            });
            $('.btn').on('click', function () {
              $firstNameIn = document.querySelector('#firstNameIn').value;
              $secondNameIn = document.querySelector('#secondNameIn').value;
              $lastNameIn = document.querySelector('#lastNameIn').value;
              $emailIn = document.querySelector('#emailIn').value;
              $phoneIn = document.querySelector('#phoneIn').value;
              $login = document.querySelector('#login').value;
              $pwd = document.querySelector('#pwdIn').value;
              $pwdCheck = document.querySelector('#pwdConfirm').value;
              if ($firstNameIn == '' || $emailIn == '' || $login == '' || $pwd == '' || $pwdCheck == '') {
                $('.toolTip2').show();
              } else if ($nameOk == true && $mailOk == true){
                $('.toolTip2').hide();
                if ($pwd == $pwdCheck) {
                  var $regStr = 'first_name=' + $firstNameIn + '&' + 'second_name=' + $secondNameIn +
                  '&' + 'last_name=' + $lastNameIn + '&' + 'email=' + $emailIn + '&' +
                  'phone=' + $phoneIn + '&' + 'login=' + $login + '&' + 'password=' + $pwd;
                  $.ajax({
                    type: 'POST',
                    url: 'registration.php',
                    dataType: 'json',
                    data: $regStr,
                    response: 'text',
                    errrep: true,
                    error: function (num) {
                      console.log(num);
                    },
                    success: function (data) {
                        $user = data;
                        if ($user != false) {
                          $('.lkBtn').show();
                          $('.registry').append('<p class="regText"> Здравствуйте ' + data.first_name + '</p>');
                          $('.registration').remove();
                        } else {
                          document.querySelector('#login').placeholder = 'Логин уже занят';
                        }
                    }
                 });
                } else {
                  document.querySelector('#pwdConfirm').value = '';
                  document.querySelector('#pwdConfirm').placeholder = 'Не верный пароль';
                }
              }
            });
          } else return false;
  });
  $('.basket').on('click', function () {
    console.log($basket);
    $('.itemsBlock').append('<div class="basketWindow"></div>');
    $('.basketWindow').append('<h2> Ваша корзина ' + $user.first_name + ' ' + $user.last_name + '</h2>');
    if ($basket.length == 0) {
      $('.basketWindow').append('<h2> Ваша корзина пуста</h2>');
    } else {
      $('.basketWindow').append('<div class="basketItem" id="itemNum"></div>');
      $('#itemNum').append('<p class="iNum">n/n</p>');
      $('#itemNum').append('<p class="iName">Наименование товара</p>');
      $('#itemNum').append('<p class="iQuan">Кол-во</p>');
      $('#itemNum').append('<p class="iPrice">Сумма</p>');
      $('#itemNum').append('<p class="iDel"></p>');
      for (var i = 0; i < $basket.length; i++) {
        $('.basketWindow').append('<div class="basketItem" id="itemNum' + i + '"></div>');
        $('#itemNum' + i).append('<p class="iNum">' + (i + 1) + '</p>');
        $('#itemNum' + i).append('<p class="iName">' + $basket[i].item_name + '</p>');
        $('#itemNum' + i).append('<p class="iQuan">' + $basket[i].quantity + '</p>');
        $('#itemNum' + i).append('<p class="iPrice">' + ($basket[i].quantity * $basket[i].price) + ' Руб</p>');
        $('#itemNum' + i).append('<p class="iDel" id="del' + i + '">X</p>');
      }
      $('.iDel').on('click', function () {
        var $orderN = this.id.slice(3);

        $('#itemNum' + $orderN).remove();
        var $delOrder = 'orderid=' + $basket[$orderN].id;
        $.ajax({
          type: 'POST',
          url: 'del_from_basket.php',
          dataType: 'json',
          data: $delOrder,
          response: 'text',
          errrep: true,
          error: function (num) {
            console.log(num);
          },
          success: function (data){

          }
        });
      });
      $('.basketWindow').append('<div class="basketItem" id="basketBtn"></div>');
      $('#basketBtn'). append('<div class="basketBtn" id="returnBtn"><p>Вернуться к покупкам</p></div>');
      $('#basketBtn'). append('<form action="confirm_order.php" method="POST" class="basketForm"></form>');
      $('.basketForm'). append('<input type="text" name="userid" value="'+ $user.id + '" hidden>');
      $('.basketForm'). append('<input class="basketBtn1" id="nextBtn" type="submit" value="Оформить заказ">');
      $('.basketBtn').on('click', function () {
        $('.basketWindow').remove();
      });
    }
  });
  $('.lkBtn').on('click', function () {
    if (this.id == 'exit') {
      var $logStr = 'login=newuser&password=1';
      $.ajax({
        type: 'POST',
        url: 'login.php',
        dataType: 'json',
        data: $logStr,
        response: 'text',
        errrep: true,
        error: function (num) {
          console.log(num);
        },
        success: function (data) {
            $user = data;
            if ($user) {
              $('.errInfo').remove();
              $('.regText').remove();
              $('.lkBtn').hide();
              $('.regBtn').show();
              $('.registry').append('<p class="regText"> Здравствуйте ' + data.first_name + '</p>');
              }
              $history = [];
            refreshBusket();
        }
       });
    } else {
      var $historyStr;
      var $strH;
      if ($history.length <= 5) {
        for (var i = 0; i < $history.length; i++) {
          $historyStr[i] = 'item' + i + '=' + $history[i] + '&';
          $strH = $strH + $historyStr[i];
        }
      } else {
        var j = 0;
        for (var i = $history.length - 5; i < $history.length; i++) {
          $historyStr[j] = 'item' + j + '=' + $history[i] + '&';
          $strH = $strH + $historyStr[j];
          j++;
        }
      }
      $str = $str + 'client_id=' + $user.id;
      $.ajax({
        type: 'POST',
        url: 'add_history.php',
        dataType: 'json',
        data: $str,
        response: 'text',
        errrep: true,
        error: function (num) {
          console.log(num);
        },
        success: function (data) {

        }
       });
    }
  });
});
