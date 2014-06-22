angular.module('groupService', [])
	.factory('Group', function($http){
		return {
			get : function() {
				return $http.get('/api/v1/groups').success(function(response) {
					return response.data.data;
				});
			},
			create : function(groupName) {
				var data = { 'name' : groupName };
				console.log(data);
				return $http.post('/api/v1/groups', data).success(function(response) {
					console.log(response.data);
					return response.data.data;
				})
			},
			destroy : function(id) {
				return $http.delete('api/v1/groups/' + id);
			}
		}
	});