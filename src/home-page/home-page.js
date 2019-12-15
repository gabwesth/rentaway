//Global variables
var nUserID = $("#user").data().value;



// ****************************************** search availability ****************************************** 
$(document).ready(function (){
  var today = new Date()
  var tomorrow = new Date(today)
  tomorrow.setDate(tomorrow.getDate() + 1)
  $('#from').val(today.toISOString().slice(0, 10));
  $('#to').val(tomorrow.toISOString().slice(0, 10));
  filterSearch();
})


$(document).on('click', '#search', function (){
  filterSearch();
})

var ID = 0;

// ****************************************** create reservation ****************************************** 
$(document).on('click', '#confirBooking', function (){
  var form_data = new FormData();

  el = $(this);
  var dCreationDate = new Date().toISOString().slice(0, 19).replace('T', ' ');
  var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
  var firstDate = Date.parse($("#from").val());
  var secondDate = Date.parse($("#to").val());
  var dayCount = Math.round(Math.abs((firstDate - secondDate) / oneDay));
  var pricePerDay = $(this).parent().siblings('#price')[0].innerText;
  var nTotalPrice = pricePerDay * dayCount;
  var nCreditcardID = 1; // MAKE THEM CHOOSE
  
  form_data.append("nHouseID", $("#bookHouse").val());
  form_data.append("nUserID", nUserID);
  form_data.append("dCreationDate", dCreationDate);
  form_data.append("dChekin", $("#from").val());
  form_data.append("dChekout", $("#to").val());
  form_data.append("nTotalPrice", nTotalPrice);
  form_data.append("nCreditcardID", nCreditcardID);

    $.ajax({
      url : "../../apis/reservation/create.php",
      method : "POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
    })
    .done(function(data){
    })
    .fail();

})

function filterSearch() {
  $('#house-list').css('display', 'none');   
  $("#filtered-list tr>td").remove();

  el = $(this);

  var from = $("#from").val();
  var to = $("#to").val();

    $.ajax({
      url : "../../apis/house/read-by-availability.php?in="+from+"&out="+to,
      method : "GET",
      contentType: false,
      cache: false,
      processData: false,
    })
    .done(function(data){
      var houses = data.data;
      houses.forEach(house => {
      $('#filtered-list').append(`
        <tr>
          <td id="name">${house.cName}</td>
          <td id="description">${house.cDescription}</td>
          <td id="sqm">${house.nSqm}</td>
          <td id="capacity">${house.nCapacity}</td>
          <td id="city">${house.cCity}</td>
          <td id="address">${house.cAddress}</td>
          <td id="price">${house.nPricePerDay}</td>
          <td><button id='bookHouse' class="button" value="${house.nHouseID}"> Book </button></td>
        </tr>
      `);
      });
      $('#filtered-list').css('display', 'block');
    })
    .fail();
}



$(document).on('click', '#bookHouse', function() {
  el = $(this);
  // var dCreationDate = new Date().toISOString().slice(0, 19).replace('T', ' ');
  var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
  var firstDate = $("#from").val();
  var secondDate = $("#to").val();
  var dayCount = Math.round(Math.abs((Date.parse(firstDate) - Date.parse(secondDate)) / oneDay));

  var name = $(this).parent().siblings('#name')[0].innerText;
  var description = $(this).parent().siblings('#description')[0].innerText;
  var sqm = $(this).parent().siblings('#sqm')[0].innerText;
  var capacity = $(this).parent().siblings('#capacity')[0].innerText;
  var city = $(this).parent().siblings('#city')[0].innerText;
  var address = $(this).parent().siblings('#address')[0].innerText;
  var price = $(this).parent().siblings('#price')[0].innerText;
  
  var totalPrice = price * dayCount;

  $('#confirm-house').append(`
        <tr>
          <td>${name}</td>
          <td>${description}</td>
          <td>${sqm}</td>
          <td>${capacity}</td>
          <td>${city}</td>
          <td>${address}</td>
          <td id="price">${price}</td>
        </tr>
      `);

  $('#confirm-price').append(`
      <tr>
        <td>${firstDate}</td>
        <td>${secondDate}</td>
        <td>${totalPrice}</td>
      </tr>
    `);

  updateCreditcards();

  $("#confirmation-modal").css("display","block");
});


$(document).on('click', '.close', function() {
  $("#confirm-house tr>td").remove();
  $("#confirm-price tr>td").remove();

  $("#confirmation-modal").css("display","none");
});


$('#creditCard').change(function() {
  var selectedCreditCard = $('#creditCard').val();
  if(selectedCreditCard == 'new'){
    $('#addNewCard').show();
    }
  else{
    $('#addNewCard').hide();
  }
  });

  $('#addNewCard').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'../../apis/creditcard/create.php',
        type:'POST',
        data:$('#addNewCard').serialize(),
        success:function(){
          updateCreditcards();
          $('#addNewCard').hide();
        }
    });
});


function updateCreditcards(){
  $.ajax({
    url : "../../apis/creditcard/read-by-user-id.php?id="+nUserID,
    method : "GET",
    contentType: false,
    cache: false,
    processData: false,
  })
  .done(function(data){
    var creditcards = data.data;
    creditcards.forEach(creditcard => {
    $('#creditCard').empty().append(`
      <option value="${creditcard.cCardNumber}">${creditcard.cCardNumber}</option
    `);
    });
  })
  .fail(function(e){
  });
}