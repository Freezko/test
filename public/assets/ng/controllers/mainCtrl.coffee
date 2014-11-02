angular.module('mainCtrl', []).controller 'mainController', ($scope, $http, Status) ->

	$scope.loading = false
	$scope.statusId = ''


	$scope.submit = ->
		$scope.loading = true;
		$scope.error = '';

		Status.get($scope.statusId)
			.success (data) ->
				$scope.loading = false;
				$scope.status = data
			.error (data) ->
				$scope.loading = false;
				$scope.error = data.message

