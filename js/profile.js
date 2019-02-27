/*********************** SEARCH  USER *********************************/
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
          let n = $(`<div class="user_item p-3 bg-dark text-light" style = "width:321px">
            <h6>
            <img src="${item['photo']}" width = "50" height = "50" style = 'border-radius:50%'>
            ${item['name']} ${item['surname']}
            <button class="btn btn-sm btn-success float-right mt-2 add" data-id="${item.id}">Add Friend</button>
            </h6></div>`);
          $("#search_result").append(n);


        });

      }
    });
  }
});
/***************** END SEARCH **************************/

/***************** ADD FRIEND_request **************************/

$(document).on('click','.add', function(){
  let id = $(this).data('id');
  $(this).after(` <button class="btn btn-sm btn-danger float-right mt-2 delete_request" data-id="${id}">Delete Request</button>`)
  $(this).remove();
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
/***************** END FRIEND_REQUEST **************************/


/***************** SHOW REQUEST **************************/

function getRequest(){
  $.ajax({
    url: 'server.php',
    type: 'POST',
    data: {action: 'getRequest'},
    success: function(r){
      console.log(r);
      r = JSON.parse(r);
      r.forEach( function(item) {
        let n = $(`<div class=" p-3 bg-dark text-light" style = "width:500px">
          <img src="${item['photo']}" width = "50" height = "50" style = 'border-radius:50%'>
          ${item['name']} ${item['surname']}
          <button class="btn btn-sm btn-success float-right mt-2 add_friend" data-id="${item.id}">Add Friend</button>
          <button class="btn btn-sm btn-danger float-right mt-2 delete_request" data-id="${item.id}">Delete Request</button>
          </div>`);
        $("#request_result").append(n);


      });
    }
  });
}
getRequest()

/***************** END REQUEST **************************/




$(".notific_icon").click(function(event) {
  $("#request_result").slideToggle('slow');
});

$(".friend_icon").click(function(event) {
  $("#friend_list").slideToggle('slow');
});

$(".profpic").change(function(event) {
  $(".myform").submit();
});


/***************** Add Friend **************************/
$(document).on("click",".add_friend", function(){
  let friend_id = $(this).attr('data-id');
  $(this).parent().remove();
  $.ajax({
    url: 'server.php',
    type: 'POST',
    data: {action: 'addFriend', friend_id : friend_id},
    success: function(r){
      console.log(r);
    }
  });

})
/***************** END Add Friend **************************/



/***************** DELETE REQUEST **************************/
$(document).on("click",".delete_request", function(){
  let friend_id = $(this).attr('data-id');
  $(this).parent().remove();
  $.ajax({
    url: 'server.php',
    type: 'POST',
    data: {action: 'deleteRequest', friend_id : friend_id},
    success: function(r){
      console.log(r);
    }
  });
})

/***************** END DELETE REQUEST **************************/



/***************** SHOW FRIENS **************************/

function showFrinds(){
  $.ajax({
    url: 'server.php',
    type: 'POST',
    data: {action: 'showFrinds'},
    success: function(r){
      console.log(r);
      r = JSON.parse(r);
      r.forEach( function(item) {
        let n = $(`<div class=" p-3 bg-dark text-light">
          <img src="${item['photo']}" width = "50" height = "50" style = 'border-radius:50%'>
          ${item['name']} ${item['surname']}
          <img src = "images/mess.png" class="friend" width = '30' data-id="${item.id}" >
          </div>`);
        $("#friend_list").append(n);
      });
    }
  });
}
showFrinds();

/***************** END show Friends **************************/


/***************** SELECT Friends **************************/
$(document).on("click",".friend", function(){
  let friend_id = $(this).attr('data-id');
  getMessage(friend_id)
  console.log(friend_id);
  $.ajax({
    url: 'server.php',
    type: 'POST',
    data: {action: 'selectFriend', friend_id : friend_id},
    success: function(r){
      r = JSON.parse(r);
      r = r[0]
      $(".fr_data").html(`
        <img src="${r["photo"]}" width="30" height="30">
        ${r['name']}  ${r["surname"]}

        `)
      $(".send").attr("data-id", r['id']);
      $(".messDiv").fadeIn();
    }
  });
})

/***************** END SELECT Friends **************************/

/***************** SEND MESSAGE **************************/
$(document).on("click",".send", function(){
  alert()
  let friend_id = $(this).attr("data-id");
  let message = $(".addMess").val(); 
  $.ajax({
    url: 'server.php',
    type: 'POST',
    data: {action: 'sendMessage', friend_id: friend_id, message: message},
    success: function(){
      $(".addMess").val('');
    }
  });
});



/***************** END SEND MESSAGE **************************/

function getMessage(id){

}
