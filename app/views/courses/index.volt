{% extends 'layouts/index.volt' %}
{% block content %}
    {{ get_content() }}
    <h2>Courses</h2>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Supervisor</th>
            <th>Description</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        {% for courses in courses %}
            <tr>
                <td>{{ courses.id }}</td>
                <td>{{ link_to('courses/edit/' ~ courses.id, courses.name) }}</td>
                <td>{{ courses.supervisors.name }}</td>
                <td>{{ courses.description }}</td>
                <td>{{ courses.created }}</td>
                <td>
                    {{ link_to('courses/delete/' ~ courses.id, 'Delete', 'onclick': "return confirm('Are you sure you want to delete?')") }}
                </td>
            </tr>
        {% else %}
            <tr>
                <td colspan="6">Data not found!!!</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}