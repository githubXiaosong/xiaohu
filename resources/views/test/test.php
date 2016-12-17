<!doctype html>
<html lang="zh" ng-app="test" >
<head>
    <meta charset="UTF-8">
    <title>Test for directive</title>

<!--    {{--默认是从public目录开始的  /就是跟目录的--}}-->
    <link rel="stylesheet" href="/laravel/xiaohu/public/lib/normalize/normalize.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="/laravel/xiaohu/public/lib/jquery/jquery.js"></script>
    <script src="/laravel/xiaohu/public/lib/angular/angular.min.js"> </script>
    <script src="/laravel/xiaohu/public/test/directive.js"></script>

</head>
<body>

<div ng-controller="testController" >
    <div hello howToLoad="loadData()">

    </div>
</div>

<div ng-controller="test2Controller">
    <div hello howToLoad="loadData2()">

    </div>
</div>

<hr>

<div>
    <superman strength>力量</superman>
</div>
<div>
    <superman strength speed>力量 敏捷</superman>
</div>
<div>
    <superman strength speed light>力量 敏捷 发光</superman>
</div>

<hr>

<inputtest></inputtest>
<inputtest></inputtest>
<inputtest></inputtest>
<inputtest></inputtest>

<hr>

<div ng-controller="ctrl1">
    <drink flaveor="{{ flaveor }}"></drink>

    <input type="text" ng-model="flaveor">

    <drink1 flaveor=" flaveor "></drink1>
</div>

<div ng-controller="ctrl2">
    <greeting greet="sayHello(name)"></greeting>
</div>

</body>



</html>