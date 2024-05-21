@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp


<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">			
						  <h3><b>GUB Transport</b> </h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		    <li class="{{ ($route === 'admin.dashboard') ? 'active' : '' }}">
          <a href="{{ route('admin.dashboard') }}">
            <i data-feather="pie-chart"></i>
			      <span>Dashboard</span>
          </a>
        </li>  
		
        {{-- <li class="treeview {{ ($prefix === '/brand') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-handshake"></i>
            <span>Brand</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'brand.view') ? 'active' : '' }}"><a href="{{ route('brand.view') }}"><i class="ti-more"></i>All Brands</a></li>
            <li><a href="calendar.html"><i class="ti-more"></i>Calendar</a></li>
          </ul>
        </li>  --}}

        <li class="treeview {{ ($prefix === '/route') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-user"></i>
            <span>Route</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'admin.route.view') ? 'active' : '' }}"><a href="{{ route('admin.route.view') }}"><i class="ti-more"></i>All Routes</a></li>
            <li class="{{ ($route === 'admin.route.add') ? 'active' : '' }}"><a href="{{ route('admin.route.add') }}"><i class="ti-more"></i>Add Route</a></li>
          </ul>
        </li> 

        <li class="treeview {{ ($prefix === '/users') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-user"></i>
            <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'user.view') ? 'active' : '' }}"><a href="{{ route('user.view') }}"><i class="ti-more"></i>All Users</a></li>
          </ul>
        </li> 

        <li class="treeview {{ ($prefix === '/driver') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-user"></i>
            <span>Driver</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'admin.driver.view') ? 'active' : '' }}"><a href="{{ route('admin.driver.view') }}"><i class="ti-more"></i>All Drivers</a></li>
          </ul>
        </li> 


        <li class="treeview {{ ($prefix === '/vehicle') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-user"></i>
            <span>Vehicle</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'admin.vehicle.view') ? 'active' : '' }}"><a href="{{ route('admin.vehicle.view') }}"><i class="ti-more"></i>All Vehicles</a></li>
          </ul>
        </li> 


        <li class="{{ ($route === 'admin.area.view') ? 'active' : '' }}">
          <a href="{{ route('admin.area.view') }}">
            <i class="fa-solid fa-user"></i>
            <span>Pickup Areas</span>
          </a>
        </li> 

        
      </ul>
    </section>
	
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>