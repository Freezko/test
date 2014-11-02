<!doctype html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Slow "Пчта России"</title>

	<link rel="stylesheet" type="text/css" href="/assets/library/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/cover.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css" />

</head>
<body ng-app="pochtaApp" ng-controller="mainController">
	<div class="site-wrapper">
		<div class="site-wrapper-inner" >

			<div class="masthead clearfix">
				<h1 class="cover-heading">Пчта России</h1>
			</div>

			<div class="cover-container" ng-cloak>
				<p class="lead">Сервис проверки статуса посылки</p>
				<p>
				<form ng-submit="submit()" class="form-inline" role="form">
					<input class="form-control" type="text" id="status" ng-model="statusId" placeholder="Напрмер: RA882JD823YS">
					<button type="submit" class="btn btn-primary">Проверить</button>
				</form>
				</p>
				<p class="has-error" ng-show="error">{{error}}</p>
			</div>

			<div ng-hide="loading" class="container" ng-cloak>
				<table class="table" ng-if="status.statuses">
					<tr>
						<th>#</th>
						<th>Время</th>
						<th>Статус</th>
					</tr>
					<tr ng-repeat="data in status.statuses">
						<td>{{$index+1}}</td>
						<td>{{data.timestamp * 1000  | date:'yyyy-MM-dd HH:mm:ss'}}</td>
						<td>{{data.message}}</td>
					</tr>
				</table>
			</div>

		</div>

	</div>


	<script type="text/javascript" src="/assets/library/js/jquery.min.js"></script>
	<script type="text/javascript" src="/assets/library/bootstrap/js/bootstrap.js"></script>

	<script type="text/javascript" src="/assets/library/ng/angular.min.js"></script>
	<script type="text/javascript" src="/assets/library/ng/angular-resource.min.js"></script>
	<script type="text/javascript" src="/assets/library/ng/angular-route.min.js"></script>
	<script type="text/javascript" src="/assets/library/ng/angular-ui-router.min.js"></script>

	<script type="application/javascript" src="/pipeline/assets/ng/controllers/mainCtrl.coffee"></script>
	<script type="application/javascript" src="/pipeline/assets/ng/services/pochtaService.coffee"></script>
	<script type="application/javascript" src="/pipeline/assets/ng/app.coffee"></script>


</body>
</html>
