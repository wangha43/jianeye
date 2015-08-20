<?php
//   $bbs = <<<phpapache
$linkheader = <<<phpapache
	<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="../assets/css/family=Arimo400,700,400italic.css">
<link rel="stylesheet" href="../assets/css/fonts/linecons/css/linecons.css">
<link rel="stylesheet" href="../assets/css/fonts/fontawesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/bootstrap.css">
<link rel="stylesheet" href="../assets/css/xenon-core.css">
<link rel="stylesheet" href="../assets/css/xenon-forms.css">
<link rel="stylesheet" href="../assets/css/xenon-components.css">
<link rel="stylesheet" href="../assets/css/xenon-skins.css">
<link rel="stylesheet" href="../assets/css/custom.css">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet"  />
<link href="../css/page.css" rel="stylesheet" />
<link rel="stylesheet" href="../assets/css/bootstrap-switch.min.css">
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/highcharts.js"></script>
<script type="text/javascript" src="../js/addbody.js"></script>
<script type="text/javascript" src="../js/modules/exporting.js"></script>
<script type="text/javascript" src="../js/resize.js"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
phpapache;

$nav =
<<<EOF
<div class="sidebar-menu toggle-others fixed">
	<!-- set fixed position by adding class "navbar-fixed-top" -->
	<div class="sidebar-menu-inner">
		<!-- Navbar Brand -->
		<!-- <div class="navbar-brand">
		<a href="dashboard-1.html" class="logo">
			<img src="assets/images/logo-white-bg@2x.png" width="80" alt="" class="hidden-xs" />
			<img src="assets/images/logo@2x.png" width="80" alt="" class="visible-xs" />
			-->
			<!-- 	</a>
			<a href="#" data-toggle="settings-pane" data-animate="true"> <i class="linecons-cog"></i>
			</a>
		</div>
		-->
		<header class="logo-env">
			<!-- logo -->
			<div class="logo">
				<span style="color:#fff"><strong>戬智眼安防科技</strong></span>
				<div class="mobile-menu-toggle visible-xs">
					<a href="#" data-toggle="user-info-menu"> <i class="fa-bell-o"></i>
						<span class="badge badge-success"></span>
					</a>
					<a href="#" data-toggle="mobile-menu">
						<i class="fa-bars"></i>
					</a>
				</div>
			</div>
			<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
			<!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
		</header>
		<!-- Mobile Toggles Links -->
		<!-- main menu -->
		<ul  class="main-menu">
			<li>
				<a>
					<apan>GPS监控</apan>
				</a>
			</li>
			<li class="">
				<a>
					<span class="title">主动安全管理</span>
				</a>
				<ul>
					<li class="">
						<a href="../driver/driver_list.php" >
							<span class="title">驾驶员管理</span>
						</a>
					</li>
					<li>
						<a href="../car/car_list.php"   >
							<span class="title">车辆管理</span>
						</a>
					</li>
					<li class="">
						<a  href="../road/road_list.php"  >
							<span class="title">路况分析</span>
						</a>
					</li>
					<li class="">
						<a href="../big_data_analysis/all.php">
							<span class="title">大数据分析</span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a>
					<apan>企业运营管理</apan>
				</a>
			</li>
			<li>
				<a>
					<apan>UBI保险</apan>
				</a>
			</li>
			<li>
				<a>
					<apan>车货配件平台</apan>
				</a>
			</li>
			<li>
				<a>
					<apan>车辆技术监控</apan>
				</a>
			</li>
			<li>
				<a>
					<apan>客户服务</apan>
				</a>
			</li>
		</ul>

	</div>

</div>
EOF;

$bottomsc =
<<<EOF
	<!-- Bottom Scripts -->
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/highlight.js"></script>
	<script src="../assets/js/bootstrap-switch.js"></script>
	<script src="../assets/js/switch-main.js"></script>
	<script src="../assets/js/TweenMax.min.js"></script>
	<script src="../assets/js/resizeable.js"></script>
	<script src="../assets/js/joinable.js"></script>
	<script src="../assets/js/xenon-api.js"></script>
	<script src="../assets/js/xenon-toggles.js"></script>

	<!--  Imported scripts on this page  -->
	<script src="../assets/js/xenon-widgets.js"></script>
	<script src="../assets/js/devexpress-web-14.1/js/globalize.min.js"></script>
	<script src="../assets/js/devexpress-web-14.1/js/dx.chartjs.js"></script>
	<script src="../assets/js/toastr/toastr.min.js"></script>

	<!-- JavaScripts initializations and stuff -->
	<script src="../assets/js/xenon-custom.js"></script>
	<!--bootstrap -->
	<script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="../assets/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
	<!-- loading bar-->
	<script src="../js/prepare.js"></script>
