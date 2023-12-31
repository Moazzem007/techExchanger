

<div class="mainmenu-area" style="margin-top: 20px; position: absolute;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('product.all')}}">All Products</a></li>
                    <li><a href="{{ route('categories.all') }}">Category</a></li>
                    <li><a href="{{route('contact.page')}}">Contact us</a></li>
                    <li id="logincss" style="margin-left: 100px;"><a class="btn btn-warning" href="{{ route('product.create') }}">Sell something</a></li>



                    @guest
                        <li id="logincss"><a class="btn btn-primary" href="{{route('login')}}">Log in</a></li>
                        <li id="registercss"><a class="btn btn-success" href="{{route('register')}}">Register</a></li>
                    @else
                        <li id="logincss">
                            <a class="dropdown-item btn btn-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>




                    @endguest

                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->
