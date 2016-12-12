<div class="signup container" ng-controller="DetailsController">
    <div class="card">
        <h1>{{ session('username') }}</h1>
    </div>


    <div class="card">
        <h4>{{ session('username') }}的提问</h4>
    </div>

    <div class="card">
        <h4>{{ session('username') }}的回答</h4>
    </div>

</div>