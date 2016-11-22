<?php // echo 'ZenaisPromo16! -> '.password_hash('ZenaisPromo16!', PASSWORD_DEFAULT); ?>

<div class="container">
    <div id="LoginBox"
         class="col-xs-10 col-sm-6 col-md-6 col-lg-6 col-xs-offset-1 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 fade">
        <div class="thumbnail">
            <div class="caption">
                <h3 style="font-weight: 700 !important;" class="text-center">Area riservata</h3>
                <p class="text-center">Per poter procedere è necessario autenticarsi</p>
                <hr>
                <div class="alert alert-danger text-center" ng-show="error">I dati inseriti non sono corretti.</div>
                <form name="loginForm" novalidate>
                    <div class="form-group">
                        <label for="input_user">
                             <span class="fa-stack fa-sm">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                            </span>
                            Nome utente</label>
                        <input id="input_user" class="form-control" type="text" name="input_user" ng-model="input.user"
                               required/>
                    </div>
                    <div class="form-group">
                        <label for="input_password">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                            </span>
                            Password
                        </label>
                        <input id="input_password" class="form-control" type="password" name="input_password"
                               ng-model="input.password" required/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block" ng-show="loading"><i
                                class="fa fa-cog faa-spin animated"></i>&nbsp;&nbsp;Autenticazione in corso
                        </button>
                        <button id="ButtonLogin" ng-show="!loading" class="btn btn-success btn-block"
                                ng-disabled="!loginForm.$valid" ng-click="login()">Accedi <img class="next-icon"
                                                                                               src="media/images/icons/right-arrow-circular-button.png"/>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
