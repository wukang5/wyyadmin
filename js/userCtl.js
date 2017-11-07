myapp.controller('userCtl', function($scope, $http) {
	function getUser() {
		$http({
			method: 'GET',
			url: 'php/selectUser.php'
		}).then(function successCallback(response) {
			// 请求成功执行代码
			$scope.users = response.data;
		}, function errorCallback(response) {
			// 请求失败执行代码
			alert("请求数据失败！");
		});
	}
	getUser();
	$scope.userName = '';
	$scope.shortName = '';
	$scope.code = '';
	$scope.adress = '';
	$scope.linkMan = '';
	$scope.linkManPhone = '';
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
			$scope.shortName = '';
			$scope.code = '';
			$scope.adress = '';
			$scope.linkMan = '';
			$scope.linkManPhone = '';
			$scope.save = function() {
				$http({
					method: 'POST',
					url: 'php/insertUser.php',
					data: {
						username: $scope.userName,
						shortname: $scope.shortName,
						usercode: $scope.code,
						adress: $scope.adress,
						linkMan: $scope.linkMan,
						linkManPhone: $scope.linkManPhone,
						userpass: $scope.passw1
					}
				}).then(function successCallback(response) {
					// 请求成功执行代码
					if(response.data == "true") {
						alert("添加成功。");
						$scope.users.push({
							company: $scope.userName,
							shortName: $scope.shortName,
							loginCode: $scope.code,
							adress: $scope.adress,
							linkman: $scope.linkMan,
							linkmanPhone: $scope.linkManPhone
						})
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
			$scope.userName = $scope.users[this.$index].company;
			$scope.shortName = $scope.users[this.$index].shortName;
			$scope.code = $scope.users[this.$index].loginCode;
			$scope.adress = $scope.users[this.$index].adress;
			$scope.linkMan = $scope.users[this.$index].linkman;
			$scope.linkManPhone = $scope.users[this.$index].linkmanPhone;
			$scope.save = function() {
				$http({
					method: 'POST',
					url: 'php/updataUser.php',
					data: {
						usercode: $scope.code,
						linkman: $scope.linkMan,
						linkmanPhone: $scope.linkManPhone,
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
					url: 'php/delUser.php',
					data: {
						usercode: $scope.code
					}
				}).then(function successCallback(response) {
					// 请求成功执行代码
					if(response.data == "true") {
						alert("删除成功。");
						$scope.users.splice(delIndex, 1);
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