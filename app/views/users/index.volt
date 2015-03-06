{% extends 'layouts/index.volt' %}
{% block content %}
    {{ get_content() }}
    <h2>Users</h2>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Fullname</th>
            <th>Username</th>
            <th>Created</th>
            <th>Admin</th>
            <th>Action</th>
        </tr>
        {% if users.count() > 0 %}
            {% for user in users %}
                <tr>
                    <td>{{ user.id }}</td>
                    <td>{{ link_to('users/edit/' ~ user.id, user.fullname) }}</td>
                    <td>{{ user.username }}</td>
                    <td>{{ user.created }}</td>
                    <td>{{ (user.status is constant('Users::STATUS_USER')) ? 'No' : 'Yes' }}</td>
                    <td>
                        {{ link_to('users/delete/' ~ user.id, 'Delete', 'onclick': "return confirm('Are you sure you want to delete?')") }}
                    </td>
                </tr>
            {% endfor %}
        {% else %}
            <tr>
                <td colspan="6">Data not found!!!</td>
            </tr>
        {% endif %}
    </table>
{% endblock %}