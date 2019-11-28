function getdata(aURL)
{
	var proxy ='https://cors-anywhere.herokuapp.com/';
    console.log("Getting " + aURL);
    $.ajax({
    crossOrigin: false,
    //dataType: 'json',
    url: proxy + aURL,
    type: 'GET'
    }).done(function(data){formtable(data)
    })
}

function formtable (jsonData)
{
	console.log(jsonData);
	if(jsonData.length == 4)
	{
		alert("Sorry, there is no data for that. Try again!");
		removeTable();
	}
	else
	{
		document.getElementById('Location').innerHTML = jsonData.timezone;
		document.getElementById('Hourly').innerHTML = jsonData.hourly.summary;

	}


}
