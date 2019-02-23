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
    data: {action: 'ajax1', name: name, surname: surname,age: age,
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

$(document).on("input", "#search", function(){
  let search = $("#search").val();
  $("#search_result").empty()
  if (search) {

    $.ajax({
      url: 'server.php',
      type: 'POST',
      data: {action: 'ajax2', search: search},
      success: function(r){
        r = JSON.parse(r);
        console.log(r);
        r.forEach( function(item) {
          let n = $(`<div class="user_item p-3 bg-dark text-light" style = "width:300px">
            <h6>
            <img src="${item['photo']}" width = "50" height = "50" style = 'border-radius:50%'>
            ${item['name']} ${item['surname']}
            <button class="btn btn-sm btn-success float-right mt-2" data-id="${item.id}">Add Friend</button>
            </h6></div>`);
          $("#search_result").append(n);


        });

      }
    });
  }
});



$(document).on('click','.add', function(){
 let id = $(this).data('id');
 console.log(id)
 $.ajax({
   url: 'server.php',
   type: 'POST',
   data: {action: 'ajax3', id : id},
   success: function(r){
     console.log(r);
   }
 });
});


