angular.module('userService', [])
	.factory('User', function($http){
		return {
			get : function() {
				return $http.get('/api/v1/users/all').success(function(response) {
					return response.data.data;
				});
			},
			destroy : function(id) {
				return $http.delete('api/v1/users/' + id);
			}
		}
	});