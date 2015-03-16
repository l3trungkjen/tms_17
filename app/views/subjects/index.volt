{% extends 'layouts/index.volt' %}
{% block content %}
    {{ get_content() }}
    <h2>Subjects</h2>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        {% for subject in subjects %}
            <tr>
                <td>{{ subject.id }}</td>
                <td>{{ link_to('subjects/edit/' ~ subject.id, subject.name) }}</td>
                <td>
                    {{ link_to('subjects/delete/' ~ subject.id, 'Delete', 'onclick': "return confirm('Are you sure you want to delete?')") }}
                </td>
            </tr>
        {% else %}
            <tr>
                <td colspan="3">Data not found!!!</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}