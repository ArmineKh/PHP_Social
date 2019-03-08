let fr_id = $("#fr_id").val();
$.ajax({
	url: '/path/to/file',
	type: 'default GET (Other values: POST)',
	data: {action: 'showFriend', fr_id: fr_id},
	success: function(r){
	r = JSON.parse(r);
	console.log(r);
	r.forEach( function(item) {
		let d = $(`
		<img src="${r.photo}" width = "200" height = "200">
		<h1>${r.name}  ${r.surname}</h1>
		<h1>${r.age}</h1>	
			`);
		$("#fr_div").append(d);
		
	});

	}

	// serverioc vercnel frendi tvyalnery statusnery photonery u avelacnel frienf.phpum
});
