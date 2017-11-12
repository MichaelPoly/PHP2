$(document).ready(function () {

  $('.orderRow').on('click', function () {
    console.log(this.id);
    location = 'order_edit.php?numId=' + this.id;
  });
  $('.orderStateInput').on('click', function () {
    document.querySelector('.orderStateInput').value = '';
  });
  $('.saveBtn').on('click', function () {
    console.log('ok');
    var $order_state = document.querySelector('.orderStateInput').value;
    location = 'change_state.php?state=' + $order_state + '&order_num=' + this.id;
  });

});
