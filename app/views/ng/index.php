 <div class="trackForm">
    <h1>Сервис проверки статуса посылки</h1>
    <p class="lead">Наш сервис позволяет проверить актуальный статус посылки <br> "Пчты России"</p>

    <form ng-submit="submit()" class="form-inline" role="form">
        <input class="form-control" ng-change="error=''" type="text" id="status" ng-model="statusId" value="{{statusId}}" placeholder="Напрмер: RA882JD823YS">
        <button type="submit" class="btn btn-primary">Проверить</button>
    </form>

    <p class="has-error" ng-class="{'fadeInUp animated': error}" ng-show="error">{{error}}</p>
</div>
