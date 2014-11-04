<div class="table-div" ng-hide="loading">
    <table class="table" ng-if="status.statuses" >
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
