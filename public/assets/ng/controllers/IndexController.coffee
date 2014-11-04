"use strict"

define [config.appName], (app) ->
	app.register.controller "IndexController", [
		"$scope"
		"$http"
		"$location"
		"$stateParams"
		"cfpLoadingBar"
		"$rootScope"
		"pochta"
		($scope, $http, $location, $stateParams, cfploadingBar, $rootScope, pochta) ->
			$scope.statusId = $stateParams.statusId || ''

			$scope.submit = ()->

				$rootScope.error = ''
				unless $rootScope.loading
					$rootScope.loading = true

					if $scope.statusId.match(/[A-Za-z0-9]{10,20}/gi)

						$location.path 'status/' + $scope.statusId

						pochta.get($scope.statusId)
							.success (data) ->
								$rootScope.status = data
								$rootScope.loading = false
							.error (data) ->
								$rootScope.status = ''
								$rootScope.loading = false
								$rootScope.error = 'Пчта ответила: "' + data.message + '"'

					else
						$scope.error = 'Неправильный формат трекинг номера'
						$rootScope.status = ''
						$rootScope.loading = false


			if $scope.statusId
				$scope.submit()

	]
	return
