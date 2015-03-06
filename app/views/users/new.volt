{% extends 'layouts/index.volt' %}
{% block content %}
    {{ form('users/create', 'class': 'form-signup', 'method': 'post') }}
        <h2>Sign up</h2>
        {{ get_content() }}
        <div class="form-group">
            <label for="fullname">Fullname</label>
            {{ text_field('fullname', 'placeholder': 'Input fullname', 'class': 'form-control') }}
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            {{ text_field('username', 'placeholder': 'Input username', 'class': 'form-control') }}
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            {{ password_field('password', 'placeholder': 'Input password', 'class': 'form-control') }}
        </div>
        <div class="form-group">
            <label for="user_password_confirmation">Confirmation</label>
            {{ password_field('confirmation', 'placeholder': 'Input confirmation', 'class': 'form-control') }}
        </div>
        {{ submit_button('Signup', 'class': 'btn btn-success') }}
    {{ endform() }}
{% endblock %}