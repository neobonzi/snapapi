angular.module('mainCtrl', ['flash'])
	.controller('mainController', function ($scope, $http, User, flash) {
		$scope.userPage = true;
		$scope.gamePage = false;
		$scope.groupPage = false;

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

		$scope.navTo = function (page) {
			switch (page) {
				case "users":
					$scope.userPage = true;
					$scope.gamePage = false;
					$scope.groupPage = false;
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
					break;
				case "groups":
					$scope.userPage = false;
					$scope.gamePage = false;
					$scope.groupPage = true;
					break;
				default:
			}
			$scope.userPage = page == "users";
			$scope.gamePage = page == "games";
			$scope.groupPage = page == "groups";
		}
	});