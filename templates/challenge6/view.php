{% extends 'layout.php' %}

{% block content %}

<h2>Viewing: {{ file.title }}</h2>

<p>
{{ file.content }}
</p>
<br/>
<a class="btn btn-success" href="/challenge6">Back to list</a>

{% if recent is defined %}
<br/><hr/>
<div style="background-color:#EEEEEE;padding:5px;border:1px solid #CCCCCC">
<b>Recently viewed:</b> {{ recent }}
</div>
{% endif %}

{% endblock %}