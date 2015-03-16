{% extends 'layouts/index.volt' %}
{% block content %}
    {{ form('tasks/save', 'class': 'form-signup', 'method': 'post') }}
        <h2>Edit task</h2>
        {{ get_content() }}
        <div class="form-group">
            <label for="name">Name</label>
            {{ hidden_field('id', 'value': task.id) }}
            {{ text_field('name', 'placeholder': 'Input name', 'class': 'form-control', 'value': task.name) }}
        </div>
        <div class="form-group">
            <label for="subjects">Subjects</label>
            {{ select_static('subject_id', subjects, 'class': 'form-control', 'value': task.subject_id) }}
        </div>
        {{ submit_button('Create', 'class': 'btn btn-success') }}
    {{ endform() }}
{% endblock %}