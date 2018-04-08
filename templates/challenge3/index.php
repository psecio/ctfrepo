{% extends 'layout.php' %}

{% block content %}

<h2>My Blog</h2>

{% for post in posts %}

<h3><a href="/challenge3/view/{{ post.id }}">{{ post.title }}</a></h3>
<div>
{{ post.contents }}
</div>
<br/>

{% endfor %}

{% endblock %}