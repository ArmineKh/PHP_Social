
//*******************  SHOW FRIEND PROFILE *******//

let fr_id = $("#fr_id").val();
$.ajax({
	url: 'server.php',
	type: 'POST',
	data: {action: 'showFriend', fr_id: fr_id},
	success: function(r){
	r = JSON.parse(r);
	r.forEach( function(item) {
		let d = $(`
		<img src="${item.photo}" width = "200" height = "200">
		<h1>${item.name}  ${item.surname}</h1>
		<h1>${item.age}</h1>	
			`);
		$("#home").append(d);
		
	});

	}
});
//******************* END SHOW FRIEND PROFILE *******//


//*******************  SHOW FRIEND PHOTOS *******//
	$.ajax({
	url: 'server.php',
	type: 'POST',
	data: {action: 'showFrPhoto', fr_id: fr_id},
	success: function(r){
		r = JSON.parse(r);
		let imgdiv = $(`<div id='imgdiv'></div>`);
		r.forEach(function(item){
		let i = $(`<img src="${item.photos}" class='imgd' width = "200" height = "200">`);
		imgdiv.append(i);
		});
		$("#menu1").append(imgdiv);
	}
})
//******************* END SHOW FRIEND PHOTOS *******//

//*******************  SHOW FRIEND's STATUSES *******//
$.ajax({
	url: "server.php",
	type: "POST",
	data: {action: 'showFrStatus', fr_id: fr_id},
	success: function(r){
		r = JSON.parse(r);
		console.log(r)
		let id = fr_id;
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
      $("#menu2").append(s);
    });
  }
	})


//tvyal friendi statusnery vercnum e, sxalnery veracnel  



//******************* End SHOW FRIEND's STATUSES *******//

//*******************  SHOW FRIEND's FRIENDS *******//
$.ajax({
	url: 'server.php',
	type: 'POST',
	data: {action: "showFrFrends", fr_id: fr_id},
	success: function(r){
		r = JSON.parse(r);
		console.log(r);
		r.forEach( function(item) {
        let n = $(`<div class="frFrends" id="${item.id}">
          <img src="${item['photo']}" width = "100" height = "100" style = 'border-radius:12px'>
         <a href="friend.php" id="${item.id}"> ${item['name']} ${item['surname']}</a>
          </div>`);
        $("#menu3").append(n);
      });

	}
})

//*******************  SHOW FRIEND's FRIENDS *******//



