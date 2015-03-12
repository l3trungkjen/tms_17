{% extends 'layouts/index.volt' %}
{% block content %}
    {{ form('courses/create', 'class': 'form-signup', 'method': 'post') }}
        <h2>Create new course</h2>
        {{ get_content() }}
        <div class="form-group">
            <label for="name">Name</label>
            {{ text_field('name', 'placeholder': 'Input name', 'class': 'form-control') }}
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            {{ text_area('description', 'placeholder': 'Input description', 'class': 'form-control') }}
        </div>
        <div class="form-group">
            <label for="supervisors">Supervisors</label>
            {{ select_static('supervisor_id', supervisors, 'class': 'form-control') }}
        </div>
        <div class="form-group" id="subjects">
            <label for="supervisors">Subjects</label>
            <div class="border_subject">
                {{ select_static('subject_id[]', subjects, 'class': 'form-control') }}
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="button" id="add_subject">+</button>
        </div>
        {{ submit_button('Create', 'class': 'btn btn-success') }}
    {{ endform() }}
{% endblock %}