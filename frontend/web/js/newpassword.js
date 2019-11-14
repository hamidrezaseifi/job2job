
$(document).ready(function(){
	

	
	$("input[name='UsersBase[password_hash]']").focus();
});


brainApp.controller('NewPasswordController', function ($scope, $http, $element) {

    $scope.loadingshow = true;
    
    $("input[name='UsersBase[password_hash]']").focus();
    
    $scope.dosubmit = function(){
    	
    	res = "";
    	
		if($.trim($scope.password).length < 6 || validatePassword($scope.password) == false){
			alert( password_format_msg );
			return;
		}
		
		if($scope.password != $scope.passwordconfirm){
			alert( password_confirm_msg );
			return;
		}

		
    	$("#newpasswordform").submit();
    	
    };
    
    function validatePassword(text) {
	    return (/[A-Z]/.test(text) && /[0-9]/.test(text) && /[a-z]/.test(text) && /[@#$%&!\(\)\"\?\§\=\']/.test(text));
	};



});