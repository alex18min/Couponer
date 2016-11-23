<div class="container">
    <div ng-show="!couponSuccessAlert" class="col-xs-12">
        <div class="panel">
            <div class="panel-body">

                <div class="col-xs-12">
                    <h1 class="text-center">OTTIENI IL TUO COUPON</h1>
                    <hr>
                </div>
                <form name="clientForm" novalidate>
                    <div class="form-group email-group col-sm-12 col-lg-6">
                        <label class="text-uppercase" for="input_coupon_email">Email *</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                            <input id="input_coupon_email" class="form-control" type="email" name="input_coupon_email"
                                   ng-model="coupon.email" required/>
                        </div>
                        <p ng-show="clientForm.input_coupon_email.$error.email" class="help-block">Formato mail non
                            corretto</p>
                    </div>
                    <div class="form-group email-group col-sm-12 col-lg-6">
                        <label class="text-uppercase" for="input_coupon_email_conferma">Conferma Email *</label>

                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                            <input id="input_coupon_email_conferma" class="form-control" type="email"
                                   name="input_coupon_email_conferma" ng-model="coupon.email_conferma"
                                   ng-pattern="coupon.cliente_email" required/>
                        </div>
                        <p ng-show="coupon.email_conferma != coupon.email" class="help-block">Le mail non
                            corrispondono</p>
                        <p ng-show="clientForm.input_coupon_email_conferma.$error.email" class="help-block">Formato
                            mail
                            non corretto</p>
                    </div>
                    <div class="col-xs-12 form-group" style="padding-left: 40px;">
                        <div class="checkbox">
                            <p>
                                <input ng-model="cliente.cliente_informativa_1" type="checkbox"> <i>*Acconsento che i
                                    miei dati personali siano utilizzati con la massima cura e riservatezza dai titolari
                                    per le finalità indicate nell' <a class="link-underlined" target="_blank"
                                                                      href="http://zenaispromo.it/gerla/policy.pdf">informativa
                                        sulla privacy</a> , che dichiaro di aver letto</i>.
                            </p>
                        </div>
                        <div class="checkbox">
                            <p>
                                <input ng-model="cliente.cliente_informativa_2" type="checkbox"> <i>Acconsento che i
                                    miei dati personali siano utilizzati dai titolari per le finalità promozionali
                                    specificate al punto 1 dell' <a class="link-underlined" target="_blank"
                                                                    href="http://zenaispromo.it/gerla/policy.pdf">informativa
                                        sulla privacy</a></i>.
                            </p>
                        </div>
                        <small>I campi contrassegnati da * sono obbligatori</small>
                    </div>

                    <div class="col-xs-12">
                        <button
                            ng-disabled="(!cliente.cliente_informativa_1) || (!coupon.email) || (!coupon.email_conferma) || (coupon.email_conferma != coupon.email) || (clientForm.input.$error)"
                            ng-click="saveCoupon()" class="btn btn-success btn-block">
                            RICHIEDI COUPON <img class="next-icon"
                                                 src="media/images/icons/right-arrow-circular-button.png"/>
                        </button>
                    </div>
                    <div class="clearfix"></div>
            </div>
            </form>
            <div ng-if="alertDouble" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-circle"
                                                                                aria-hidden="true"></i> Questo email è
                già stato inserita
            </div>
        </div>
        <div class="clearfix"></div>
    </div>


    <div ng-show="couponSuccessAlert" id="CouponSuccess">
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-body">
                    <h2 style="font-weight: 700 !important;" class="text-center">ECCO IL TUO COUPON!</h2>
                    <h3 class="text-center">{{currentCouponData.coupon_number}}</h3>
                    <hr>
                    <p class="text-center">Il coupon è stato inviato alla seguente mail:</p>
                    <h4 class="text-center">{{currentCouponData.email}}</h4>
                    <hr>
                    <h4 class="text-center">Ed ecco il tuo QR CODE</h4>
                    <div class="col-xs-12 text-center">
                        <qrcode class="qrcode" size="250" data="{{currentCouponData.coupon_number}}" download></qrcode>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
