{% extends 'layout.php' %}

{% block content %}

<h2>{{ post.title }}</h2>

<p>
{{ post.contents }}
</p>

<form action="/challenge3/view/{{ post.id }}" method="POST">
<div class="form-group">
    <label for="comment">Comment</label>
    <textarea rows="7" name="comment" class="form-control"></textarea>
</div>
<button type="submit" class="btn btn-success">Submit</button>
</form>

<h3>Comments</h3>
{% for comment in comments %}
<p>
    {{ comment.contents|raw }}<br/>
    posted: {{ comment.post_date }}
</p>
{% endfor %}


{% endblock %}