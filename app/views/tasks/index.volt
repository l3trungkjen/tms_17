{% extends 'layouts/index.volt' %}
{% block content %}
    {{ get_content() }}
    <h2>Tasks</h2>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Subject</th>
            <th>Action</th>
        </tr>
        {% for task in tasks %}
            <tr>
                <td>{{ task.id }}</td>
                <td>{{ link_to('tasks/edit/' ~ task.id, task.name) }}</td>
                <td>{{ task.subjects.name }}</td>
                <td>
                    {{ link_to('tasks/delete/' ~ task.id, 'Delete', 'onclick': "return confirm('Are you sure you want to delete?')") }}
                </td>
            </tr>
        {% else %}
            <tr>
                <td colspan="4">Data not found!!!</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}