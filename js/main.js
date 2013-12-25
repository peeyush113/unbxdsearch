$(document).ready(function(){
	var rootURL = "/unbxd/index.php/";
	var lowerLimit = 0;
	var query = '';
	$('div#searchInfo').hide();
	
	$("form#search-form").submit(function(event) {
		lowerLimit = 0;
		event.preventDefault();
		query = $.trim($("input#search-input").val());
		if (!(/^\s*$/.test(query))) {
			$.ajax({
				url: rootURL+'search',
				data: {
					searchInput: query,
					lowerLimit: lowerLimit
				}
			})
			.done(function(response) {
				$( "div#divSearchBox").removeClass('search-box-center').addClass('search-box-top');
				$('div#searchResultData').html('');
				$('div#searchResultInfo').html('');
				var res = $.parseJSON(response);
				if (res.status == 200) {
					var data = res.data;
					$('#previous').parent().addClass('disabled');
					if (data.length < 10) {
						$('div#searchInfo').hide();
					} else{
						$('div#searchInfo').show();
					}
					showData(data);
				} else{
					alert("No data found for the requested query.");
				}
			})
			.fail(function() {
				alert("something wrong happen");
			});
		};
	});

	$('#previous').click(function (event) {
		event.preventDefault();
		if (!(lowerLimit-10 < 0)) {
			lowerLimit = lowerLimit-10;
			$.ajax({
				url: rootURL+'search',
				data: {
					searchInput: query,
					lowerLimit: lowerLimit
				},
			})
			.done(function(response) {
				$('div#searchResultData').html('');
				$('div#searchResultInfo').html('');
				var res = $.parseJSON(response);
				if (res.status == 200) {
					var data = res.data;
					$('div#searchInfo').show();
					$('#next').parent().removeClass('disabled');
					if (lowerLimit == 0) {
						$('#previous').parent().addClass('disabled');
					}
					showData(data);
				} else{
					alert("something wrong happen.");
				}
			})
			.fail(function() {
				console.log("error");
			})
		};
	})

	$('a#next').click(function (event) {
		event.preventDefault();
		if (!$('#next').parent().hasClass('disabled')) {
			lowerLimit = lowerLimit+10;
			$.ajax({
				url: rootURL+'search',
				data: {
					searchInput: query,
					lowerLimit: lowerLimit
				},
			})
			.done(function(response) {
				$('div#searchResultData').html('');
				$('div#searchResultInfo').html('');
				var res = $.parseJSON(response);
				if (res.status == 200) {
					var data = res.data;
					$('div#searchInfo').show();
					$('#previous').parent().removeClass('disabled');
					if (data.length < 10) {
						$('#next').parent().addClass('disabled');
					}
					showData(data);
				}else{
					alert("something wrong happen.");
				}
			})
			.fail(function() {
				console.log("error");
			})
		};
	})

	function showData (data) {

		for(result in data){
			var className = "divresult-"+data[result].id;
			
			var span = $('<span>')
			.addClass('span-result')
			.text(data[result].title);

			var div = $('<div>')
			.addClass('div-result')
			.addClass(className)
			.html(span);
			
			div.click(function(event) {
				var className = $(this).prop("class");
				var classNameId = className.split(' ');
				var id = classNameId[1].split('-');
				getDetail(id[1]);
			});
			$('div#searchResultData').append(div);
		}
	}
	function getDetail (id) {
		$.ajax({
			url: rootURL+'info',
			data: {
				infoId: id
			}
		})
		.done(function(response) {
			var res = $.parseJSON(response);
			$('div#searchResultInfo').html('');
			if (res.status == 200) {
				var data = res.data;
				for(result in data){
					var div = $('<div>').addClass('search-result-info-data');
					var h = $('<h4>').text(data[result].title);
					var pCategories = $('<p>').text(data[result].category_type+", "+data[result].sub_category_type);
					var pPrice = $('<p>').text("Price: Rs"+data[result].price_in_rs);
					var pDays = $('<p>').text("shipping duration: "+data[result].shipping_duration_in_day+'day');
					div.append(h);
					div.append(pCategories);
					div.append(pPrice);
					div.append(pDays);
					$('div#searchResultInfo').append(div);
				}
			} else{
				alert("something wrong happen");
			}
		})
		.fail(function() {
			alert("something wrong happen");
		});
	}
});