{% extends 'layout.php' %}

{% block content %}

<h2>API Documentation</h2>

<p>
The Users API lets gives you access to current user information.
</p>
<ul>
<li><a href="#registration">Registration</a></li>
<li><a href="#authentication">Authenication</a></li>
<li><a href="#users">Users</a></li>
</ul>
<p>
Some routes will require an <code>Authorization</code> header to be sent with the request.<br/>
The value of this header is a <code>token</code> provided when you log in via the 
<code>/api/login</code> endpoint (the value is a JWT token).
</p>
<p>
<b>Example authenticated request:</b><br/>
<div style="border:1px solid #CCCCCC;padding:10px;;background-color:#F9F2F4">
    <code>
    GET /api/users HTTP/1.1<br/>
    Host: ctfrepo.localhost<br/>
    Autorization: Bearer &lt;token&gt;
    </code>
</div>
</p>

<hr/>

<a name="registration"></a>
<h4>Registration</h4>
<code>POST /api/register</code><br/>
<b>Requires authorization header:</b> No<br/>
<p>
Registration requires the following parameters:
<ul>
<li><code>username</code></li>
<li><code>password</code></li>
<li><code>name</code></li>
</ul>
Successful registration will result in a successful <code>message</code>. You must then use <code>/api/login</code> 
to authenticate using this user.
</p>
<br/>

<a name="authentication"></a>
<h4>Authentication</h4>
<code>POST /api/login</code><br/>
<b>Requires authorization header:</b> No<br/>
<p>
Authenticate with the API buy sending the following paramaters:
<ul>
<li><code>username</code></li>
<li><code>password</code></li>
</ul>
Successful authentication will result in a success <code>message</code> and a <code>token</code> value 
to be used in future requests.
</p>
<br/>

<a name="users"></a>
<h4>Users</h4>
<code>GET /api/users</code><br/>
<b>Requires authorization header:</b> Yes<br/>
<p>
Retreive the current list of users. Administrators will receive a listing of all users. 
All others will only receive their own information.
</p>

<br/><br/>
{% endblock %}