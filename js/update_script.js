$(document).ready(function(e){

    $("#updateInfoForm").on("click", function(e){
      e.preventDefault()
      let id = $("#customerId").val()
      let emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
  
      if (!emailPattern.test($("#email").val())) {
        alert("Invalid email")
        return
      }
  
      $.ajax({
        url: `http://localhost/Final-Mandatory/API/customers`,
        type: "POST",
        data: {
          "firstName": $("#firstName").val(),
          "lastName": $("#lastName").val(),
          "company": $("#company").val(),
          "address": $("#address").val(),
          "city": $("#city").val(),
          "state": $("#state").val(),
          "country": $("#country").val(),
          "postalCode": $("#postalCode").val(),
          "phone": $("#phoneNumber").val(),
          "fax": $("#fax").val(),
          "email": $("#email").val(),
        },
        success: function(data){
          console.log(data)
          if(data){
            $("#updateInfoForm").submit()
          } else {
            alert("User update failed")
          }
        },
        failure: function(e){
          console.log("Failure")
          console.log(e)
        }
      })
    })
  })