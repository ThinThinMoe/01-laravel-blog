<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="/categories">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('post.index') }}">Home</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('post.create') }}">Create A Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/my-posts">My Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/categories/create">Create A Cateogry</a>
                </li>
                @endauth
                @if(Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth()->user()->photo() }}" alt="Profile Image" class="rounded-circle" width="30" height="30">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="px-3"><a class="text-dark text-decoration-none" href="{{ route('profile.show') }}">Profile</a></li>
                        <li>
                            <form id="logout-form" action="{{ url('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-body border-0 px-3">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
