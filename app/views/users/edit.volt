{% extends 'layouts/index.volt' %}
{% block content %}
    {{ form('users/save', 'class': 'form-signup', 'method': 'post', 'id': 'form_user_new') }}
        <h2>Update profile</h2>
        {{ get_content() }}
        {{ hidden_field('id', 'value': profile.id) }}
        <div class="form-group">
            <label for="fullnameullname">Fullname</label>
            {{ text_field('fullname', 'placeholder': 'Input fullname', 'class': 'form-control', 'value': profile.fullname) }}
        </div>
        {{ submit_button('Save', 'class': 'btn btn-success') }}
    {{ endform() }}
{% endblock %}