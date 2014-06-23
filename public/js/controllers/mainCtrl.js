angular.module('mainCtrl', ['flash'])
	.controller('mainController', function ($scope, $http, User, Group, flash) {
		$scope.userPage = true;
		$scope.users_allUsers = true;
		$scope.no_user_details = false;

		$scope.gamePage = false;
		$scope.groupPage = false;
		$scope.seedPage = false;

		Group.get()
			.success(function(data) {
				$scope.groups = data.data;
				$scope.loading = false;
			});

		User.get()
			.success(function(data) {
				$scope.users = data.data;
				$scope.loading = false;
			});

		$scope.deleteUser = function(id) {
			User.destroy(id)
				.success(function(data) {
					flash(data.success.message);
					User.get()
						.success(function(data) {
							$scope.users = data.data;
							$scope.loading = false;
					});
				});
		};

		$scope.lookupUser = function(form) {
			User.find($scope.nu_search)
				.success(function (data) {
					console.log($scope.vu);
					$scope.nu_user_details = true;
					$scope.vu = data.data;
					User.groups($scope.vu.id)
						.success(function (data) {
							console.log(data);
							$scope.vu.groups = data.data;
						});
				});
		}

		$scope.addUserToGroup = function(form) {
			$http.put('/api/v1/users/' + $scope.mg_users + '/groups/' + $scope.mg_groups)
				.success(function(data) {
					flash(data.success.message);
				});
		}

		$scope.createUser = function (form) {
			User.create($scope.nu_username, $scope.nu_password, $scope.nu_email, $scope.nu_phone)
				.success(function (data) {
					flash(data.message);
				})
				.error(function (data) {
					flash(data.error.message);
				});
		}

		$scope.createGroup = function (form) {
			Group.create($scope.ng_groupname)
				.success(function (data) {
					flash("Group " + $scope.ng_groupname + " successfully created!");
				})
				.error(function (data) {
					flash(data.error.message);
				});
		}

		$scope.deleteGroup = function(id) {
			Group.destroy(id)
				.success(function (data) {
					flash(data.success.message);
					Group.get()
						.success(function(data) {
							$scope.groups = data.data;
							$scope.loading = false;
					});
				});
		};

		$scope.usersNavTo = function(page) {
			switch (page) {
				case "all":
					User.get()
						.success(function(data) {
							$scope.users = data.data;
							$scope.loading = false;
						});			
					$scope.users_allUsers = true;
					$scope.users_viewUser = false;
					$scope.users_newUser = false;
					break;
				case "view":
					$scope.users_allUsers = false;
					$scope.users_viewUser = true;
					$scope.users_newUser = false;
					break;
				case "new":
					$scope.users_allUsers = false;
					$scope.users_viewUser = false;
					$scope.users_newUser = true;
					break;
			}
		}

		$scope.groupsNavTo = function(page) {
			switch (page) {
				case "all":
					Group.get()
						.success(function(data){
							$scope.groups = data.data;
						});
					$scope.groups_allGroups = true;
					$scope.groups_newGroup = false;
					$scope.groups_manageGroups = false;
					break;
				case "new":
					$scope.groups_allGroups = false;
					$scope.groups_newGroup = true;
					$scope.groups_manageGroups = false;
					break;
				case "manage":
					$scope.groups_allGroups = false;
					$scope.groups_newGroup = false;
					$scope.groups_manageGroups = true;
					Group.get()
						.success(function(data){
							$scope.groups = data.data;
						});
					User.get()
						.success(function(data){
							$scope.users = data.data;
						});
					break;
			}
		}

		$scope.navTo = function (page) {
			switch (page) {
				case "users":
					$scope.userPage = true;
					$scope.users_allUsers = true;
					$scope.gamePage = false;
					$scope.groupPage = false;
					$scope.seedPage = false;
					$scope.loading = true;
					User.get()
						.success(function(data) {
							console.log(JSON.stringify(data.data));
							$scope.users = data.data;
							$scope.loading = false;
						});
					break;
				case "games":
					$scope.userPage = false;
					$scope.gamePage = true;
					$scope.groupPage = false;
					$scope.seedPage = false;
					break;
				case "groups":
					$scope.userPage = false;
					$scope.gamePage = false;
					$scope.groupPage = true;
					$scope.groups_allGroups = true;
					$scope.seedPage = false;
					Group.get()
						.success(function(data) {
							console.log(JSON.stringify(data.data));
							$scope.users = data.data;
							$scope.loading = false;
						});
					break;
				case "seeds":
					$scope.userPage = false;
					$scope.gamePage = false;
					$scope.groupPage = false;
					$scope.seedPage = true;
					break;
				default:
			}
			$scope.userPage = page == "users";
			$scope.gamePage = page == "games";
			$scope.groupPage = page == "groups";
		}
	});