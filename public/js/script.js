//angular app
var validationApp = angular.module('validationApp', []);

//angular controller
validationApp.controller('mainController', function($scope, $http, $location) {

  $scope.isEdit = 0;
  $scope.editId = -1;

  $http.get($location.absUrl() + "/all")
    .then(function(response){ $scope.users = response.data; });

  $scope.invalid_password = true;
  $scope.invalid_email = true;
  $scope.invalid_age = true;


  //check email exists
  $scope.emailChange = function() {
    var values = ["email1@yahoo.com" , "email2@yahoo.com" ];
    $scope.invalid_email = false;
    angular.forEach(values, function(value, key){
       if(value == $scope.email)
       {
        $scope.invalid_email = true;
        $scope.invalidEmailMsg = "Email Already Exists!";
       }
    });
  };

  //validate password
   $scope.passwordChange = function() {
    var password = $scope.password;
    $scope.invalid_password = false;

    if(password == null || password.length == 0)
    {

      $scope.passwordStrMsg = "";
    }
    else if (/[a-zA-Z0-9]{8,}/.test(password)) {//should contain at least 8 from the mentioned characters

      if (this.password.length < 10)
      {
        $scope.strength = 'medium';
        $scope.passwordStrMsg = "Medium Password";
      }
      else
      {
        $scope.strength = 'strong';
        $scope.passwordStrMsg = "Strong Password";
      }
    }
    else
    {
      $scope.strength = 'weak';
      $scope.invalid_password = true;
      $scope.passwordStrMsg = "Password should contain at least 8 letters or digits";
    }
  };

  //validate age
   $scope.ageChange = function() {
    var age = parseInt($scope.age);
    if( age < 18)
    {
      $scope.invalid_age = true;
      $scope.invalidAgeMsg = "No minors allowed";
    }
    else if(age > 60)
    {
      $scope.invalid_age = true;
      $scope.invalidAgeMsg = "No senior citizen allowed";
    }
    else
    {
      $scope.invalid_age = false;
    }
  };

  $scope.editUser = function(id)
  {
    var index = findUserIndex(id);
    var userArr = eval( $scope.users );
    var user = userArr[index];
    $scope.firstname = user.firstname;
    $scope.lastname = user.lastname;
    $scope.username = user.username;
    $scope.password = user.password;
    $scope.email = user.email;
    $scope.age = user.age;
    $scope.isEdit = 1;
    $scope.editId = user.id;
    $scope.registerForm.$valid = true;
    $scope.invalid_password = false;
    $scope.invalid_email = false;
    $scope.invalid_age = false;
  }

   $scope.deleteUser = function(id)
   {
     if(confirm("Are you sure you want to delte user?"))
     {
       $http({
           method: 'POST',
           url: $location.absUrl() + 'deleteItem',
           dataType:"json",
           data: {
                  'id': id
           }
       }).success(function(response) {
       		$scope.users.splice( findUserIndex(id), 1 );
       }).error(function(response) {
        //   console.log(response);
           alert('cannot delete user!');
       });
     }
   }

   //find index
   function findUserIndex(id)
   {
     var index = -1;
      var userArr = eval( $scope.users );
      for( var i = 0; i < userArr.length; i++ ) {
        if( userArr[i].id === id ) {
          index = i;
          break;
        }
      }

      if( index === -1 ) {
        alert("User not Found!");
      }
      else {
        return index;
      }
   }

  //check all fields are valid
  $scope.submitForm = function() {

  // check to make sure the form is completely valid
    if ($scope.registerForm.$valid) {

      if($scope.invalid_age &&
        $scope.invalid_password &&
        $scope.invalid_email)
        {
          alert('form is not ready');
        }
        else
        {

          var urlAction = $scope.isEdit == 1? "updateItem" : "addItem";

          $http({
              method: 'POST',
              url: $location.absUrl() + urlAction,
              dataType:"json",
              data: {
                     'id' : $scope.editId,
                     'firstname': $('input[name=firstname]').val(),
                     'lastname': $('input[name=lastname]').val(),
                     'age': $('input[name=age]').val(),
                     'username': $('input[name=username]').val(),
                     'password': $('input[name=password]').val(),
                     'email': $('input[name=email]').val()
              }
          }).success(function(response) {
           var newUser = response;

           if($scope.isEdit)
           {
             var index = findUserIndex($scope.editId);
             $scope.users[index] = newUser;
           }
           else
           {
             $scope.users.push(newUser);
           }
          }).error(function(response) {
              alert('This is embarassing. An error has occured. Please check the log for details');
          });

        }

    }
    else
    {
      alert('form is not ready' );
    }

  };

});
