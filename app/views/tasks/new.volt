{% extends 'layouts/index.volt' %}
{% block content %}
    {{ form('tasks/create', 'class': 'form-signup', 'method': 'post') }}
        <h2>Add new tasks</h2>
        {{ get_content() }}
        <div class="form-group">
            <label for="name">Name</label>
            {{ text_field('name', 'placeholder': 'Input name', 'class': 'form-control') }}
        </div>
        <div class="form-group">
            <label for="subjects">Subjects</label>
            {{ select_static('subject_id', subjects, 'class': 'form-control') }}
        </div>
        {{ submit_button('Create', 'class': 'btn btn-success') }}
    {{ endform() }}
{% endblock %}