'use strict';

define [], ->
	services = angular.module('pochtaServices', [])

	#Must be a provider since it will be injected into module.config()
	services.factory 'pochta', ($http)->
		get: (id)->
			return $http.get('/statuses/' + id + '.json');
