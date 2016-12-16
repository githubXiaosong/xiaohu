<div class="container" ng-controller="QuestionDetailsController">


    <div class="panel panel-default">
        <div class="panel-heading" >
            <h3 class="panel-title">[: Question.question.title :]</h3>
            <br>
            <h4  class="panel-title">[: Question.question.desc :]</h4>
            <div class="clearfix">
                <span class="fr">[: Question.question.created_at :]</span>
                <span class="fr">|</span>
                <span class="fr">[: Question.question.user.username :]</span>
            </div>
        </div>


        <div class="panel-body">
                <div class="list-group">
                    <div class="list-group-item " ng-repeat="item in Question.answers">
                        <h4 class="list-group-item-heading">[: item.user.username :]</h4>

                        <span class="content-owner-desc">[: item.user.desc?item.user.desc:'他木有签名...........' :]</span>

                            {{--item.hasUp [: item.answer.hasUp :]--}}
                            {{--item.hasDown  [: item.answer.hasDown :]--}}
                        <div style="display: inline-block">
                            <button  ng-disabled="item.hasUp "   ng-click="Question.setVote(1,item.id)" class="glyphicon glyphicon-hand-up" style="color: rgb(207, 0, 0); font-size: 18px;">  [: item.timesUp :] </button>
                            <button ng-disabled="item.hasDown "  ng-click="Question.setVote(2,item.id)" class="glyphicon glyphicon-hand-down" style="color: rgb(207, 0, 0); font-size: 18px;"> [: item.timesDown :]</button>
                        </div>
                        <br>
                        <br>
                        <p class="list-group-item-text">[: item.content :]</p>

                    </div>
                </div>

        </div>
    </div>



</div>