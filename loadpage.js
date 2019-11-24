
function loadpage(apiURL){
	console.log("Getting " + apiURL);
	$.ajax({
	crossOrigin: false,
	url: apiURL,
	type: 'GET'
	}).done(function(data){tableformat(data)
	})
}

function tableformat(jsonData){
	var parsedJson = JSON.parse(jsonData);
	console.log(parsedJson);
	var columns = [];
		$.each(parsedJson[0], function(key,value){
		var my_item = {};
		my_item.title = key;
		my_item.data = key;
		columns.push(my_item);
		console.log("key: "+ key + " value: "+ value);
	});
	console.log(columns);
	$(document).ready(function(){
		$('#outtable').DataTable({
			data: parsedJson,
			"columns": columns
		});
	});
}
