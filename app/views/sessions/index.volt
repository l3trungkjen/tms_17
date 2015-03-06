{% extends 'layouts/index.volt' %}
{% block content %}
    {{ form('sessions/save', 'class': 'form-signin') }}
        <h2 class="form-signin-heading">Please sign in</h2>
        <label class="sr-only" for="inputUsername">Username</label>
        {{ text_field('username', 'class': 'form-control', 'placeholder': 'Username...') }}
        <label class="sr-only" for="inputPassword">Password</label>
        {{ password_field('password', 'class': 'form-control', 'placeholder': 'Password...') }}
        {{ submit_button('Sign in', 'class': 'btn btn-lg btn-primary btn-block') }}
    {{ endform() }}
    <p>New user? {{ link_to('signup', 'Sign up now!') }}</p>
{% endblock %}