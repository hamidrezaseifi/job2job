<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerCssFile("@web/web/css/register.css", [], 'css-register');
$this->registerJsFile("@web/web/js/register.js", [], 'js-register');

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register" ng-controller="RegisterController">

        <div class="top-text-form">
			<div class="buttons-form-select">
				<div class="register-selectform form1-regis cont_2" ng-class="{'active' : !active_register}" ng-click="active_register=false;">BEREITS REGISTRIERT</div>
				<div class="register-selectform cont_1" ng-class="{'active' : active_register}" ng-click="active_register=true;">REGISTRIEREN</div>
			</div>

			<p class="content1" ng-show="active_register">Erstellen Sie sich Ihr Benutzerkonto und sichern Sie sich alle Vorteile einer <br>Zusammenarbeit.</p>
        	<p class="content2" ng-show="!active_register">Konto bereits vorhanden?<br><br>Melden Sie sich mit Ihrem Benutzerprofil an und erhalten Sie die aktuellsten Informationen zu Ihrem Traumberuf!</p>

            <div class="form1-registration"  ng-show="!active_register">
            	<?php

            ActiveForm::begin(
                [
                    'id' => 'loginform',
                    'action' => Yii::getAlias('@web') . '/site/login',
                    'options' => [
                        // 'target' => '_blank',
                        'method' => 'POST'
                    ]
                ])?>


        			<div class="response-errors">
        				<div class="errormsglog">Die Mail und/oder das Passwort sind falsch. Bitte erneut probieren!</div>
        				<div class="donemsglog">Login erfolgreich!</div>
        				<div class="errorpasswordlog">Passwort falsch!</div>
        			</div>

        			<div class="inputform">
        				<label>E-Mail:</label>
        				<input id="emailaddresslog" type="text" name="LoginForm[username]" ng-model="LoginData.LoginForm.username">
        			</div>

        			<div class="inputform">
        				<label>Passwort:</label>
        				<input id="pass1log" type="password" name="LoginForm[password]" class="requiredfieldlog" ng-model="LoginData.LoginForm.password">
        			</div>

        			<a class="recover-pass" href="<?php echo Yii::getAlias('@web');?>/site/resetpassword">Passwort vergessen?</a>

        			<div class="button-form-login-ajax" ng-click="doLogin()">ANMELDEN</div>
            	<?php

            ActiveForm::end()?>
            </div>


            <?php

            ActiveForm::begin(
                [
                    'id' => 'register-form',
                    'action' => Yii::getAlias('@web') . '/site/register',
                    'options' => [
                        'ng-show' => 'active_register',
                        'class' => 'form2-registration',
                        'method' => 'POST'
                    ]
                ])?>

       			<div class="register-type-container">
           			<div class="register-type">
    					<div class="register-type-item" ng-class="{'active' : registerData.regtype == 1}" ng-click="registerData.regtype = 1;">Bewerber</div>
    					<div class="register-type-item" ng-class="{'active' : registerData.regtype == 2}" ng-click="registerData.regtype = 2;">Unternehmer</div>
    					<input type="hidden" id="register-regtype" name="data[regtype]" />
        			</div>
    			</div>

                <div class="inputs-form">

                	<div class="register-column-inputs">
                		<div class="inputform">
                			<label>*Anrede:</label>
                			<div class="mr-mrs">
            					<div class="gender" ng-class="{'active' : registerData.gender == 'f'}" ng-click="registerData.gender = 'f';">Frau</div>
            					<div class="gender" ng-class="{'active' : registerData.gender == 'm'}" ng-click="registerData.gender = 'm';">Herr</div>
            					<input type="hidden" name="data[gender]" id="register-gender" />
                			</div>
                		</div>

                		<div class="inputform">
                			<label>*Vorname:</label>
                			<input id="vorname" type="text" name="data[fname]" class="requiredfield" ng-class="{'invalid-data' : !registerDataValidation.fname}" ng-model="registerData.fname">
                		</div>

                		<div class="inputform">
                			<label>*Nachname:</label>
                			<input id="nachname" type="text" name="data[lname]" class="requiredfield" ng-class="{'invalid-data' : !registerDataValidation.lname}" ng-model="registerData.lname">
                		</div>
                	</div>

                	<div class="register-column-inputs">
                		<div class="inputform">
                			<label>*E-Mail:</label>
                			<input id="emailaddressreg" type="email" name="data[email]" ng-class="{'invalid-data' : !registerDataValidation.email}" ng-model="registerData.email">
                		</div>

                		<div class="inputform">
                			<label>*Passwort:</label>
                			<input id="pass1reg" type="password" name="data[password]" ng-class="{'invalid-data' : !registerDataValidation.password}" class="requiredpassword" ng-model="registerData.password">
                		</div>

                		<div class="inputform">
                			<label>*Passwort bestätigen:</label>
                			<input id="pass2" type="password" ng-class="{'invalid-data' : !registerDataValidation.password2}" class="requiredpassword" ng-model="registerData.password2">
                		</div>
                	</div>

                	<div class="register-column-inputs">
                		<div class="inputform">
                			<label>Telefon:</label>
                			<input id="telefon" type="text" name="data[tel]" name="telefon" ng-class="{'invalid-data' : !registerDataValidation.tel}" ng-model="registerData.tel">
                		</div>

                		<div class="inputform">
                			<label>Straße und Hausnummer:</label>
                			<input id="street" style="width:69%; float:left;" type="text" name="data[street]"  ng-class="{'invalid-data' : !registerDataValidation.street}" ng-model="registerData.street">
                			<input id="homenumber" style="width:30%; float:right;" type="text" name="data[homenumber]" ng-class="{'invalid-data' : !registerDataValidation.homenumber}" ng-model="registerData.homenumber">
                			<div class="clear"></div>
                		</div>

                		<div class="inputform">
                			<label>PLZ und Ort:</label>
                			<input id="city" type="text" style="width:30%; float:left;" name="data[postcode]" ng-class="{'invalid-data' : !registerDataValidation.postcode}" ng-model="registerData.postcode">
                			<input id="plz" type="text" style="width:69%; float:right;" name="data[city]" ng-class="{'invalid-data' : !registerDataValidation.city}" ng-model="registerData.city">
                			<div class="clear"></div>
                		</div>
                	</div>
            	</div>
                <div class="customfields-registration">

                	<div class="extrafields-registration div-select-jobsuche" >
                		<div class="inputform registerasstellungart" ng-show="registerData.regtype == 1">
                			<label>Anstellungart *:</label>
            				<md-select ng-model="registerData.workModel" ng-class="{'invalid-data' : !registerDataValidation.workModel}" class="custom-select" selectdiv="registerbranche" name="data[jobtype]" placeholder="wählen Sie einen Anstellungart">
            					<?php

                foreach ($workModels as $workModel) {
                    ?>
            					<md-option ng-value="<?=$workModel->id?>"><?=$workModel->title?></md-option>
            					<?php
                }
                ?>
            				</<md-select>

                		</div>
                    	<div class="inputform registerbranche" ng-show="registerData.regtype == 1">
                    		<label>Branche *:</label>
            				<md-select ng-model="registerData.branch" ng-class="{'invalid-data' : !registerDataValidation.branch}" class="custom-select" selectdiv="registerbranche" name="data[branch]" placeholder="wählen Sie ein Branch">
            					<md-option ng-repeat="branch in branchs" ng-value="branch.id">{{branch.label}}</md-option>
            				</<md-select>
                    	</div>
                    	<div class="inputform registerbranche" ng-show="registerData.regtype == 2">
                    		<label>Firmenname *:</label>
            				<input type="text" name="data[companyname]" ng-class="{'invalid-data' : !registerDataValidation.companyname}" ng-model="registerData.companyname">
                    	</div>
                	</div>
                	<div class="accept-check-container">
            			<div class="contact-policy">
            				<md-checkbox ng-model="registerData.accept" aria-label="Checkbox" class="accept-checkbox">
            				<label for="registrieren-radio1" class="contactcontainer">
            				Ich bin damit einverstanden, dass meine persönlichen Daten von Job2Job heute und in Zukunft gespeichert, bearbeitet und für Vermittlungszwecke an Dritte übermittelt werden dürfen. Ich habe die Datenschutzerklärung gelesen und stimme dieser zu. Ich bin damit einverstanden, dass Job2Job mich zum Zweck der Vermittlung in ein Projekt/eine Festanstellung kontaktieren darf.*

            				</label>
            				</md-checkbox>
            			</div>
                	</div>
            	</div>

            	<div class="button-form" ng-class="{'not-accept-button' : !registerData.accept}" id="create_profile" ng-click="doRegister()">PROFIL  ERSTELLEN</div>
            <?php

            ActiveForm::end()?>
		</div>


</div>
<script type="text/javascript">
var loginUrl = "<?=Yii::getAlias('@web') . '/site/login'?>";
var registerUrl = "<?=Yii::getAlias('@web') .'/site/register'?>";
var emailcheckUrl = "<?=Yii::getAlias('@web') .'/site/emailcheck?email='?>";
var emailMessage = "<?=$emailMessage?>";
var passwordMessage = "<?=$passwordMessage?>";
var password2Message = "<?=$password2Message?>";
var acceptMessage = "<?=$acceptMessage?>";
var fnameMessage = "<?=$fnameMessage?>";
var lnameMessage = "<?=$lnameMessage?>";
var emptypeMessage = "<?=$emptypeMessage?>";
var branchMessage = "<?=$branchMessage?>";
var emailExistsMessage = "<?=$emailExistsMessage?>";
var companynameMessage = "<?=$companynameMessage?>";
</script>
