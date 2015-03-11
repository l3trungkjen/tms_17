{% extends 'layouts/index.volt' %}
{% block content %}
    {{ form('subjects/save', 'class': 'form-signup', 'method': 'post') }}
        <h2>Edit Subjects</h2>
        {{ get_content() }}
        <div class="form-group">
            <label for="name">Name</label>
            {{ hidden_field('id', 'value': subject.id) }}
            {{ text_field('name', 'placeholder': 'Input name', 'class': 'form-control', 'value': subject.name) }}
        </div>
        {{ submit_button('Save', 'class': 'btn btn-success') }}
    {{ endform() }}
{% endblock %}