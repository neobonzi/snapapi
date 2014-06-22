angular.module('groupService', [])
	.factory('Group', function($http){
		return {
			get : function() {
				return $http.get('/api/v1/groups/all').success(function(response) {
					return response.data.data;
				});
			},
			destroy : function(id) {
				return $http.delete('api/v1/groups/' + id);
			}
		}
	});