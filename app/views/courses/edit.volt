{% extends 'layouts/index.volt' %}
{% block content %}
    {{ form('courses/save', 'class': 'form-signup', 'method': 'post') }}
        <h2>Create new course</h2>
        {{ get_content() }}
        <div class="form-group">
            <label for="name">Name</label>
            {{ hidden_field('id', 'value': course.id) }}
            {{ text_field('name', 'placeholder': 'Input name', 'class': 'form-control', 'value': course.name) }}
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            {{ text_area('description', 'placeholder': 'Input description', 'class': 'form-control', 'value': course.description) }}
        </div>
        <div class="form-group">
            <label for="supervisors">Supervisors</label>
            {{ select_static('supervisor_id', supervisors, 'class': 'form-control') }}
        </div>
        <div class="form-group" id="subjects">
            <label for="supervisors">Subjects</label>
            {% for courseSubject in course.coursesubjects %}
                <div class="border_subject">
                    {{ select_static('subject_id[' ~ courseSubject.id ~ ']', subjects, 'class': 'form-control') }}
                </div>
            {% endfor %}
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="button" id="add_subject">+</button>
        </div>
        {{ submit_button('Save', 'class': 'btn btn-success') }}
    {{ endform() }}
{% endblock %}