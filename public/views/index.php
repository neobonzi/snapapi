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
	</style>

	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->

	<!-- ANGULAR -->
	<!-- all angular resources will be loaded from the /public folder -->
	<script src="js/angular-flash.js"></script> <!-- load our controller -->
	<script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
	<script src="js/services/userService.js"></script> <!-- load our service -->
	<script src="js/app.js"></script> <!-- load our application -->
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
			<a class="navbar-brand" href="#">SnapHunt Admin</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a ng-href="#here" ng-click="navTo('users')">Users</a></li>
				<li><a ng-href='#here' ng-click="navTo('groups')">Groups</a></li>
				<li><a ng-href='#here' ng-click="navTo('games')">Games</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="col-md-8 col-md-offset-2">
	<div class="users-page" ng-show="userPage">
		<div class="page-header">
			<h2>User Management</h2>
		</div>
		<flash-messages></flash-messages>
		<div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#">Show All</a></li>
				<li><a href="#">Create New</a></li>
			</ul>
		</div>
		<p class="text-center" ng-show="loading">
			<span class="fa fa-meh-o fa-5x fa-spin"></span>
		</p>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Username</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr class="user" ng-repeat="user in users">
					<td>{{ user.id }}</td>
					<td>{{ user.username }}</td>
					<td>{{ user.email }}</td>
					<td class="text-center">
						<a ng-href="#here" ng-click="deleteUser(user.id)" class="delete-user-icon glyphicon glyphicon-remove"></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="groups-page" ng-show="groupPage">
		<div class="page-header">
			<h2>Group Management</h2>
		</div>
	</div>
	<div class="games-page" ng-show="gamePage">
		<div class="page-header">
			<h2>Game Management</h2>
		</div>
	</div>
</div>
</body>
</html>