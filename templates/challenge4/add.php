{% extends 'layout.php' %}

{% block content %}

<h2>Add New User</h2>

<Div class="col-md-5">
<form action="/challenge4/add" method="POST">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ name }}">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" value="{{ username }}">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <button class="btn btn-success" type="submit">Save</button>
    <a class="btn btn-danger" href="/challenge4/dashboard">Cancel</a>
</form>
</div>

{% endblock %}