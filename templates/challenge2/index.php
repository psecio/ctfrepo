{% extends 'layout.php' %}

{% block content %}

<style>
div.notify {
    background-color: #ffffa5;
    padding: 10px;
    width: 600px;
    color: #968c63;
    border: 1px solid #968c63;
}
</style>

<center>
    <div class="notify">
    <h2>Maintenance Mode</h2>
    <p>
    This site is currently in maintenance mode. <br/>
    Please check back later when we've fixed things.
    </p>
    </div>
</center>

{% endblock %}