{% extends 'layout.php' %}

{% block content %}

<h2>Admin</h2>

<div class="col-md-4">
    <form class="form-horizontal" method="POST" action="/challenge1/admin">
        <div class="form-group">        
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

{% endblock %}