EOF;
$navr =
<<<EOF
	       <nav class="navbar user-info-navbar" role="navigation">

		<!-- Left links for user info navbar -->
		<ul class="user-info-menu left-links list-inline list-unstyled">

			<li class="hidden-sm hidden-xs" style="min-height: 76px;">
				<a href="#" data-toggle="sidebar">
					<i class="fa-bars"></i>
				</a>
			</li>

			<li class="dropdown hover-line" style="min-height: 76px;">
				<a href="#" data-toggle="dropdown">
					<i class="fa-envelope-o"></i>
					<span class="badge badge-green">2</span>
				</a>

				<ul class="dropdown-menu messages">
					<li>

						<ul class="dropdown-menu-list list-unstyled ps-scrollbar ps-container">

							<li class="active">
								<!-- "active" class means message is unread -->
								<a href="#">
									<span class="line"> <strong>小王</strong>
										<span class="light small">- 昨天</span>
									</span>

									<span class="line desc small">你好</span>
								</a>
							</li>

							<li class="active">
								<a href="#">
									<span class="line"> <strong>小李</strong>
										<span class="light small">- 2 天前</span>
									</span>

									<span class="line desc small">晚上出去不</span>
								</a>
							</li>

							<!-- Repeated -->

							<div class="ps-scrollbar-x-rail" style="display: block; width: 0px; left: 0px; bottom: 3px;">
								<div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
							</div>
							<div class="ps-scrollbar-y-rail" style="display: block; top: 0px; height: 0px; right: 2px;">
								<div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div>
							</div>
						</ul>

					</li>

					<li class="external">
						<a href="blank-sidebar.html">
							<span>所有消息</span>
							<i class="fa-link-ext"></i>
						</a>
					</li>
				</ul>
			</li>

			<li class="dropdown hover-line" style="min-height: 76px;">
				<a href="#" data-toggle="dropdown">
					<i class="fa-bell-o"></i>
					<span class="badge badge-purple">3</span>
				</a>

				<ul class="dropdown-menu notifications">
					<li class="top">
						<p class="small">
							<a href="#" class="pull-right">标记所有已读</a>
							你有
							<strong>3</strong>
							条新通告
						</p>
					</li>

					<li>
						<ul class="dropdown-menu-list list-unstyled ps-scrollbar ps-container">
							<li class="active notification-success">
								<a href="#">
									<i class="fa-user"></i>

									<span class="line">
										<strong>新用户注册</strong>
									</span>

									<span class="line small time">30 分钟前</span>
								</a>
							</li>

							<li class="active notification-secondary">
								<a href="#">
									<i class="fa-lock"></i>

									<span class="line">
										<strong>私人设置已改变</strong>
									</span>

									<span class="line small time">3 小时前</span>
								</a>
							</li>

							<li class="notification-danger">
								<a href="#">
									<i class="fa-calendar"></i>

									<span class="line">李四呼叫</span>

									<span class="line small time">9 小时前</span>
								</a>
							</li>

							<div class="ps-scrollbar-x-rail" style="display: block; width: 0px; left: 0px; bottom: 3px;">
								<div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
							</div>
							<div class="ps-scrollbar-y-rail" style="display: block; top: 0px; height: 0px; right: 2px;">
								<div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div>
							</div>
						</ul>
					</li>

					<li class="external">
						<a href="#">
							<span>查看所有</span>
							<i class="fa-link-ext"></i>
						</a>
					</li>
				</ul>
			</li>

		</ul>

		<!-- Right links for user info navbar -->
		<ul class="user-info-menu right-links list-inline list-unstyled">

			<li class="dropdown user-profile" style="min-height: 76px;">
				<a href="#" data-toggle="dropdown">
					<img src="../assets/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28">
					<span>
						张 三
						<i class="fa-angle-down"></i>
					</span>
				</a>

				<ul class="dropdown-menu user-profile-menu list-unstyled">
					<li>
						<a href="#edit-profile">
							<i class="fa-edit"></i>
							编辑
						</a>
					</li>
					<li>
						<a href="#settings">
							<i class="fa-wrench"></i>
							设置
						</a>
					</li>
					<li>
						<a href="#profile">
							<i class="fa-user"></i>
							简介
						</a>
					</li>
					<li>
						<a href="#help">
							<i class="fa-info"></i>
							帮助
						</a>
					</li>
					<li class="last">
						<a href="extra-lockscreen.html">
							<i class="fa-lock"></i>
							登出
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
	<div class="page-title">

		<div class="title-env">


		</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1">
				<li>
				<select>
					  <option>公司1</option>
					  <option>公司2</option>
					  <option>公司3</option>
					  <option>公司4</option>
					  <option>公司5</option>
				</select>
				</li>
				<li>
				<select>
					  <option>车队1</option>
					  <option>车队2</option>
					  <option>车队3</option>
					  <option>车队4</option>
					  <option>车队5</option>
				</select>
				</li>
				<li>
				<select>
					  <option>线路1</option>
					  <option>线路2</option>
					  <option>线路3</option>
					  <option>线路4</option>
					  <option>线路5</option>
				</select>
				</li>

			</ol>

		</div>

	</div>
EOF;

?>