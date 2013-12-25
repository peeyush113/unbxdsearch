<?php ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Awesome Movies</title>
		<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="style/main.css">
		<script src="//code.jquery.com/jquery.js" type="text/javascript"></script>
		<script src="lib/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="container">
			<div id="divSearchBox" name="divSearchBox" class="search-box-center">
				<form id="search-form" name="search-form" action="search" method="get" accept-charset="utf-8" onsubmit="">
					<div class="row">
						<div class="col-lg-6 col-lg-offset-3">
							<div class="input-group input-group-lg">
								<input id="search-input" name="search-input" type="text" class="form-control" placeholder="Let`s search for some movie">
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit">
										<span class="glyphicon glyphicon-search"></span>
									</button>
								</span>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div id="searchInfo" name="searchInfo" class="search-info">
				<ul class="pager">
					<li><a id ="previous" href="#">Previous</a></li>
					<li><a id ="next" href="#">Next</a></li>
				</ul>
				<!-- <span id="spanSearchInfo" name="spanSearchInfo">Next</span> -->
			</div>
			<div id="searchResult" name="searchResult" class="search-result col-lg-12">
				<div id="searchResultData" name="searchResultData" class="search-result-data col-lg-4">
				</div>
				<div id="searchResultInfo" name="searchResultInfo" class="search-result-info col-lg-6">
				</div>
			</div>
		</div>
	</body>
</html>