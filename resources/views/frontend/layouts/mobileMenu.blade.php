<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>
        
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="active">
                    <a href="{{url('')}}">Home</a>
                </li>
                 @php
                   $getCategoryMobile = App\Models\Backend\Category::getRecordMenu()
                 @endphp

                @foreach($getCategoryMobile as $value_cate_mob)
                   @if(!empty($value_cate_mob->getSubCategory->count()))
                <li>
                    <a href="{{url($value_cate_mob->slug)}}">{{$value_cate_mob->name}}</a>
                    <ul>
                        @foreach($value_cate_mob->getSubCategory as $v_mob_sub_cate)
                        <li><a href="{{url($value_cate_mob->slug.'/'.$v_mob_sub_cate->slug)}}">{{$v_mob_sub_cate->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                 @endif
                @endforeach
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->