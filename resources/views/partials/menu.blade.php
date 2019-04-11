<div class="container logo-container">
    <div class="row">
        <div class="col-md-12 text-center">
            <p class="mb-0"><img class="img-fluid logo" src="{{ asset('/images/logo.png') }}" alt="Uni-Vate Properties Logo" /></p>
            <div class="social-media">
                <a href="tel:+27124921238"><i class="fas fa-phone-square fa-2x"></i></a>
                <a href="mailto:info@univateproperties.co.za"><i class="fas fa-envelope-square fa-2x"></i></a>
                <a href="https://www.facebook.com/univateproperties/" target="_blank"><i class="fab fa-facebook-square fa-2x"></i></a>
                @if(Auth::check() && Auth::user()->role == "agent")
                <p style="color: black;font-style: italic;">Agent : {{ Auth::user()->name }} from {{ Auth::user()->agency }}</p>
                @elseif(Auth::check() && Auth::user()->role == "agency admin")
                <p style="color: black;font-style: italic;">Agency administrator : {{ Auth::user()->name }} from {{ Auth::user()->agency }}</p>
                @elseif(Auth::check() && Auth::user()->role == "user" && Auth::user()->agency)
                <p style="color: black;font-style: italic;">Agent : {{ Auth::user()->name }} from {{ Auth::user()->agency }}</p>
                @elseif(Auth::check() && Auth::user()->role == "user")
                <p style="color: black;font-style: italic;">Private Individual : {{ Auth::user()->name }}</p>
                @elseif(Auth::check() && Auth::user()->role == "admin")
                <p style="color: black;font-style: italic;">Super Administrator : {{ Auth::user()->name }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container-fluid nav-container">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav w-100 justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/about">About Us</a>
                            <a class="dropdown-item" href="/timeshare">About Timeshare Resales</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Timeshare
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/to-sell">To Sell</a>
                            @if(Auth::check())
                            <a class="dropdown-item" href="/bulk-weeks-upload">Bulk Weeks upload</a>
                            @endif
                            <a class="dropdown-item" href="/to-buy">To Buy</a>
                            @if(Auth::check() && Auth::user()->role == "admin")
                            <a class="dropdown-item" href="/admin">Admin</a>
                            <a class="dropdown-item" href="/timeshare-change-logs">Logs</a>
                            <a class="dropdown-item" href="/all-agents">All agents</a>
                            <a class="dropdown-item" href="/all-agencies">All agencies</a>
                            @endif
                            @if(Auth::check())
                            <a class="dropdown-item" href="/my-timeshares">Timeshares Listed</a>
                            @endif
                            @if(Auth::check() && (Auth::user()->role == "agency admin" && Auth::user()->access_prelist==1))
                            <a class="dropdown-item" href="/pre-listed-weeks">Pre-listed Weeks</a>
                            @endif
                            @if(Auth::check() && (Auth::user()->role == "agency admin"))
                            <a class="dropdown-item" href="/timeshare-agents">Manage Timeshare Agents</a>
                            <a class="dropdown-item" href="/manage-agency-timeshares">Manage Agency Listings</a>
                            @endif
                            @if(Auth::check() && Auth::user()->agency)
                            <a class="dropdown-item" href="/view-all-timeshares">View All {{ Auth::user()->agency }} Listings</a>
                            @endif
                            @if(Auth::check() && Auth::user()->role == "admin")
                            <a class="dropdown-item" href="/pre-listed-weeks">Pre-listed Weeks</a>
                            <a class="dropdown-item" href="/pre-list-access">Manage pre-listed weeks access</a>
                            @endif
                            <a class="dropdown-item" href="/faqs">FAQs</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Commercial
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/commercial">Search</a>
                            <a class="dropdown-item" href="/list-commercial-rental">To Rent</a>
                            <a class="dropdown-item" href="/list-commercial-sale">To Sell</a>
                            @if(Auth::check() && Auth::user()->role == "admin")
                            <a class="dropdown-item" href="/commercial-admin">Admin</a>
                            @endif
                            @if(Auth::check())
                            <a class="dropdown-item" href="/my-commercial-properties">My Commercial Properties</a>
                            @endif
                            <!--<a class="dropdown-item" href="/register-commercial-agent">Register as an agent</a> -->
                            @if(Auth::check() && Auth::user()->role == "admin")
                            <a class="dropdown-item" href="/all-commercial-properties">All commercial properties</a>
                            @endif
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Residential
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/residential">Search</a>
                            <a class="dropdown-item" href="/list-residential-rental">To Rent</a>
                            <a class="dropdown-item" href="/list-residential-sale">To Sell</a>
                            @if(Auth::check() && Auth::user()->role == "admin")
                            <a class="dropdown-item" href="/residential-admin">Admin</a>
                            @endif
                            @if(Auth::check())
                            <a class="dropdown-item" href="/my-residential-properties">My Residential Properties</a>
                            @endif
                            <!--<a class="dropdown-item" href="/register-residential-agent">Register as an agent</a> -->
                            @if(Auth::check() && Auth::user()->role == "admin")
                            <a class="dropdown-item" href="/all-residential-properties">All residential properties</a>
                            @endif
                        </div>
                    </li>
                    @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="/update-profile/{{ Auth::user()->id }}">Update Profile</a>
                        </li>
                    @endif
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tender Weeks
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="/upload-tender-weeks">Tender Weeks Upload</a>
                                    <a class="dropdown-item" href="/pre-list-access">Manage Access</a>
                                    <a class="dropdown-item" href="/review-prelisted-weeks">Approve selected Weeks</a>
                                </div>
                            </li>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/contact-us">Contact Us</a>
                    </li>
                    @if(Auth::check() && Auth::user()->role === 'agency admin')
                    <li class="nav-item">
                            <a class="nav-link" href="/register-timeshare-agent">Add an agent</a>
                        </li>
                    @endif
<!--
                    <li class="nav-item">
                        <a class="nav-link" href="/csi">CSI</a>
                    </li>
-->
                    @if(!Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
                    </li>
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Register
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/register">Private Individual</a>
                                <a class="dropdown-item" href="/register-agency">Agency</a>
                            </div>
                        </li>
                    </li>

                    @elseif(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Log Out</a>
                    </li>
                    @endif


                </ul>
            </div>
        </nav>
    </div>
</div>
