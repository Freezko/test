<p class="lead">Сервис проверки статуса посылки</p>

<form ng-submit="submit()" class="form-inline" role="form">
    <input class="form-control" type="text" id="status" ng-model="statusId" placeholder="Напрмер: RA882JD823YS">
    <button type="submit" class="btn btn-primary">Проверить</button>
</form>

<p class="has-error" ng-show="error">{{error}}</p>
