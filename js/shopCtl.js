myapp.controller('shopCtl', function($scope, $http) {
	$scope.goodsName = '';
	$scope.goodsType = '';
	$scope.itemInfo = '';
	$scope.introduce = '';
	$scope.price = '';
	$scope.error = false;
	$scope.incomplete = true;
	$scope.add = function() {
		var data = {
			goodsName: $scope.goodsName,
			goodsType: $scope.goodsType,
			itemInfo: $scope.itemInfo,
			introduce: $scope.introduce,
			price: $scope.price
		}
		upimg("php/shopManage.php","upImg",data);
	}

	$scope.$watch('goodsName', function() {
		$scope.test();
	});
	$scope.$watch('goodsType', function() {
		$scope.test();
	});
	$scope.$watch('itemInfo', function() {
		$scope.test();
	});
	$scope.$watch('introduce', function() {
		$scope.test();
	});
	$scope.$watch('price', function() {
		$scope.test();
	});
	$scope.test = function() {
		if(!$scope.goodsName.length || !$scope.goodsType.length || !$scope.itemInfo.length || !$scope.introduce.length) {
			$scope.incomplete = true;
		} else {
			$scope.incomplete = false;
		}
	};
});