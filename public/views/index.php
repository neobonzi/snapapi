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
	<div class="users-page" ng-show="userPage">
		<div class="page-header">
			<h2>User Management</h2>
		</div>
		<div>
			<ul class="nav nav-tabs">
				<li class="active"><a ng-href="#here" ng-click="usersNavTo('all')">All Users</a></li>
				<li><a ng-href="#here" ng-click="usersNavTo('view')">Lookup User</a></li>
				<li><a ng-href="#here" ng-click="usersNavTo('new')">New User</a></li>
			</ul>
		</div>
		<div ng-show="users_allUsers">
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
							<a ng-href="#here" ng-click="deleteUser(user.id)" class="delete-user-icon glyphicon glyphicon-remove" /></a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div ng-show="users_viewUser">
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-7">
							<h4>View a User</h4>
							<p>Search for a user to view their stats</p>
						</div>
						<div class="col-xs-5" id="user_search">
							<form>
								<div class="form-group">
									<input type="text" data-ng-model="nu_search" class="form-control" placeholder="Search">
								</div>
								<button type="submit" data-ng-click="lookupUser(form)" class="btn btn-default">Submit</button>
							</form>
						</div>
					</div>
					<div class="row" ng-show="nu_user_details">
						<div class="col-xs-5">
							<h4>{{ vu.username }}</h4>
							<h5><b>Email:</b> {{ vu.email }}</h5>
							<h5><b>Phone:</b> {{ vu.phone }}</h5>
							<hr/>
							<h4>Groups</h4>
							<h5 ng-repeat="group in vu.groups">{{ group.name }}</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div ng-show="users_newUser">
			<form role="form">
				<div class="row">
					<div class="col-xs-12">
						<h4>Create a new User</h4>
						<p>Enter a username, password, and email to create a new user.</p>
					</div>
				</div>
				<div class="form-group">
					<label>Username</label>
					<input class="form-control" data-ng-model="nu_username" placeholder="Username"> </input>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" type="password" data-ng-model="nu_password" placeholder="Password"></input>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input class="form-control" type="email" data-ng-model="nu_email" placeholder="Email"></input>
				</div>
				<div class="form-group">
					<label>Phone Number</label>
					<input class="form-control" type="phone" data-ng-model="nu_phone" placeholder="Phone"></input>
				</div>
				<button type="submit" data-ng-click="createUser(form)" class="btn btn-success">Create User</button>
			</form>
		</div>
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
			<form role="form">
				<div class="row">
					<div class="col-xs-12">
						<h4>Create a new Group</h4>
						<p>Enter a group name to add a new group.</p>
					</div>
				</div>
				<div class="form-group">
					<label>Group Name</label>
					<input class="form-control" data-ng-model="ng_groupname" placeholder="Group Name"></input>
				</div>
				<button type="submit" data-ng-click="createGroup(form)" class="btn btn-success">Create Group</button>
			</form>
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
<div id="footer">
	<div class="container">
		<p class="muted">
			Snaphunt API Admin
		</p>
	</div>
</div>
</body>
</html>