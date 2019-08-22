/*********************** SEARCH  USER *********************************/
$(document).on("input", "#search", function(){
  let search = $("#search").val();
  $("#search_result").empty()
  if (search) {
 
    $.ajax({
      url: 'server.php',
      type: 'POST',
      data: {action: 'search', search: search},
      success: function(r){
        r = JSON.parse(r);
        r.forEach( function(item) {
            let text=`<button class="btn btn-sm btn-success float-right mt-2 add" data-id="${item.id}">Add Friend</button>`
            if (item.status==3) {
              text=''
            }
            else if (item.status==1) {
              text = `<button class="btn btn-sm btn-info float-right mt-2">Friend</button>`
            }
            else if (item.status==2) {
              text = `<button class="btn btn-sm btn-danger float-right mt-2 del_req" data-id="${item.id}">Delete Request</button>`
            }

          let n = $(`<div class="user_item p-3 bg-dark text-light" style = "width:321px">
            <h6>
            <img src="${item['photo']}" width = "50" height = "50" style = 'border-radius:50%'>
            ${item['name']} ${item['surname']}
            ${text}
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
  $(this).after(` <button class="btn btn-sm btn-danger float-right mt-2 del_req" data-id="${id}">Delete Request</button>`)
  $(this).remove();
  $.ajax({
    url: 'server.php',
    type: 'POST',
    data: {action: 'addFriendRequest', id : id},
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

/***************** DELETE REQUEST **************************/

$(document).on("click", ".del_req", function(){
let friend_id = $(this).attr('data-id');
let d = $(this);
$.ajax({
  url: 'server.php',
  type: 'POST',
  data:{action: ' deleteRequest', friend_id: friend_id},
  success: function(r){
   d.attr("html", "Add Request").removeClass('del_req').addClass('add');
  }
})
})

/***************** END DELETE REQUEST **************************/


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
      r = JSON.parse(r);
      r.forEach( function(item) {
        let n = $(`<div class=" p-3 bg-dark text-light" id="${item.id}">
          <img src="${item['photo']}" width = "50" height = "50" style = 'border-radius:50%'>
         <a href="friend.php?id=${item.id}"> ${item['name']} ${item['surname']}</a>
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
let int
$(document).on("click",".friend", function(){
  let friend_id = $(this).attr('data-id');
  $("#friend_list").hide()
  getMessage(friend_id);
  clearInterval(int)
  int = setInterval(getMessage,1000,friend_id)
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


/***************** SHOW MESSAGE **************************/

function getMessage(id){
  console.log(id)
$.ajax({
  url: 'server.php',
  type: 'POST',
  data: {action: 'getMessage', friend_id: id},
  success: function(r){
    r = JSON.parse(r);
  $(".message").empty()
    r.forEach(function(item){

      if (item.my_id != id) {
         let m = $(`<div class='parentDiv'><div class='my'>
                  <h6>${item.message}</h6>
                  <small>${item.time}</small>
        </div></div>`);
      $(".message").append(m);

      }
      else{

      let m = $(`<div class='parentDiv'><div class='you'>
                  <h6>${item.message}</h6>
                  <small>${item.time}</small>
          </div></div>`);
      $(".message").append(m);
      }
    })
  }
});

}

/***************** SHOW MESSAGE **************************/

/***************** Close CHATBOX **************************/
$(document).on("click", ".close", function(){
 clearInterval(int);
  $(".messDiv").hide();
});

/***************** END Close CHATBOX **************************/

/***************** add Status **************************/


$(document).on("click", ".post", function(){
let status = $(".addStatus").val();
$.ajax({
  url: 'server.php',
  type: 'POST',
  data: {action: 'addStatus', status: status },
  success: function(r){
     $(".addStatus").val('');
  }
});

});
/***************** END add Status **************************/

/***************** show Status **************************/

function showStatus(){
$.ajax({
  url: 'server.php',
  type: 'POST',
  data: {action: 'showStatus'},
  success: function(r){
    r = JSON.parse(r);
    let id = $("#id").val()
    r.forEach(function(item){
      let k= item.likes.some(a=>a.id==id)
      let comment = ''
      item.comment.forEach(function(i){
        comment+=`<div>
            <img src="${i.photo}" width=50 height=50/>${i.name +' '+ i.surname}<br>${i.comment}
        </div>`
      })

       let likes = ''
        item.likes.forEach(function(i){
        likes+=`<div class="like_user">
            <img src="${i.photo}" width=50 height=50/>${i.name +' '+ i.surname}
        </div>`
      })
      let s = $(`<div class ='status_item'>
          <div>
            <img src=" ${item.photo}" width=50  height=50 style='border-radius:50%'/> ${item.name} ${item.surname}
          </div>
          ${item.status} <br />
          <b class='likeCount'>${item.likes.length}</b>
          <img src="images/${(k)?'dislike':'like'}.png" class='${(k)?'dislike':'like'}' width= '40' id = "${item.id}">
           <div class='like_users'>${likes}</div>
          <div class='comment'>
            <textarea class='comment_mess' ></textarea>
            <button class='add_comm' id='${item.id}'>Add</button>
            <button id="showComm">Show comments</button>
            <div class='comment_div'>${comment}</div>
          </div>
        </div>`);
      $(".showStatus").append(s);
    });
  }
});
}
showStatus();

/***************** END show Status **************************/

/***************** add like **************************/

$(document).on("click", ".like", function(){
  let post_id = $(this).attr("id");
  let  t =$(this);
$.ajax({
  url: 'server.php',
  type: 'POST',
  data: {action: 'addlike', post_id: post_id},
  success: function(r){
  let count =  t.prev().html();
   t.prev().html(++count);
   t.attr("src",'images/dislike.png').removeClass('like').addClass('dislike');
  }
});
});

/***************** END add like **************************/

/*****************  add comment **************************/

$(document).on("click", '.add_comm', function(){
  let post_id = $(this).attr('id');
  let comment = $(this).prev().val();

  let t = $(this);
$.ajax({
  url: "server.php",
  type: "POST",
  data: {action: 'addComment', post_id: post_id, comment: comment},
  success: function(r){

     t.parent().find(".comment_div").fadeIn();
    t.prev().val("");
    $(".comment_div").append(comment);
  }
})
});

/***************** END add comment **************************/

/*****************  add like and dislike **************************/

$(document).on("click", ".dislike", function(){
  $(this).attr("src","images/like.png").removeClass('dislike').addClass('like');
});

$(document).on("click", ".likeCount", function(){
  let t = $(this);
  t.parent().find(".like_user").fadeIn();
});

$(document).on("click", "#showComm", function(){
  let t = $(this);
  t.parent().find(".comment_div").slideToggle();
});

/***************** End add like and dislike **************************/

