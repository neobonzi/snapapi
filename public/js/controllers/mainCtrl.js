angular.module('mainCtrl', ['flash'])
	.controller('mainController', function ($scope, $http, User, Group, flash) {
		$scope.userPage = true;
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

		$scope.deleteGroup = function(id) {
			Group.destroy(id)
				.success(function(data) {
					flash(data.success.message);
					Group.get()
						.success(function(data) {
							$scope.groups = data.data;
							$scope.loading = false;
					});
				});
		};
		$scope.navTo = function (page) {
			switch (page) {
				case "users":
					$scope.userPage = true;
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