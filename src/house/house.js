    // ****************************************** create property ****************************************** 
    $(document).on('click', '#createHouse', function (){
        var form_data = new FormData();

        el = $(this);
  
        form_data.append("cName", $("#newName").val());
        form_data.append("cDescription", $("#newDescription").val());
        form_data.append("nSqm", $("#newSqm").val());
        form_data.append("nCapacity", $("#newCapacity").val());
        form_data.append("cCity", $("#newCity").val());
        form_data.append("cAddress",  $("#newAddress").val());
        form_data.append("nPricePerDay",  $("#newPricePerDay").val());
    
          $.ajax({
            url : "../../apis/house/create.php",
            method : "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
          })
          .done(function(data){
            var house = JSON.parse(data);
            $('#house-list').append(`
              <tr id=H-${house.nHouseID} >
                <td>${house.nHouseID}</td>
                <td>${house.cName}</td>
                <td>${house.cDescription}</td>
                <td>${house.nSqm}</td>
                <td>${house.nCapacity}</td>
                <td>${house.cCity}</td>
                <td>${house.cAddress}</td>
                <td>${house.nPricePerDay}</td>
                <td><button id='deleteHouse' class="button" value="${house.nHouseID}"> Delete </button></td>
              </tr>
            `);
          })
          .fail();
    
      })
      // ****************************************** delete house ****************************************** 
  $(document).on('click', "#deleteHouse", function (){
    var form_data = new FormData();
    el = $(this);
    id = $(el).val();
    form_data.append("nHouseID", id);
    $.ajax({
      url : "../../apis/house/delete.php",
      method : "DELETE",
      data: JSON.stringify(Object.fromEntries(form_data)),
      contentType: false,
      cache: false,
      processData: false,
    })
    .done(function(data){
      $('#H-'+id).remove();
    })
    .fail();

  })
    
  // ****************************************** update house ****************************************** 
  $(document).on('click', "#updateHouse", function (){
    el = $(this);
    id = $(el).val();
    $("#newName").val($("#H-"+id).children()[1].innerText);
    $("#newDescription").val($("#H-"+id).children()[2].innerText);
    $("#newSqm").val($("#H-"+id).children()[3].innerText);
    $("#newCapacity").val($("#H-"+id).children()[4].innerText);
    $("#newCity").val($("#H-"+id).children()[5].innerText);
    $("#newAddress").val($("#H-"+id).children()[6].innerText);
    $("#newPricePerDay").val($("#H-"+id).children()[7].innerText);
    $("#confirmHouseUpdate").val($("#H-"+id).children()[0].innerText);
  })

    // ****************************************** update house ****************************************** 
    $(document).on('click', "#confirmHouseUpdate", function (){
      var form_data = new FormData();
      el = $(this);
      id = $(el).val();
      form_data.append("nHouseID", id);
      form_data.append("cName", $("#newName").val());
      form_data.append("cDescription", $("#newDescription").val());
      form_data.append("nSqm", $("#newSqm").val());
      form_data.append("nCapacity", $("#newCapacity").val());
      form_data.append("cCity", $("#newCity").val());
      form_data.append("cAddress",  $("#newAddress").val());
      form_data.append("nPricePerDay",  $("#newPricePerDay").val());

      $.ajax({
        url : "../../apis/house/update.php",
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