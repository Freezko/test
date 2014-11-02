service = angular.module('pochtaService', [])

service.factory 'Status', ($http) ->
	return {
		get: (id)->
			return $http.get('/api/status/' + id)
	}