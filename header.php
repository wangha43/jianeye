<?php
//   $bbs = <<<phpapache

// phpapache;
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
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet"  />
	<link href="../css/page.css" rel="stylesheet" />
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/highcharts.js"></script>
    <script type="text/javascript" src="../js/addbody.js"></script>
    <script type="text/javascript" src="../js/modules/exporting.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
phpapache;

$nav = <<<EOF
<nav class="navbar horizontal-menu  navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->

		<div class="navbar-inner">

			<!-- Navbar Brand -->
			<!-- <div class="navbar-brand">
				<a href="dashboard-1.html" class="logo">
					<img src="assets/images/logo-white-bg@2x.png" width="80" alt="" class="hidden-xs" />
					<img src="assets/images/logo@2x.png" width="80" alt="" class="visible-xs" /> -->
			<!-- 	</a>
				<a href="#" data-toggle="settings-pane" data-animate="true">
					<i class="linecons-cog"></i>
				</a>
			</div> -->

			<!-- Mobile Toggles Links -->
			<div class="nav navbar-mobile">

				<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
				<div class="mobile-menu-toggle">
					<!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
					<a href="#" data-toggle="settings-pane" data-animate="true">
						<i class="linecons-cog"></i>
					</a>

					<a href="#" data-toggle="user-info-menu-horizontal">
						<i class="fa-bell-o"></i>
						<span class="badge badge-success"></span>
					</a>

					<!-- data-toggle="mobile-menu-horizontal" will show horizontal menu links only -->
					<!-- data-toggle="mobile-menu" will show sidebar menu links only -->
					<!-- data-toggle="mobile-menu-both" will show sidebar and horizontal menu links -->
					<a href="#" data-toggle="mobile-menu-horizontal">
						<i class="fa-bars"></i>
					</a>
				</div>

			</div>

			<div class="navbar-mobile-clear"></div>



			<!-- main menu -->

			<ul  class="navbar-nav">
					<li class="opened active">
						<a>
							<span class="title">司机</span>
						</a>
						<ul>
								<li class="click_column">
									<a href="../driver/driver_list.php"   >
									<span class='title'>司机安全风险统计表</span>
									</a>
								</li>
								<li class="click_column">
									<a href="../driver/driver_history.php"  >
									<span class='title'>司机历史汇总表</span>
									</a>
								</li>

							<li class="click_column">
									<a href="../driver/secure_trend.php"   >
									<span class='title'>平均危险分数走势图</span>
									</a>
								</li>
							<li class="click_column">
									<a href="../driver/driver_scresult.php"  >
									<span class='title'>司机安全风险绩效</span>
									</a>
								</li>

						</ul>
					</li>

					<li>
						<a href=""   >

							<span class="title">车辆</span>
						</a>
						<ul>
							<li class="click_column">
								<a href="../car/car_list.php"  >
								<span class='title'>车辆安全风险表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../car/car_history.php"  >
								<span class='title'>车辆历史汇总表</span>
								</a>
							</li>
						</ul>
					</li>


					<li class="">
						<a href=""  >

							<span class="title">车辆利用率</span>
						</a>
						<ul>
							<li class="click_column">
								<a href="../car_use/car_use.php"  >
								<span class='title'>车辆利用率</span>
								</a>
							</li>
						</ul>
					</li>

					<li class="">
						<a><span class="title">大数据分析</span></a>
						<ul>
							<li class="click_column">
								<a href="../big_data_analysis/car_runtime.php"  >
								<span class='title'>车辆运行时间报表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../big_data_analysis/car_runtime_sp.php"  >
								<span class='title'>车辆运行异常报表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../big_data_analysis/road_runtime.php"  >
								<span class='title'>道路通行情况分析</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../big_data_analysis/road_safe.php"  >
								<span class='title'>路段安全风险统计</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../big_data_analysis/road_time_safe.php"  >
								<span class='title'>路段加时段安全风险统计</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../big_data_analysis/time_safe.php"  >
								<span class='title'>时段安全风险统计</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="">
						<a href=""  >

							<span class="title">线路</span>
						</a>
						<ul>
							<li class="click_column">
								<a href="../line/securech.php"  >
								<span class='title'>线路安全风险表</span>
								</a>
							</li>

							<li class="click_column">
								<a href="../line/history.php"  >
								<span class='title'>线路历史汇总表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../line/trend.php"  >
								<span class='title'>线路整改趋势表</span>
								</a>
							</li>
						</ul>
					</li>

					<li>
						<a href="">

							<span class="title">车队</span>
						</a>
						<ul>
							<li class="click_column">
								<a href="../team/securech.php"  >
								<span class='title'>车队安全风险统计</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../team/history.php"   >
								<span class='title'>车队历史汇总表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../team/trend.php"  >
								<span class='title'>车队整改趋势表</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="">
						<a href=""  >

							<span class="title">子公司</span>
						</a>
						<ul>
							<li class="click_column">
								<a href="../son_company/securech.php"  >
								<span class='title'>子公司安全风险表</span>
								</a>
							</li>

							<li class="click_column">
								<a href="../son_company/history.php"  >
								<span class='title'>子公司历史汇总表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../son_company/trend.php"  >
								<span class='title'>子公司整改趋势表</span>
								</a>
							</li>
						</ul>
					</li>

					<li class="">
						<a href=""  >

							<span class="title">分公司</span>
						</a>
						<ul>
							<li class="click_column">
								<a href="../company/securech.php"  >
								<span class='title'>公司安全风险表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../company/history.php"  >
								<span class='title'>公司历史汇总表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../company/trend.php"  >
								<span class='title'>公司整改趋势表</span>
								</a>
							</li>
						</ul>
					</li>

					<li class="">
						<a href=""  >

							<span class="title">集团</span>
						</a>
						<ul>
							<li class="click_column">
								<a href="../group/securech.php"  >
								<span class='title'>集团安全风险表</span>
								</a>
							</li>

							<li class="click_column">
								<a href="../group/history.php"  >
								<span class='title'>集团历史汇总表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../group/trend.php"  >
								<span class='title'>集团整改趋势表</span>
								</a>
							</li>
						</ul>
					</li>

					<li class="">
						<a href=""  >

							<span class="title">可能事故</span>
						</a>
						<ul>
							<li class="click_column">
								<a href="../possible_accident/possible_accident.php"  >
								<span class='title'>可能事故</span>
								</a>
							</li>
						</ul>
					</li>

						<li class="">
						<a href=""  >

							<span class="title">疲劳驾驶与<br>设备故障</span>
						</a>
						<ul>
							<li class="click_column">
								<a href="../drive_sleepy_device_ac/drive_sleepy.php"  >
								<span class='title'>疲劳驾驶统计报表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../drive_sleepy_device_ac/devie_warn.php"  >
								<span class='title'>设备故障报警信息</span>
								</a>
							</li>
						</ul>
					</li>

					<li class="">
						<a href=""  >

							<span class="title">路段超速<br>统计分析</span>
						</a>
						<ul>
							<li class="click_column">
								<a href="../distant_speed_analysis/distant_speed_analysis.php"  >
								<span class='title'>路段超速统计分析</span>
								</a>
							</li>
						</ul>
					</li>




					<li class="">
						<a href=""  >

							<span class="title">油耗</span>
						</a>
						<ul>
							<li class="click_column">
								<a href="../oil/oil_company.php"  >
								<span class='title'>分公司油耗统计表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../oil/oil_group.php"  >
								<span class='title'>集团油耗统计表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../oil/oil_son_company.php"  >
								<span class='title'>子公司油耗统计表</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../oil/oil_driver_detail.php"  >
								<span class='title'>司机油耗详情</span>
								</a>
							</li>
							<li class="click_column">
								<a href="../oil/oil_car_detail.php"  >
								<span class='title'>车辆油耗详情</span>
								</a>
							</li>
						</ul>
					</li>
				</ul>

		</div>

	</nav>
EOF;

$bottomsc = <<<EOF
	<!-- Bottom Scripts -->
	<script src="../assets/js/bootstrap.min.js"></script>
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
?>
