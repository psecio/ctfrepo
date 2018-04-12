{% extends 'layout.php' %}

{% block content %}

<div class="col-md-4">&nbsp;</div>
<div class="col-md-4">
<form class="form form-horizontal" method="POST" action="/challenge4/">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <center>
        <button type="submit" style="width:90px;height:40px" class="btn btn-success">Login</button>
    </center>
</form>
</div>
<div class="col-md-4">&nbsp;</div>

{% endblock %}