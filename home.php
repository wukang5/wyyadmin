<!DOCTYPE html>
<html lang="zh" ng-app="myapp">

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>微预约后台管理</title>
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/home.css" />
		<!--angular子页面的css-->
		<link rel="stylesheet" type="text/css" href="css/dealOrder.css" />
		<link rel="stylesheet" type="text/css" href="css/userManage.css" />
		<link rel="stylesheet" type="text/css" href="css/shopManage.css"/>
	</head>

	<body>
		<div class="wrap">
			<nav>
				<div class="container">
					<div class="project">微预约管理</div>
					<div ng-class="{active:nativeId=='#/'}" class="menu dealOrder">
						<a native href="#/">预约</a>
					</div>
					<div ng-class="{active:nativeId=='#/shopManage'}" class="menu shopManage">
						<a native href="#/shopManage">商店管理</a>
					</div>
					<div ng-class="{active:nativeId=='#/operatorManage'}" class="menu operatorManage">
						<a native href="#/operatorManage">操作员</a>
					</div>
					<div ng-class="{active:nativeId=='#/userManage'}" class="menu userManage">
						<a native href="#/userManage">用户管理</a>
					</div>
					<div ng-class="{active:nativeId=='#/ss'}" class="menu loginOut">
						<a native href="#/ss">退出</a>
					</div>
				</div>
			</nav>
			<section>
				<div class="container" ng-view=""></div>
			</section>
		</div>
	</body>
	<script src="js/jQuery v1.12.4.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/angular.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/angular-route.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/upimg.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		var myapp = angular.module("myapp", ["ngRoute"]);
		myapp.run(['$rootScope', function($rootScope) {
				$rootScope.nativeId = getCurrentNativeId();

				function getCurrentNativeId() {
					var str = "#/index";
					var href = window.location.href;
					var index = href.indexOf("#/");
					if(index != -1) {
						str = href.substring(index, href.length);
					}
					return str;
				}
			}])
			.directive('native', ['$rootScope', function($rootScope, $cookies) {
				return {
					restrict: 'A',
					link: function(scope, element, attrs) {
						$(element).click(function() {
							scope.$apply(function() {
								$rootScope.nativeId = attrs.href;
							});
						});
					}
				}
			}])
			.config(function($routeProvider) {
				$routeProvider.when('/', {
						templateUrl: 'temp/dealOrder.html'
					})
					.when('/shopManage', {
						templateUrl: 'temp/shopManage.html'
					})
					.when('/operatorManage', {
						templateUrl: 'temp/operatorManage.html'
					})
					.when('/userManage', {
						templateUrl: 'temp/userManage.html'
					})
					.otherwise({
						redirectTo: '/'
					});
			})
			.config(function($httpProvider) {
				$httpProvider.defaults.transformRequest = function(obj) {
					var str = [];
					for(var p in obj) {
						str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
					}
					return str.join("&");
				};
				$httpProvider.defaults.headers.post = {
					'Content-Type': 'application/x-www-form-urlencoded'
				}

			});
		$(".loginOut").click(function() {
			window.location.href = "index.html";
		})
	</script>
	<!--angularJs引入的js代码-->
	<script src="js/userCtl.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/operatorCtl.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/questionCtl.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/shopCtl.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jQuery v1.12.4.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/ajaxfileupload.js" type="text/javascript" charset="utf-8"></script>
</html>