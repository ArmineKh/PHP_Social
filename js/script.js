$("#save").click(function(event) {
  let name = $("#name").val();
  let surname = $("#surname").val();
  let age = $("#age").val();
  let email = $("#email").val();
  let password = $("#password").val();
  let cPassword = $("#cPassword").val();
  $.ajax({
    url: 'server.php',
    type: 'POST',
    data: {action: 'signup', name: name, surname: surname,age: age,
    email:email, password:password, cPassword:cPassword},
    success: function(r){
      if (r) {
        r = JSON.parse(r);
        $(".error").remove();
        $("input").css({borderColor: "black"});
        for(let i in r){
          $("#"+i).css({borderColor: "red"});
          $("#"+i).before(`<h6 class = "text-danger error">${r[i]}</h6>`);
        }
      } else {
        $("body").append(`<h1 class = "text-center text-success">Duq hajoxutyamb grancvel eq</h1>`);
        setInterval(() => {
          location.href = "login.php";
        }, 2000);
      }

    }
  });
});


