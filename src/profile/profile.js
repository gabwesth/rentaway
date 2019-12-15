	// ****************************************** update profile ****************************************** 

$(document).ready(function(){
	$("#submitChanges").click(function (){
		var form_data = new FormData();

		form_data.append("file", document.getElementById('file').files[0]);
		form_data.append("id", $(this).parent().attr('id'));
		form_data.append("name", $("input[name=txtName]").val());
		form_data.append("lastName", $("input[name=txtLastName]").val());
		
		// id email and uEmail is protected
		// consider sending new email and deactivate account.
		// var uEmail = $("input[name=txtEmail]").attr('value');

		$.ajax({
			url : "./../../apis/api-update-profile.php",
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
});

$("#file").change(function() {
	readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
		reader.readAsDataURL(input.files[0]);
    }
}

	