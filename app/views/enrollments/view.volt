{% extends 'layouts/index.volt' %}
{% block content %}
    {{ get_content() }}
    {{ form('enrollments/save', 'method': 'post') }}
        {{ hidden_field('enrollment_id', 'value': enrollment.id) }}
        {% for enrollment_subject in enrollment.enrollmentsubjects %}
            <div class="bs-callout bs-callout-info">
                {{ hidden_field('enrollment_subject_id[]', 'value': enrollment_subject.id) }}
                <h4>{{ enrollment_subject.subjects.name }}</h4>
            </div>
            <div class="color-swatches">
                {% for task in enrollment_subject.subjects.tasks %}
                    {% set flag = false %}
                    {% for enrollment_subject_tasks in enrollment_subject.enrollmentsubjecttasks %}
                        {% if enrollment_subject_tasks.task_id is task.id %}
                            {% set flag = true %}
                            {% break %}
                        {% endif %}
                    {% endfor %}
                    {% if !flag %}
                        <div class="color-swatch brand-success">
                            {{ task.name }}<br>
                            <span class="checkbox-finish">
                                {{ check_field('task_id[' ~ enrollment_subject.id ~ '][' ~ task.id ~ ']', 'value': task.id) }}Finish
                            </span>
                        </div>
                    {% else %}
                        <div class="color-swatch gray-light">
                            {{ task.name }}<br>
                            <span class="checkbox-finish">
                                {{ check_field('task_id[' ~ enrollment_subject.id ~ '][' ~ task.id ~ ']', 'value': 1, 'checked': 'checked', 'disabled': 'disabled') }}Finish
                            </span>
                        </div>
                    {% endif %}
                {% endfor %}
            </div>
        {% endfor %}
        {{ submit_button('Update', 'class': 'btn btn-success') }}
    {{ endform() }}
    <hr>
    <h4>Activities</h4>
    <ul class="nav nav-pills nav-stacked">
        {% for activitie in user.activities %}
            {% if !activitie.task_id is empty %}
                <li>{{ activitie.temp_type }} {{ activitie.tasks.name }} <span class="hidden-xs">{{ activitie.created }}</span></li>
            {% else %}
                <li>{{ activitie.temp_type }} <span class="hidden-xs">{{ activitie.created }}</span></li>
            {% endif %}
        {% endfor %}
    </ul>
{% endblock %}