myapp.controller('questionCtl', function($scope, $http) {
	$(".tableWin").innerHeight(0.7 * window.innerHeight);
	function getQuestion(searchInfo) {
		$http({
			method: 'POST',
			url: 'php/selectQuestion.php',
			data: searchInfo
		}).then(function successCallback(response) {
			// 请求成功执行代码
			for(var i = 0; i < response.data.length; i++) {
				if(response.data[i].state == -1) {
					response.data[i].state = "未处理";
				} else if(response.data[i].state == 0) {
					response.data[i].state = "处理中";
				} else if(response.data[i].state == 1) {
					response.data[i].state = "已处理";
				}
				if (response.data[i].remindState == 1) {
					response.data[i].remindState = "已催单"
				}else{
					response.data[i].remindState = ""
				}
			}
			$scope.questions = response.data;
			return response.data;
		}, function errorCallback(response) {
			// 请求失败执行代码
			alert("请求数据失败！");
		});
	}
	getQuestion({
		type: "0"
	});
	
	$scope.searchQuestion = function() {
		if($("#searchCompany").val() == "" && $("#searchKeynum").val() == "" && $("#searchName").val() == "" && $("#searchPhone").val() == "") {
			getQuestion({
				type: "0"
			});
		} else {
			getQuestion({
				type: "1",
				searchCompany:$("#searchCompany").val(),
				searchKeynum:$("#searchKeynum").val(),
				searchName:$("#searchName").val(),
				searchPhone:$("#searchPhone").val()
			});
		}
	}
	$scope.deal = function() {
		var index = this.$index;
		$scope.incomplete = false;
		$(".questionWrap").html($scope.questions[this.$index].question);
		$http({
			method: 'POST',
			url: 'php/dealing.php',
			data: {
				state: "0",
				id: $scope.questions[this.$index].id
			}
		}).then(function successCallback(response) {
			// 请求成功执行代码
			if(response.data == "true") {
				$scope.questions[index].state = "处理中";
				$("table")[0].rows[index+1].cells[0].children[0].disabled = "disabled";
				$("table")[0].rows[index+1].cells[0].children[1].removeAttribute("disabled");
			}

		}, function errorCallback(response) {
			// 请求失败执行代码
			alert("请求数据失败！");
		});
	}
	$scope.finish = function() {
		var index = this.$index;
		$http({
			method: 'POST',
			url: 'php/dealing.php',
			data: {
				state: "1",
				id: $scope.questions[this.$index].id
			}
		}).then(function successCallback(response) {
			// 请求成功执行代码
			if(response.data == "true") {
				$scope.questions[index].state = "已处理";
				$("table")[0].rows[index+1].cells[0].children[1].disabled = "disabled";
			}

		}, function errorCallback(response) {
			// 请求失败执行代码
			alert("请求数据失败！");
		});
	}
});