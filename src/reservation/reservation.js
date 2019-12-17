    // ****************************************** create reservation ****************************************** 
    $(document).on('click', '#createReservation', function (){
        var form_data = new FormData();

        el = $(this);
        var today = new Date();
  
        form_data.append("nHouseID", $("#newHouseID").val());
        form_data.append("nUserID", $("#newUserID").val());
        form_data.append("dCreationDate", today);
        form_data.append("dChekin", $("#newCheckin").val());
        form_data.append("dChekout", $("#newCheckout").val());
        form_data.append("nTotalPrice", $("#newTotalPrice").val());
        form_data.append("nCreditcardID",  $("#newCreditcardID").val());
    
          $.ajax({
            url : "../../apis/reservation/create.php",
            method : "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
          })
          .done(function(data){
            var reservation = JSON.parse(data);
            $('#reservation-list').append(`
              <tr id=R-${reservation.nreservationID} >
                <td>${reservation.nHouseID}</td>
                <td>${reservation.nUserID}</td>
                <td>${today}</td>
                <td>${reservation.dChekin}</td>
                <td>${reservation.dChekout}</td>
                <td>${reservation.nTotalPrice}</td>
                <td>${reservation.nCreditcardID}</td>
                <td>${reservation.nPricePerDay}</td>
                <td><button id='deleteReservation' class="button" value="${reservation.nReservatioID}"> Delete </button></td>
              </tr>
            `);
          })
          .fail();
    
      })
      // ****************************************** delete reservation ****************************************** 
  $(document).on('click', "#deleteReservation", function (){
    var form_data = new FormData();
    el = $(this);
    id = $(el).val();
    form_data.append("nReservationID", id);
    $.ajax({
      url : "../../apis/reservation/delete.php",
      method : "DELETE",
      data: JSON.stringify(Object.fromEntries(form_data)),
      contentType: false,
      cache: false,
      processData: false,
    })
    .done(function(data){
      $('#R-'+id).remove();
    })
    .fail();

  })
    
  // ****************************************** update reservation ****************************************** 
  $(document).on('click', "#updateReservation", function (){
    el = $(this);
    id = $(el).val();
    $("#newHouseID").val($("#R-"+id).children()[1].innerText);
    $("#newUserID").val($("#R-"+id).children()[2].innerText);
    $("#newCheckin").val($("#R-"+id).children()[4].innerText);
    $("#newCheckout").val($("#R-"+id).children()[5].innerText);
    $("#newTotalPrice").val($("#R-"+id).children()[6].innerText);
    $("#confirmReservationUpdate").val($("#R-"+id).children()[0].innerText);

  })

    // ****************************************** update reservation ****************************************** 
    $(document).on('click', "#confirmReservationUpdate", function (){
      var form_data = new FormData();
      el = $(this);
      id = $(el).val();
      form_data.append("nReservationID", id);
      form_data.append("nHouseID", $("#newHouseID").val());
      form_data.append("nUserID", $("#newUserID").val());
      form_data.append("dChekin", $("#newCheckin").val());
      form_data.append("dChekout", $("#newCheckout").val());
      form_data.append("nTotalPrice", $("#newTotalPrice").val());

      $.ajax({
        url : "../../apis/reservation/update.php",
        method : "PUT",
        data: JSON.stringify(Object.fromEntries(form_data)),
        contentType: false,
        cache: false,
        processData: false,
      })
      .done(function(data){
      })
      .fail();
    })