{% extends 'layout.php' %}

{% block content %}

<h3>Files</h3>

<table class="table table-striped">
<thead>
    <th>Title</th>
    <th>Size</th>
    <th>View</th>
</thead>
<tbody>
    {% for file in files %}
        {% if file.hide == 0 %}
        <tr>
            <td>{{ file.title }} </td>
            <td>{{ file.size }} bytes</td>
            <td>
                <a href="/challenge6/view/{{ file.id }}" class="btn btn-success">View</a>
            </td>
        </tr>
        {% endif %}
    {% endfor %}
</tbody>
</table>

{% if recent is defined %}
<br/><hr/>
<div style="background-color:#EEEEEE;padding:5px;border:1px solid #CCCCCC">
<b>Recently viewed:</b> {{ recent }}
</div>
{% endif %}

{% endblock %}