"use strict"

define [config.appName], (app) ->
	app.register.controller "StatusController", [
		"$scope"
		"$http"
		"$stateParams"
		($scope, $http, $stateParams) ->
			$scope.title = "Document " + "#{$stateParams.id}"
	]
	return
