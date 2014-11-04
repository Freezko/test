"use strict"

define [config.appName], (app) ->
	app.register.controller "StatusInfoController", [
		"$scope"
		"$http"
		"$location"
		"$stateParams"
		"cfpLoadingBar"
		"$rootScope"
		"pochta"
		($scope, $http, $location, $stateParams, cfploadingBar,$rootScope, pochta) ->
			return
	]
	return
