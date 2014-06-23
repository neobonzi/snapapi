<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Snaphunt API Bootstrap Admin</title>

	<!-- CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> <!-- load bootstrap via cdn -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- load fontawesome -->
	
	<style>
	body 	{ padding-top: 30px; }
	form	{ padding-bottom: 20px; }
	.delete-user-icon	{ color: red; }
	.delete-user-icon:hover { cursor: pointer; cursor: hand; text-decoration: none; color: red;}
	.snaplogo { vertical-align:middle; display: inline-block; line-height: 50px; color: #BEC1C2;}
	.btn { margin: 5px; }
	#user_search { margin-top: 10px; } 
	#user_search input { display:inline-block; margin-top: 5px;}
	#user_search .form-group { float: left; }
	#user_search button { display:inline-block; }
	#flash-messages { margin-top:30px; }
	#footer {background-color: #f5f5f5;}
	</style>

	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->

	<!-- ANGULAR -->
	<!-- all angular resources will be loaded from the /public folder -->
	<script src="js/angular-flash.js"></script> <!-- load our controller -->
	<script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
	<script src="js/services/userService.js"></script> <!-- load our service -->
	<script src="js/services/groupService.js"></script> <!-- load our service -->
	<script src="js/app.js"></script> <!-- load our application -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.js"></script>
</head>
<body class="container" ng-app="bootstrapApp" ng-controller="mainController">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<span class="snaplogo fa fa-camera-retro fa-2x pull-left"></span>
			<a class="navbar-brand" href="#">SnapHunt Admin</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a ng-href="#here" ng-click="navTo('users')">Users</a></li>
				<li><a ng-href='#here' ng-click="navTo('groups')">Groups</a></li>
				<li><a ng-href='#here' ng-click="navTo('games')">Games</a></li>
				<li><a ng-href='#here' ng-click="navTo('seeds')">Seeds</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="col-md-8 col-md-offset-2">
	<flash-messages></flash-messages>
	<form>
		<div class="form-group">
			<input type="text" data-ng-model="nu_search" class="form-control" placeholder="Search">
		</div>
		<button type="submit" data-ng-click="lookupUser(form)" class="btn btn-default">Submit</button>
	</form>
</body>
</html>