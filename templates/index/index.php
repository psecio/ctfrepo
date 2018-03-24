{% extends 'layout.php' %}

{% block content %}

<h3>Challenges</h3>
{% for challenge in challenges %}
<a href="{{ challenge.link }}">{{ challenge.name }}</a><br/>
{% endfor %}

{% endblock %}