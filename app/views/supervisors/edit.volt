{% extends 'layouts/index.volt' %}
{% block content %}
    {{ form('supervisors/save', 'class': 'form-signup', 'method': 'post') }}
        <h2>Edit Supervisor</h2>
        {{ get_content() }}
        <div class="form-group">
            <label for="name">Name</label>
            {{ hidden_field('id', 'value': supervisor.id) }}
            {{ text_field('name', 'placeholder': 'Input name', 'class': 'form-control', 'value': supervisor.name) }}
        </div>
        {{ submit_button('Save', 'class': 'btn btn-success') }}
    {{ endform() }}
{% endblock %}