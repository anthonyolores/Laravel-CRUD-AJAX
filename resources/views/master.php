<!DOCTYPE html>
<html>
<header>
  <title>Registration Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
  <link rel="stylesheet" href="public/css/style.css" type="text/css"/>
  <script src="public/js/script.js"></script>
</header>

<body>
<div ng-app="validationApp" ng-controller="mainController">
<div class="container">
	<div class="row">
		<div class="col-md-5 reg-col">
			<h2>User Form</h2>
			<form name="registerForm" ng-submit="submitForm()" method="post" novalidate>
				<!-- FIRST NAME -->
				<div class="form-group" ng-class="{ 'has-error' : registerForm.firstname.$invalid && !registerForm.firstname.$pristine }">
					<label>First Name</label>
					<input type="text" name="firstname" class="form-control" ng-model="firstname" required>
					<p ng-show="registerForm.firstname.$invalid && !registerForm.firstname.$pristine" class="help-block">First Name must be filled.</p>
				</div>
				<!-- LAST NAME -->
				<div class="form-group" ng-class="{ 'has-error' : registerForm.lastname.$invalid && !registerForm.lastname.$pristine }">
					<label>Last Name</label>
          <input type="text" name="lastname" class="form-control" ng-model="lastname" required>
					<p ng-show="registerForm.lastname.$invalid && !registerForm.lastname.$pristine" class="help-block">Last Name must be filled.</p>
				</div>
				<!-- USERNAME -->
				<div class="form-group" ng-class="{ 'has-error' : registerForm.username.$invalid && !registerForm.username.$pristine }">
					<label>Username</label>
					<input type="text" name="username" class="form-control" ng-model="username" ng-minlength="5" ng-maxlength="20" required>
					<p ng-show="registerForm.username.$error.minlength" class="help-block">Username  must be minimum of 5 characters.</p>
					<p ng-show="registerForm.username.$error.maxlength" class="help-block">Username must be maximum of 20 characters.</p>
				</div>
				<!-- PASSWORD -->
				<div class="form-group" ng-class="{ 'has-error' : invalid_password && !registerForm.password.$pristine }">
					<label>Password</label>
					<input type="password" name = "password" class="form-control" ng-model="password" ng-change="passwordChange()" required>
					<p ng-show="!registerForm.password.$pristine" ng-class="strength" class="help-block">{{passwordStrMsg}}</p>
				</div>
				<!-- EMAIL -->
				<div class="form-group" ng-class="{ 'has-error' : !registerForm.email.$pristine && (invalid_email || registerForm.email.$invalid)}">
					<label>Email</label>
					<input type="email" name="email" class="form-control" ng-model="email" ng-change="emailChange()" required>
					<p ng-show="invalid_email" class="help-block">{{invalidEmailMsg}}</p>
				</div>
				<!-- AGE -->
				<div class="form-group" ng-class="{ 'has-error' : invalid_age && !registerForm.age.$pristine}">
				  <label>Age:</label>
					<input type="number" name ="age" class="form-control" ng-model="age" ng-change='ageChange()' required>
					<p ng-show="invalid_age" class="help-block">{{invalidAgeMsg}}</p>
				</div>
				<button type="submit" ng-disabled="invalid_age || invalid_email || registerForm.email.$invalid || invalid_password " class="btn btn-primary" ng-disabled="registerForm.$invalid">Submit</button>
			</form>
		</div>

    <div class="col-md-7 list-col">
      <div class="row">
        <div class="col-md-12">
          <table class="table">
             <thead>
              <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Age</th>
                <th>Username</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
           </thead>
           <tbody>
            <tr ng-repeat="user in users">
                <td>{{  user.id }}</td>
                <td>{{ user.firstname + " " + user.lastname}}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.age }}</td>
                <td>{{ user.username }}</td>
                <td>
                  <button class="btn btn-primary btn-xs" ng-click='editUser(user.id)'>
                    <span class="glyphicon glyphicon-edit"></span> Edit
                  </button>
                </td>
                <td>
                  <button class="btn btn-danger btn-xs" ng-click='deleteUser(user.id)'>
                    <span class="glyphicon glyphicon-trash"></span> Delete
                  </button>
              </td>
            </tr>
          </tbody>
          </table>
        </div>
      </div>
    </div>

	</div>
</div>
</div>
</body>

</html>
