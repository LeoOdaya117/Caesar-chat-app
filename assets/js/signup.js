$(document).ready(function () {  
    $('#signup_form').submit(function (event) { 
        
        event.preventDefault();                 
        var form = document.getElementById('signup_form'); 
        var formData = new FormData(form); 
        
        $.ajax({ 

            url: 'signup.php', 
            method: 'POST', 
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function (response) {                       
                response = response.trim();
            if(response === "Success"){
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Signup Successful",
                    showConfirmButton: true,
                }).then(function () {
                    window.location.href = "login_page.html";
                });
            }
            else{
                Swal.fire({
                    icon: "info",
                    title: "Result",
                    text: response,
                    showConfirmButton: true,
                });
            }
                
            }
            
        }); 

    }); 
}); 