myapp.controller('userCtl', function($scope, $http) {
	$scope.userName = '';
			$scope.code = '';
			$scope.passw1 = '';
			$scope.passw2 = '';
			$scope.users = [{
					id: 1,
					userName: 'Hege',
					code: "Pege"
				},
				{
					id: 2,
					userName: 'Kim',
					code: "Pim"
				},
				{
					id: 3,
					userName: 'Sal',
					code: "Smith"
				},
				{
					id: 4,
					userName: 'Jack',
					code: "Jones"
				},
				{
					id: 5,
					userName: 'John',
					code: "Doe"
				},
				{
					id: 6,
					userName: 'Peter',
					code: "Pan"
				}
			];
			$scope.edit = true;
			$scope.error = false;
			$scope.incomplete = false;

			$scope.editUser = function(id) {
				if(id == 'new') {
					$scope.edit = true;
					$scope.incomplete = true;
					$scope.userName = '';
					$scope.code = '';
					
				} else {
					$scope.edit = false;
					$scope.userName = $scope.users[this.$index].userName;
					$scope.code = $scope.users[this.$index].code;
					$scope.save = function () {
						console.log("修改");
					}
				}
			};

			$scope.$watch('passw1', function() {
				$scope.test();
			});
			$scope.$watch('passw2', function() {
				$scope.test();
			});
			$scope.$watch('userName', function() {
				$scope.test();
			});
			$scope.$watch('code', function() {
				$scope.test();
			});

			$scope.test = function() {
				if($scope.passw1 !== $scope.passw2) {
					$scope.error = true;
				} else {
					$scope.error = false;
				}
				$scope.incomplete = false;
				if($scope.edit && (!$scope.userName.length ||
						!$scope.code.length ||
						!$scope.passw1.length || !$scope.passw2.length)) {
					$scope.incomplete = true;
				}
			};
});