
var since = '2018-03-11 18:28:54';
var interval = null;
var id = 1;

$(function() {
    intreval = setInterval(getNewData, 1000);
});

function getNewData() {
	
	$.ajax({
		type: "GET",
		url: "http://localhost/dron/get_data/index.php",
		data: "since=" + encodeURIComponent(since),
		success: function(response) {
			since = response['last'];
			console.log(since);
			response['data'].forEach(function(e){
					var teplota   = e['teplota'];
					var vlhkost   = e['vlhkost'];
					var tlak      = e['tlak'];
					var co2       = e['co2'];
					var rychlost  = e['rychlost'];
					var vyska     = e['vyska'];
					var zem_sirka = e['zem_sirka'];
					var zem_dlzka = e['zem_dlzka'];
					$('#tableHeader').after(`<tr><td>${teplota}</td><td>${vlhkost}</td><td>${tlak}</td><td>${co2}</td><td>${rychlost}</td><td>${vyska}</td><td>${zem_sirka}</td><td>${zem_dlzka}</td></tr>`);
				}
			);
		}
	});
	
}