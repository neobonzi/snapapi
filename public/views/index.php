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
<div class="cold-md-8 col-md-offset-2">
	<flash-messages></flash-messages>
</div>
<div class="col-md-8 col-md-offset-2">
	<div class="users-page" ng-show="userPage">
		<div class="page-header">
			<h2>User Management</h2>
		</div>
		<div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="usersNavTo('all')">All Users</a></li>
				<li><a ng-href="#here" ng-click="usersNavTo('new')">New</a></li>
			</ul>
		</div>
		<p class="text-center" ng-show="loading">
			<span class="fa fa-clock-o fa-3x fa-spin"></span>
		</p>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Username</th>
					<th>Email</th>
					<th>Delete</th>
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
		<div>
			<ul class="nav nav-tabs">
				<li class="active"><a ng-href="#here" ng-click="groupsNavTo('all')">All Groups</a></li>
				<li><a ng-href="#here" ng-click="groupsNavTo('new')">Create New</a></li>
				<li><a ng-href="#here" ng-click="groupsNavTo('manage')">Manage Groups</a></li>
			</ul>
		</div>
		<div ng-show="groups_allGroups">
			<p class="text-center" ng-show="loading">
				<span class="fa fa-clock-o fa-3x fa-spin"></span>
			</p>
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Members</th>
					</tr>
				</thead>
				<tbody>
					<tr class="group" ng-repeat="group in groups">
						<td>{{ group.id }}</td>
						<td>{{ group.name }}</td>
						<td>
							<span class="groupMember" ng-repeat="member in group.members">
								{{ member.username }},
							</span>
						</td>
						<td class="text-center">
							<a ng-href="#here" ng-click="deleteGroup(group.id)" class="delete-user-icon glyphicon glyphicon-remove"></span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div ng-show="groups_newGroup">
			Make a new group
		</div>
		<div ng-show="groups_manageGroups">
			<form class="form-horizontal" role="form">
				<div class="row">
					<div class="col-xs-12">
						<h4>Place User in Group</h4>
						<p>Choose a user and a group and submit to place that user in that group</p>
					</div>
					<div class="col-xs-6">
						<label>Choose a User</label>
						<select class="form-control" data-ng-model="mg_users">
							<option ng-value="{{ user.id }}" ng-repeat="user in users">{{ user.username }}</option>
						</select>
					</div>
					<div class="col-xs-6">
						<label>Choose a group</label>
						<select class="form-control" data-ng-model="mg_groups">
							<option ng-value="{{ group.id }}" ng-repeat="group in groups">{{ group.name }}</option>
						</select>
						<button type="submit" data-ng-click="addUserToGroup(form)" class="btn btn-success pull-right">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="games-page" ng-show="gamePage">
		<div class="page-header">
			<h2>Game Management</h2>
		</div>
	</div>
	<div class="seeds-page" ng-show="seedPage">
		<div class="page-header">
			<h2>Seeds</h2>
		</div>
	</div>
</div>
</body>
</html>