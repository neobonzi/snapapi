angular.module('userService', [])
	.factory('User', function($http){
		return {
			get : function() {
				return $http.get('/api/v1/users').success(function (response) {
					return response.data.data;
				});
			},
			groups : function (uid) {
				return $http.get('api/v1/users/' + uid + '/groups').success(function (response) {
					return response.data.data;
				});
			},
			invites : function(uid) {
				return $http.get('api/v1/users/' + uid + '/invites').success(function (response) {
					return response.data.data;
				});
			},
			find : function(name) {
				var qparams = { params: { 'username' : name }};
				return $http.get('api/v1/users', qparams).success(function (response) {
					return response.data.data;
				});
			},
			destroy : function (id) {
				return $http.delete('/api/v1/users' + id);
			},
			create : function (user_name, user_password, user_email, user_phone) {
				var data = { 
					'username' : user_name, 
					'email' : user_email, 
					'phone' : user_phone, 
					'password' : user_password 
				}
				console.log(data);
				return $http.post('/api/v1/users', data).success(function (response) {
					console.log(response);
					return response;
				});
			}
		}
	});