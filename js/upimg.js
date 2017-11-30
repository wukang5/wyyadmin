function upimg(url,imgId,data) {
	$.ajaxFileUpload({
		url: url,
		secureuri: false,
		data: data,
		fileElementId: imgId,
		dataType: 'json',
		success: function(data) {
			console.log(data)
//			alert("增加成功");
			// var datejson=eval(data);
			//				console.log(data[0].path_name.substring(3));
			//				$('#im').append('<img src="' + data[0].path_name.substring(3) + '">')
			//console.log('<img src="'+data[0].path_name+'">')
		},
		error: function(data) {
			console.log(data)
		}
	});
}