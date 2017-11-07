myapp.controller('operatorCtl', function($scope, $http) {
	function getOperator() {
		$http({
			method: 'GET',
			url: 'php/selectOperator.php'
		}).then(function successCallback(response) {
			// 请求成功执行代码
			for(var i = 0; i < response.data.length; i++) {
				if(response.data[i].isadmin == 1) {
					response.data[i].isadmin = "管理员";
				} else {
					response.data[i].isadmin = "操作员";
				}
			}
			$scope.users = response.data;
		}, function errorCallback(response) {
			// 请求失败执行代码
			alert("请求数据失败！");
		});
	}
	getOperator();
	$scope.userName = '';
	$scope.code = '';
	$scope.isadmin = '';
	$scope.passw1 = '';
	$scope.passw2 = '';
	$scope.edit = true;
	$scope.error = false;
	$scope.incomplete = false;

	$scope.editUser = function(id) {
		var delIndex;
		if(id == 'new') {
			$scope.edit = true;
			$scope.incomplete = true;
			$scope.userName = '';
			$scope.code = '';
			$scope.isadmin = '';
			$scope.save = function() {
				$http({
					method: 'POST',
					url: 'php/insertOperator.php',
					data: {
						username: $scope.userName,
						usercode: $scope.code,
						isadmin: $scope.isadmin,
						userpass: $scope.passw1
					}
				}).then(function successCallback(response) {
					// 请求成功执行代码
					if(response.data == "true") {
						alert("添加成功。");
						if ($scope.isadmin==1) {
							$scope.users.push({userName:$scope.userName,code:$scope.code,isadmin:"管理员"})
						} else{
							$scope.users.push({userName:$scope.userName,code:$scope.code,isadmin:"操作员"})
						}
					} else {
						alert("添加失败。");
					}
				}, function errorCallback(response) {
					// 请求失败执行代码
					alert("请求数据失败！");
				});
			}
		} else {
			$scope.edit = false;
			delIndex = this.$index;
			$scope.userName = $scope.users[this.$index].userName;
			$scope.code = $scope.users[this.$index].code;
			$scope.isadmin = $scope.users[this.$index].isadmin;
			$scope.save = function() {
				$http({
					method: 'POST',
					url: 'php/updataOperator.php',
					data: {
						usercode: $scope.code,
						userpass: $scope.passw1
					}
				}).then(function successCallback(response) {
					// 请求成功执行代码
					if(response.data == "true") {
						alert("修改成功。");
					} else {
						alert("修改失败。");
					}

				}, function errorCallback(response) {
					// 请求失败执行代码
					alert("请求数据失败！");
				});
			}
			$scope.del = function() {
				$http({
					method: 'POST',
					url: 'php/delOperator.php',
					data: {
						usercode: $scope.code
					}
				}).then(function successCallback(response) {
					// 请求成功执行代码
					if(response.data == "true") {
						alert("删除成功。");
						$scope.users.splice(delIndex,1);
					} else {
						alert("删除失败。");
					}
				}, function errorCallback(response) {
					// 请求失败执行代码
					alert("请求数据失败！");
				});
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
	$scope.$watch('isadmin', function() {
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