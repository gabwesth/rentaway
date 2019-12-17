    // ****************************************** create user ****************************************** 
    $(document).on('click', '#createUser', function (){
        var form_data = new FormData();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        var today = yyyy + '-' + mm + '-' + dd;

        el = $(this);
  
        form_data.append("cName", $("#newUserName").val());
        form_data.append("cSurname", $("#newSurname").val());
        form_data.append("cEmail", $("#newEmail").val());
        form_data.append("cEncriptedPassword", $("#newEncriptedPassword").val());
        form_data.append("cAddress", $("#newUserAddress").val());
    
        console.log(JSON.stringify(Object.fromEntries(form_data)))
          $.ajax({
            url : "../../apis/api-sign-up.php",
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
                <td>${today}</td>
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
    $("#newTotalAmountSpent").val($("#U-"+id).children()[7].innerText);
    $("#confirmUserUpdate").val($("#U-"+id).children()[0].innerText);

  })

    // ****************************************** update user ****************************************** 
    $(document).on('click', "#confirmUserUpdate", function (){
      var form_data = new FormData();
      el = $(this);
      id = $(el).val();
      form_data.append("cName", $("#newUserName").val());
      form_data.append("cSurname", $("#newSurname").val());
      form_data.append("cEmail", $("#newEmail").val());
      form_data.append("cEncriptedPassword", $("#newEncriptedPassword").val());
      form_data.append("cAddress", $("#newUserAddress").val());
      form_data.append("nTotalAmountSpent", $("#newTotalAmountSpent").val());
      form_data.append("nUserID", id);

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

    $(document).on('blur', "#name-filter", function (){
      $('#user-list tr:not(:first)' ).remove();
      el = $(this);
      name = $(el).val();
      $.ajax({
        url : "../../apis/user/read-by-name.php?name="+name,
        method : "GET",
        contentType: false,
        cache: false,
        processData: false,
      })
      .done(function(data){
        users = data.data;
        users.forEach(user => {
          $('#user-list').append(`
              <tr id=U-${user.nUserID} >
                <th>${user.nUserID}</th>
                <td>${user.cName}</td>
                <td>${user.cSurname}</td>
                <td>${user.cEmail}</td>
                <td>${user.cEncriptedPassword}</td>
                <td>${user.cAddress}</td>
                <td>${user.dSignUpDate}</td>
                <td>${user.nTotalAmountSpent}</td>
                <td><button id='deleteUser' class="button" value="${user.nUserID}"> Delete </button></td>
                <td><button id='updateUser' class="button" value="${user.nUserID}"> Update </button></td>
              </tr>
            `);
        });
      })
      .fail();
  
    })