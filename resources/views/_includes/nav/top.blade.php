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
                    <a href="{{ route('home')}}">Home</a>
                </li>
                <li>
                    <a href="#">Recent</a>
                </li>
                <li>
                    <a href="#">Popular</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <a href="#" class="btn btn-primary" style="margin-top:5px;">Share A Moment</a>
            </ul>
        </div>
    </div>
</nav>