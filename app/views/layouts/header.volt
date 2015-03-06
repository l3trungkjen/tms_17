<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{ link_to('index', 'HOME', 'class': 'navbar-brand') }}
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                {% if user is empty %}
                    <li>
                        {{ link_to('signin', 'Sign in') }}
                    </li>
                {% else %}
                    {% if user.status is constant('Users::STATUS_ADMIN') %}
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Courses
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>{{ link_to('courses/new', 'Add new') }}</li>
                                <li>{{ link_to('courses', 'Show all') }}</li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Supervisors
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>{{ link_to('supervisors/new', 'Add new') }}</li>
                                <li>{{ link_to('supervisors', 'Show all') }}</li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Users
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>{{ link_to('users', 'Show all') }}</li>
                            </ul>
                        </li>
                    {% endif %}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ user.fullname }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>{{ link_to('users/profile/' ~ user.id, 'Profile') }}</li>
                            <li>{{ link_to('users/edit/' ~ user.id, 'Settings') }}</li>
                            <li class="divider"></li>
                            <li class="dropdown-header">{{ link_to('logout', 'Sign out') }}</li>
                        </ul>
                    </li>
                {% endif %}
            </ul>
        </div>
    </div>
</nav>