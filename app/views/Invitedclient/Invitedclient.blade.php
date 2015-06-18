@extends('layouts.layout') @section('mycssfile')

@stop
 @section('myjsfile') 
 @stop
 
  @section('content')
 <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas {{ $left_class }}">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    @include('layouts/inner_leftside')

                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side {{ $right_class }}">
                <!-- Content Header (Page header) -->
                @include('layouts.below_header')
	
		<!-- Main content -->
		<section class="content">
        
        
        
			<div class="practice_mid">
				<div class="row icon_section">
					<div class="left_section">
                    
						<ul>
							<li class="hvr-grow" style="margin-right:100px;">
								<a href="/invitedclient-details">
								<div class="circle_icons_inner">
								<div class="circle_icon"> <img alt="" src="img/dashboard_circle.png"> </div>
								<p class="c_tagline2">MY DETAILS</p>
								<div class="clearfix"></div>
								</div></a>
							</li>
							<li class="hvr-grow" style="margin-right:100px;">
								<a href="#">
								<div class="circle_icons_inner">
								<div class="circle_icon"> <img alt="" src="img/dashboard_circle.png"> </div>
								<p class="c_tagline2">FILES</p>
								<div class="clearfix"></div>
								</div></a>
							</li>
							<li class="hvr-grow">
								<a href="#">
								<div class="circle_icons_inner">
								<div class="circle_icon"> <img alt="" src="img/dashboard_circle.png"> </div>
								<p class="c_tagline">SUBMIT TAX RETURN<br>
								INFORMATION</p>
								<div class="clearfix"></div>
								</div></a>
							</li>
						</ul>
                        
					</div>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-9" style="padding:0;">
						<p>
							<strong>
								In job email section shoild show here
							</strong>
						</p>
					</div>
					<div class="col-xs-3">
						<div class="next_prev_btn">
							<ul>
								<li>
									<a href="#">Next</a>
								</li>
								<li>
									|
								</li>
								<li>
									<a href="#">Previous</a>
								</li>
							</ul>
						</div>
						<div class="clearfix">
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="slide_content">
						<ul>
							<li>
								<p>
									Vat
									<br>
									Period
									<br>
									Amount
									<br>
									Due Date
									<br>
									Payment Ref
									<br>
									How to Play
								</p>
								<a href="#"><img src="img/cross_icon.png" class="cross_icon" /></a>
							</li>
							<li>
								<p>
									Vat
									<br>
									Period
									<br>
									Amount
									<br>
									Due Date
									<br>
									Payment Ref
									<br>
									How to Play
								</p>
								<a href="#"><img src="img/cross_icon.png" class="cross_icon" /></a>
							</li>
							<li>
								<p>
									Vat
									<br>
									Period
									<br>
									Amount
									<br>
									Due Date
									<br>
									Payment Ref
									<br>
									How to Play
								</p>
								<a href="#"><img src="img/cross_icon.png" class="cross_icon" /></a>
							</li>
							<li>
								<p>
									Vat
									<br>
									Period
									<br>
									Amount
									<br>
									Due Date
									<br>
									Payment Ref
									<br>
									How to Play
								</p>
								<a href="#"><img src="img/cross_icon.png" class="cross_icon" /></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-xs-12">
					<table width="70%" border="0" class="business_table" align="center">
						<tr>
							<td width="12%">
								<strong>
									Select Business
								</strong>
							</td>
							<td width="31%">
								<select class="form-control">
									<option>
										One Cloud Limited
									</option>
									<option>
										option 2
									</option>
									<option>
										option 3
									</option>
									<option>
										option 4
									</option>
									<option>
										option 5
									</option>
								</select>
							</td>
							<td width="3%" align="center">
								<a href="#"><img src="img/edit_icon.png" /></a>
							</td>
							<td width="7%">
								<button class="btn btn-success">
									Save
								</button>
							</td>
							<td width="2%">
								&nbsp;
							</td>
							<td width="3%">
								<button class="btn btn-info">
									Add New Business
								</button>
							</td>
							<td width="2%">
								&nbsp;
							</td>
						</tr>
					</table>
				</div>
				<div class="clearfix">
				</div>
				<!--vat section-->
				<div class="col-xs-12">
					<div class="vat_maincon">
						<div class="vat_section">
							<ul>
								<li>
									<div class="vat_section_main">
										<div class="head_section">
											VAT RETURNS
										</div>
										<div class="vat_section_content">
											<ul>
												<li>
													Vat Number : 196205
												</li>
												<li>
													Registration Date : 15/05/2015
												</li>
												<li>
													Scheme
												</li>
												<li>
													Cycle : efef
												</li>
												<li>
													Vat Months (Stagger) :
												</li>
												<li>
													<a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
									<div class="vat_section_main">
										<div class="head_section">
											ANNUAL ACCOUNTS
										</div>
										<div class="vat_section_content">
											<ul>
												<li>
													Vat Number : 196205
												</li>
												<li>
													Registration Date : 15/05/2015
												</li>
												<li>
													Scheme
												</li>
												<li>
													Cycle : efef
												</li>
												<li>
													Vat Months (Stagger) :
												</li>
												<li>
													<a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
									<div class="vat_section_main">
										<div class="head_section">
											PERSONAL TAX PAYMENT ON ACCOUNT
										</div>
										<div class="vat_section_content">
											<ul>
												<li>
													Vat Number : 196205
												</li>
												<li>
													Registration Date : 15/05/2015
												</li>
												<li>
													Scheme
												</li>
												<li>
													Cycle : efef
												</li>
												<li>
													Vat Months (Stagger) :
												</li>
												<li>
													<a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
									<div class="vat_section_main">
										<div class="head_section">
											COMPANIE'S HOUSE ANNUAL RETURNS
										</div>
										<div class="vat_section_content">
											<ul>
												<li>
													Vat Number : 196205
												</li>
												<li>
													Registration Date : 15/05/2015
												</li>
												<li>
													Scheme
												</li>
												<li>
													Cycle : efef
												</li>
												<li>
													Vat Months (Stagger) :
												</li>
												<li>
													<a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
									<div class="vat_section_main">
										<div class="head_section">
											INCOME TAX RETURNS
										</div>
										<div class="vat_section_content">
											<ul>
												<li>
													Vat Number : 196205
												</li>
												<li>
													Registration Date : 15/05/2015
												</li>
												<li>
													Scheme
												</li>
												<li>
													Cycle : efef
												</li>
												<li>
													Vat Months (Stagger) :
												</li>
												<li>
													<a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
									<div class="vat_section_main">
										<div class="head_section">
											PAY/NICS
										</div>
										<div class="vat_section_content">
											<ul>
												<li>
													Vat Number : 196205
												</li>
												<li>
													Registration Date : 15/05/2015
												</li>
												<li>
													Scheme
												</li>
												<li>
													Cycle : efef
												</li>
												<li>
													Vat Months (Stagger) :
												</li>
												<li>
													<a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
									<div class="vat_section_main">
										<div class="head_section">
											P11DS
										</div>
										<div class="vat_section_content">
											<ul>
												<li>
													Vat Number : 196205
												</li>
												<li>
													Registration Date : 15/05/2015
												</li>
												<li>
													Scheme
												</li>
												<li>
													Cycle : efef
												</li>
												<li>
													Vat Months (Stagger) :
												</li>
												<li>
													<a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
									<div class="vat_section_main">
										<div class="head_section">
											BUSINESS TAX RETURNS
										</div>
										<div class="vat_section_content">
											<ul>
												<li>
													Vat Number : 196205
												</li>
												<li>
													Registration Date : 15/05/2015
												</li>
												<li>
													Scheme
												</li>
												<li>
													Cycle : efef
												</li>
												<li>
													Vat Months (Stagger) :
												</li>
												<li>
													<a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
									<div class="vat_section_main">
										<div class="head_section">
											EC SALES LIST
										</div>
										<div class="vat_section_content">
											<ul>
												<li>
													Vat Number : 196205
												</li>
												<li>
													Registration Date : 15/05/2015
												</li>
												<li>
													Scheme
												</li>
												<li>
													Cycle : efef
												</li>
												<li>
													Vat Months (Stagger) :
												</li>
												<li>
													<a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
									<div class="vat_section_main">
										<div class="head_section">
											HMRC PAYMENT PLAN DATES
										</div>
										<div class="vat_section_content">
											<ul>
												<li>
													<a href="#">Add</a>
												</li>
												<li>
													<a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a>
												</li>
											</ul>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--end vat section-->
				<div class="clearfix">
				</div>
			</div>
		</section>
		<!-- /.content -->
	</aside>
	<!-- /.right-side -->
</div>
@stop