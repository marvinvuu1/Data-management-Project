
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
	var parsedJson = JSON.parse(jsonData);
	console.log(parsedJson.length)
	if(parsedJson.length == 1)
	{
		var node = document.createElement("h5");
		var text = document.createTextNode("No data");
		node.appendChild(text);
		document.getElementById("nodata").appendChild(node)

	}
	else
	{
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
			table = $('#outtable').DataTable({
				data: parsedJson,
				"columns": columns
			});
		});
	}
}
