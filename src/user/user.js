    // ****************************************** create user ****************************************** 
    $(document).on('click', '#createUser', function (){
        var form_data = new FormData();

        el = $(this);
  
        form_data.append("cName", $("#newUserName").val());
        form_data.append("cSurname", $("#newSurname").val());
        form_data.append("cEmail", $("#newEmail").val());
        form_data.append("cEncriptedPassword", $("#newEncriptedPassword").val());
        form_data.append("cAddress", $("#newUserAddress").val());
        form_data.append("dSignUpDate", $("#newSignUpDate").val());
        form_data.append("nTotalAmountSpent",  $("#newTotalAmountSpent").val());
    
        console.log(JSON.stringify(Object.fromEntries(form_data)))
          $.ajax({
            url : "../../apis/user/create.php",
            method : "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
          })
          .done(function(data){
            var user = JSON.parse(data);
            $('#user-list').append(`
              <tr id=U >
                <th>${user.nUserID}</th>
                <td>${user.cName}</td>
                <td>${user.cSurname}</td>
                <td>${user.cEmail}</td>
                <td>${user.cEncriptedPassword}</td>
                <td>${user.cAddress}</td>
                <td>${user.dSignUpDate}</td>
                <td>${user.nTotalAmountSpent}</td>
                <td><button id='deleteUser' class="button" value=""> Delete </button></td>
                <td><button id='updateUser' class="button" value=""> Update </button></td>
              </tr>
            `);
          })
          .fail();
    
      })
      // ****************************************** delete user ****************************************** 
  $(document).on('click', "#deleteUser", function (){
    var form_data = new FormData();
    el = $(this);
    id = $(el).val();
    form_data.append("nUserID", id);
    $.ajax({
      url : "../../apis/user/delete.php",
      method : "DELETE",
      data: JSON.stringify(Object.fromEntries(form_data)),
      contentType: false,
      cache: false,
      processData: false,
    })
    .done(function(data){
      $('#U-'+id).remove();
    })
    .fail();

  })
    
  // ****************************************** update user ****************************************** 
  $(document).on('click', "#updateUser", function (){
    el = $(this);
    id = $(el).val();
    $("#newUserName").val($("#U-"+id).children()[1].innerText);
    $("#newSurname").val($("#U-"+id).children()[2].innerText);
    $("#newEmail").val($("#U-"+id).children()[3].innerText);
    $("#newEncriptedPassword").val($("#U-"+id).children()[4].innerText);
    $("#newUserAddress").val($("#U-"+id).children()[5].innerText);
    $("#newSignUpDate").val($("#U-"+id).children()[6].innerText);
    $("#newTotalAmountSpent").val($("#U-"+id).children()[7].innerText);
    $("#confirmUserUpdate").val($("#U-"+id).children()[0].innerText);

  })

    // ****************************************** update user ****************************************** 
    $(document).on('click', "#confirmUserUpdate", function (){
      var form_data = new FormData();
      el = $(this);
      id = $(el).val();
      form_data.append("nUserID", id);
      form_data.append("cName", $("#newUserName").val());
      form_data.append("cSurname", $("#newSurname").val());
      form_data.append("cEmail", $("#newEmail").val());
      form_data.append("cEncriptedPassword", $("#newEncriptedPassword").val());
      form_data.append("cAddress", $("#newUserAddress").val());
      form_data.append("nTotalAmountSpent", $("#newTotalAmountSpent").val());

      $.ajax({
        url : "../../apis/user/update.php",
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