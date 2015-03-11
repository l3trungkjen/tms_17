{% extends 'layouts/index.volt' %}
{% block content %}
    {{ get_content() }}
    <h2>Supervisors</h2>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        {% if supervisors.count() > 0 %}
            {% for supervisor in supervisors %}
                <tr>
                    <td>{{ supervisor.id }}</td>
                    <td>{{ link_to('supervisors/edit/' ~ supervisor.id, supervisor.name) }}</td>
                    <td>
                        {{ link_to('supervisors/delete/' ~ supervisor.id, 'Delete', 'onclick': "return confirm('Are you sure you want to delete?')") }}
                    </td>
                </tr>
            {% endfor %}
        {% else %}
            <tr>
                <td colspan="3">Data not found!!!</td>
            </tr>
        {% endif %}
    </table>
{% endblock %}