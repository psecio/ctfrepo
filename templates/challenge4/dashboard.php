{% extends 'layout.php' %}

{% block content %}

<h2>Users</h2>

<a class="btn btn-success" href="/challenge4/add">+ Add User</a>
<br/>
<table class="table table-striped">
<thead>
    <th>Username</th>
    <th>Name</th>
    <th>&nbsp;</th>
</thead>
<tbody>
    {% for user in users %}
    <tr>
        <td>{{ user.username }}</td>
        <td>{{ user.name }}</td>
        {% if currentUser is defined and currentUser.username == 'admin' and user.username != 'admin' %}
        <td>
            <a class="btn btn-danger" href="/challenge4/delete/{{ user.id }}">Delete</a>
        </td>
        {% else %}
        <td>&nbsp;</td>
        {% endif %}
    </tr>
    {% endfor %}
</tbody>
</table>

{% endblock %}