 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="text-align: center;" >
      <img src="{{url('public/assets/dist/img/4DsLogo.png')}}" alt="4Ds Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> {{Auth::user()->name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->


      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="image">
          <img src="{{url('public/assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>

        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <li class="nav-item">
            <a href="{{url('backend/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard 
                <!-- {{ Request::segment(2) }} -->
              </p>
            </a>
          </li>

          <li class="nav-item"> 
            <a href="{{url('admins/admin/list')}}" class="nav-link @if(Request::segment(2) == 'admin') active @endif ">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Admin
              </p>
            </a>
          </li>

          <li class="nav-item"> 
            <a href="{{url('admins/customer/list')}}" class="nav-link @if(Request::segment(2) == 'customer') active @endif ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customer
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('orders/order/list')}}" class="nav-link @if(Request::segment(2) == 'order') active @endif ">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Orders
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('categories/category/list')}}" class="nav-link @if(Request::segment(2) == 'category') active @endif ">
              <!-- <i class="nav-icon fas fa-user"></i> -->
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Category
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('subCategories/subCategory/list')}}" class="nav-link @if(Request::segment(2) == 'subCategory') active @endif ">
              <!-- <i class="nav-icon fas fa-list-alt"></i> -->
              <i class="far fa-circle nav-icon"></i>
              
              <p>
                Sub Category
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('brands/brand/list')}}" class="nav-link @if(Request::segment(2) == 'brand') active @endif ">
              <!-- <i class="nav-icon fas fa-user"></i> -->
              <i class="nav-icon fas fa-chart-pie"></i>              
              <p>
                Brand
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('colors/color/list')}}" class="nav-link @if(Request::segment(2) == 'color') active @endif ">
              <!-- <i class="nav-icon fas fa-user"></i> -->
              <i class="nav-icon fas fa-th"></i>
              <p>
                Color
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('products/product/list')}}" class="nav-link @if(Request::segment(2) == 'product') active @endif ">
              <!-- <i class="nav-icon fas fa-user"></i> -->
              <i class="fa-circle nav-icon"></i>
              <p>
                Product
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{url('discountCodes/discountCode/list')}}" class="nav-link @if(Request::segment(2) == 'discountCode') active @endif ">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Discount Code
              </p>
            </a>
          </li>  


          <li class="nav-item">
            <a href="{{url('shipping_charges/shipping_charge/list')}}" class="nav-link @if(Request::segment(2) == 'shipping_charge') active @endif ">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Shipping Charge 
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('sliders/slider/list')}}" class="nav-link @if(Request::segment(2) == 'slider') active @endif ">
              <i class="nav-icon fas fa-table"></i>

              <p>
                Slider 
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('partners/partner/list')}}" class="nav-link @if(Request::segment(2) == 'partner') active @endif ">
              <i class="nav-icon fas fa-table"></i>

              <p>
                Business Partner Logo 
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="{{url('contacts/contactus/list')}}" class="nav-link @if(Request::segment(2) == 'contactus') active @endif ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Contact Us
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="{{url('pages/page/list')}}" class="nav-link @if(Request::segment(2) == 'page') active @endif ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Pages
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('blogs/categoy/list')}}" class="nav-link @if(Request::segment(2) == 'categoy') active @endif ">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Blog Category
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('bblogs/blog/list')}}" class="nav-link @if(Request::segment(2) == 'blog') active @endif ">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Blog
              </p>
            </a>
          </li> 


          <li class="nav-item">
            <a href="{{url('settings/system-setting')}}" class="nav-link @if(Request::segment(2) == 'system-setting') active @endif ">
              <i class="nav-icon fas fa-edit"></i>

              <p>
                System Setting
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{url('hsettings/home-setting')}}" class="nav-link @if(Request::segment(2) == 'home-setting') active @endif ">
              <i class="nav-icon fas fa-edit"></i>

              <p>
                Home Setting
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('emails/smtp-setting')}}" class="nav-link @if(Request::segment(2) == 'smtp-setting') active @endif ">
              <i class="nav-icon fas fa-edit"></i>

              <p>
                SMTP Setting
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('payments/payment-setting')}}" class="nav-link @if(Request::segment(2) == 'payment-setting') active @endif ">
              <i class="nav-icon fas fa-edit"></i>

              <p>
                Payment Setting
              </p>
            </a>
          </li> 

   

              <!-- <i class="nav-icon fas fa-th"></i>

              <i class="nav-icon fas fa-copy"></i>

              <i class="nav-icon fas fa-chart-pie"></i>

              <i class="far fa-circle nav-icon"></i>
              

              <i class="nav-icon fas fa-edit"></i>
              <i class="nav-icon fas fa-table"></i> -->
          
          
         

           <li class="nav-item">
            <a href="{{url('customAuths/logout')}}" class="nav-link ">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>