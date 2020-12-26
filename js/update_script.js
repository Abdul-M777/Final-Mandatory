$(document).ready(function(e){

    $("#updateInfo").on("click", function(e){
      e.preventDefault()
      let id = $("#customerId").val()
      let emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
      console.log(id)
      if (!emailPattern.test($("#email").val())) {
        alert("Invalid email")
        return
      }
  
      $.ajax({
        url: `API/customer?id=${id}`,
        contentType: "application/json; charset=utf-8",
        type: "POST",
        data:{
          'firstName': $("#firstName").val(),
          'lastName': $("#lastName").val(),
          'company': $("#company").val(),
          'address': $("#address").val(),
          'city': $("#city").val(),
          'state': $("#state").val(),
          'country': $("#country").val(),
          'postalCode': $("#postalCode").val(),
          'phone': $("#phoneNumber").val(),
          'fax': $("#fax").val(),
          'email': $("#email").val(),
        },
        cache: false,
        success: function(data){
          console.log("Data: "+data);
          console.log($("#city").val());
          if(data){
            $("#updateInfoForm").submit()
          } else {
            alert("User update failed")
          }
          console.log(data);
        },
        failure: function(e){
          console.log("Failure")
          console.log(e)
        }
      })
    })
  })