//Global variables
var nUserID = $("#user").data().value;
var nHouseID = '';
var nTotalPrice = '';
var nCreditcardID = '';

// ****************************************** search availability ****************************************** 
$(document).ready(function (){
  var today = new Date()
  var tomorrow = new Date(today)
  tomorrow.setDate(tomorrow.getDate() + 1)
  $('#from').val(today.toISOString().slice(0, 10));
  $('#to').val(tomorrow.toISOString().slice(0, 10));
  filterSearch();
  getCities();
})


$(document).on('click', '#search', function (){
  filterSearch();
})


function filterSearch() {
  $('#house-list').css('display', 'none');   
  $("#filtered-list tr>td").remove();

  el = $(this);

  var from = $("#from").val();
  var to = $("#to").val();
  var city = $("#where-filter").val();

  if(city === null){city = 'everywhere'}

    $.ajax({
      url : "../../apis/house/read-by-availability.php?in="+from+"&out="+to+"&city="+city,
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

$(document).on('click', '#confirmBooking', function (){
  var form_data = new FormData();

  var dCreationDate = new Date().toISOString().slice(0, 19).replace('T', ' ');
  
  form_data.append("nHouseID", nHouseID);
  form_data.append("nUserID", nUserID);
  form_data.append("dCreationDate", dCreationDate);
  form_data.append("dChekin", $("#from").val());
  form_data.append("dChekout", $("#to").val());
  form_data.append("nTotalPrice", nTotalPrice);
  form_data.append("nCreditcardID", nCreditcardID);

  console.log( JSON.stringify(Object.fromEntries(form_data)) );

    $.ajax({
      url : "../../apis/reservation/create.php",
      method : "POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
    })
    .done(function(){
      $("#confirmation-modal").css("display","none");
      filterSearch();
    })
    .fail();

})



$(document).on('click', '#bookHouse', function() {
  el = $(this);
  nHouseID = el.val();
  
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

  nTotalPrice = totalPrice;

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
    nCreditcardID = selectedCreditCard;
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
  $('#creditCard').empty();
  $.ajax({
    url : "../../apis/creditcard/read-by-user-id.php?id="+nUserID,
    method : "GET",
    contentType: false,
    cache: false,
    processData: false,
  })
  .done(function(data){
    $('#creditCard').append(`
      <option value="new">new</option
    `);
    var creditcards = data.data;
    creditcards.forEach(creditcard => {
    $('#creditCard').append(`
      <option value="${creditcard.nCreditcardID}">${creditcard.cCardNumber}</option
    `);
    });
  })
  .fail(function(e){
  });
}

function getCities(){
  $.ajax({
    url : "../../apis/house/read-cities.php",
    method : "GET",
    contentType: false,
    cache: false,
    processData: false,
  })
  .done(function(data){
    var cities = data.data;
    cities.forEach(city => {
    $('#where-filter').append(`
      <option value="${city}">${city}</option
    `);
    });
  })
  .fail(function(e){
  });
  $('#where-filter').append(`
      <option value="everywhere">everywhere</option
    `);
}