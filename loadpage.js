
function removeTable(){
	window.location.reload(true);
}
function loadpage(aURL){
	console.log("Getting " + aURL);
	$.ajax({
	crossOrigin: false,
	//dataType: 'json',
	url: aURL,
	type: 'GET'
	}).done(function(data){tableformat(data)
	})
}

function tableformat(jsonData){
	console.log(jsonData);
	if(jsonData.length == 4)
	{
		alert("Sorry, there is no data for that. Try again!");
		removeTable();
	}
	else
	{
		var parsedJson = JSON.parse(jsonData);
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
			table = $('#outtable').DataTable({
				data: parsedJson,
				"columns": columns
			});
		});
	}
}
