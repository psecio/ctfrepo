{% extends 'layout.php' %}

{% block content %}

{% if found is defined and found == false%}
    <div class="alert alert-danger">Invalid Login</div>
{% endif %}

<form action="/challenge2/user/login" method="POST">
<div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" name="username">
</div>
<div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" name="password">
</div>
<button type="submit" class="btn btn-success">Submit</button>
</form>

{% endblock %}