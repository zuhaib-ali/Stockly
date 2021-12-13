
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div style="display:flex; justify-content:space-between; width:100px">
            @if(Session::get('user')->role=='admin')
                <!-- Notifications -->
                <div class="notifications">
                    <div style="position:relative;">
                        <i class="fas fa-bell" style="color:blue; font-size:20px;"></i>
                        <p id='total-unseen-transactions'></p>
                        <ul id="unseen-transactions-list" hidden></ul>
                    </div>
                </div>
            @endif
            <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
        </div>
    </header>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">BBBootstrap</span> </a>
                @if(Session::get('user')->role == 'admin')
                    <div class="nav_list"> 
                        <!-- Dashboard -->
                        <a href="{{ route('admin') }}" class="nav_link @if(Route::currentRouteName() == 'admin') active @endif"> 
                            <i class='bx bx-grid-alt nav_icon'></i> 
                            <span class="nav_name">Dashboard</span> 
                        </a> 

                        <!-- Accountant -->
                        <a href="{{ route('admin.accountants') }}" class="nav_link @if(Route::currentRouteName() == 'admin.accountants') active @endif"> 
                            <i class='fas fa-user-alt'></i>
                            <span class="nav_name">Accountants</span> 
                        </a> 

                        <!-- Companies -->
                        <a href="{{ route('admin.companies') }}" class="nav_link @if(Route::currentRouteName() == 'admin.companies') active @endif"> 
                            <i class='fas fa-briefcase'></i>
                            <span class="nav_name">Companies</span> 
                        </a> 

                        <!-- Categories -->
                        <a href="{{ route('admin.categories') }}" class="nav_link @if(Route::currentRouteName() == 'admin.categories') active @endif"> 
                            <i class='fas fa-align-right'></i>
                            <span class="nav_name">Categories</span> 
                        </a>

                        <!-- Products -->
                        <a href="{{ route('admin.products') }}" class="nav_link @if(Route::currentRouteName() == 'admin.products') active @endif"> 
                            <i class='bx bx-basket'></i>
                            <span class="nav_name">Products</span> 
                        </a> 
                    </div>                

                @elseif(Session::get('user')->role == 'accountant')
                    <!-- Dashboard -->
                    <a href="{{ route('accountant') }}" class="nav_link @if(Route::currentRouteName() == 'accountant') active @endif"> 
                        <i class='bx bx-grid-alt nav_icon'></i> 
                        <span class="nav_name">Dashboard</span> 
                    </a>    
                    
                    <!-- Investers -->
                    <a href="{{ route('accountant.investors') }}" class="nav_link @if(Route::currentRouteName() == 'accountant.investors') active @endif"> 
                        <i class='fas fa-boxes'></i>
                        <span class="nav_name">Investers</span> 
                    </a> 

                    <!-- Transaction -->
                    <a href="{{ route('accountant.transaction') }}" class="nav_link @if(Route::currentRouteName() == 'accountant.transaction') active @endif"> 
                        <i class='fas fa-credit-card'></i>
                        <span class="nav_name">Transaction</span> 
                    </a> 
                @endif
            </div> 

            <!-- Logout -->
            <a href="{{ route('signOut') }}" class="nav_link"> 
                <i class='bx bx-log-out nav_icon'></i> 
                <span class="nav_name">SignOut</span> 
            </a>
        </nav>
    </div>