<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="/admin">
        <meta charset="UTF-8" />
        <title>Главная страница</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>
    <body>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Главная страница</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-5">
                        @foreach($people as $person)
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h3 class="panel-title">{{$person->first_name}} {{$person->first_lastname}}</h3>
                          </div>
                          <div class="panel-body">
                            {{$person->descr}}
                          </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>