{% extends 'layouts/index.volt' %}
{% block content %}
    {{ form('supervisors/create', 'class': 'form-signup', 'method': 'post') }}
        <h2>Add new Supervisor</h2>
        {{ get_content() }}
        <div class="form-group">
            <label for="name">Name</label>
            {{ text_field('name', 'placeholder': 'Input name', 'class': 'form-control') }}
        </div>
        {{ submit_button('Create', 'class': 'btn btn-success') }}
    {{ endform() }}
{% endblock %}