<nav class="navbar navbar-expand-md fixed-top bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="icon/favicon.ico" alt="" width="50"></a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ $title === 'Home' ? 'active' : '' }}" aria-current="page"
                        href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title === 'About' ? 'active' : '' }}" aria-current="page"
                        href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a id="btn-login"
                        class="nav-link btn btn-primary text-light px-3 ms-3 {{ $title === 'About' ? 'active' : '' }}"
                        aria-current="page" href="/login" target="_blank">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
