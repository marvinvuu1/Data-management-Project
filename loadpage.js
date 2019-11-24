
function loadpage(apiURL){
	console.log("Getting " + aURL);
	$.ajax({
	crossOrigin: false,
	url: aURL,
	type: 'GET'
	}).done(function(data){tableformat(data)
	})
}

function tableformat(jsonData){
	console.log(jsonData);
	var parsedJson = JSON.parse(jsonData);
	console.log(parsedJson);
	var columns = [];
		$.each(parsedJson[0], function(key,value){
		var records = {};
		records.title = key;
		records.data = key;
		columns.push(records);
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
