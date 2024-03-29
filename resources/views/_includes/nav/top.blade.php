
<nav class="navbar navbar-default">
    <div class="container-fluid">
        {{--  --}}
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toogle navigatioon</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Moments</a>
        </div>
        {{--  --}}
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('posts.index')}}">Home</a>
                </li>
                {{-- <li>
                    <a href="#">Recent</a>
                </li>
                <li>
                    <a href="#">Popular</a>
                </li> --}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <a href="{{ route('posts.create') }}" class="btn btn-primary" style="margin-top:5px;">Share A Moment</a>
             <!-- Authentication Links -->
             @guest
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
             </li>
             @if (Route::has('register'))
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                 </li>
             @endif
         @else
             <li class="nav-item dropdown">
                 <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                     {{ Auth::user()->name }} <span class="caret"></span>
                 </a>

                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
                 </div>
             </li>
         @endguest
        </div>
    </div>
</nav>