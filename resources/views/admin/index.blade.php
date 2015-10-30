<!DOCTYPE html>
<html lang="en" ng-app="gfond">
    <head>
        <base href="/admin">
        <meta charset="UTF-8" />
        <title>Auth</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <style>
          .progress {
            cursor: progress;
          }
        </style>
    </head>
    <body ng-class="{progress: proccessing}">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Администраторская панель</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3">
              <ul class="nav nav-pills nav-stacked">
                <li ui-sref-active="active">
                  <a ui-sref="/">Главная страница</a>
                </li>
                <li ui-sref-active="active">
                  <a ui-sref="people">Состав наблюдательного совета</a>
                </li>
              </ul>
            </div>
            <div class="col-md-9" ui-view>
              <p style="text-align: center">Выберите раздел</p>
            </div>
          </div>
        </div>
      </div>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.15/angular-ui-router.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/restangular/1.3.1/restangular.min.js"></script>
        <script type="text/javascript">
            var app = angular.module('gfond',['ui.router', 'restangular']);
            app.config(function($stateProvider, $urlRouterProvider, $locationProvider) {
                $urlRouterProvider.otherwise("/");

                $stateProvider.state('/', {
                    url: "",
                })
                .state('people', {
                  url: "/people",
                  templateUrl: "/parts/people.html",
                  resolve: {
                    people: function(Restangular) {
                      return Restangular.all('admin/people').getList();
                    }
                  },
                  controller: 'MainCtrl'
                })

            });
            app.controller('MainCtrl', function($scope, $rootScope, people) {
              $scope.people = people;
              $scope.add = function() {
                if($rootScope.proccessing)
                  return;
                $rootScope.proccessing = true;
                var person = {first_name: $scope.first_name, last_name: $scope.last_name, descr: $scope.descr};
                people.post(person).then(function(person) {
                  $scope.people.unshift(person);
                  $scope.first_name = $scope.last_name = $scope.descr = '';
                }).finally(function() {
                  $rootScope.proccessing = false;
                  addForm.first_name.focus();
                });
              }

              $scope.delete = function(index) {
                if(!confirm('Вы уверены, что хотитет удалить этого человека?'))
                  return;
                $rootScope.proccessing = true;
                var person = people[index];
                person.remove().then(function() {
                  $scope.people.splice(index, 1);
                }).finally(function() {
                  $rootScope.proccessing = false;
                });
              }
            });
        </script>
    </body>
</html>