{% extends 'layout.php' %}

{% block content %}

<h2>My Blog</h2>

{% for post in posts %}

<h3>{{ post.title }}</h3>
<div>
{{ post.body }}
</div>
<br/>

{% endfor %}

{% endblock %}