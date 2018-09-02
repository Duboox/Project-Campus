<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
                    <span>
                        <img class="img-circle user-avatar" src="{{ user_avatar() }}">
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> 
                            <span class="block m-t-xs"> 
                                <strong class="font-bold">{{ username() }}</strong>
                             </span> 
                              <span class="text-muted text-xs block">
                                {{ user_level() }} <b class="caret"></b>
                            </span> 
                        </span> 
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li>
                            <a href="{{ route('profile.index', username()) }}">Perfil</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li {{ setActive('home') }}>
                <a href="{{ route('home') }}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">Home</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-lock"></i> 
                    <span class="nav-label">Campus Admin</span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="{{ route('services.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="nav-label">Solicitudes</span>
                            <span class="label label-warning pull-right">{{ $service_count }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('clients.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="nav-label">Empresas</span>
                            <span class="label label-warning pull-right">{{ $client_count }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('fabricators.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="nav-label">Fabricantes</span>
                            <span class="label label-warning pull-right">{{ $fabricator_count }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="nav-label">Equipos</span>
                            <span class="label label-warning pull-right">{{ $product_count }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('calibrations.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="nav-label">Control de calibraciones</span>
                            <span class="label label-warning pull-right">{{ $product_count }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-lock"></i> 
                    <span class="nav-label">Seguridad</span>
                </a>
                <ul class="nav nav-second-level collapse">
                   <li>
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="nav-label">Usuarios</span>
                            <span class="label label-warning pull-right">{{ $user_count }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}">
                            <i class="fa fa-cog"></i>
                            <span class="nav-label">Roles</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>