{% extends 'layout.php' %}

{% block content %}

<h2>Challenge 8</h2>

<h2>API Documentation</h2>

<p>
The Files API lets gives you access to current file information.
</p>

<h4>Get File Listing</h4>
<code>POST /</code><br/>
<b>Requires authorization header:</b> No<br/>
<p>
Registration requires the following parameters:
<ul>
<li><code>match</code></li>
</ul>
Successful request will return the list of file names found by your <code>match</code> value. (<b>Example:</b> <code>match=test</code>)
</p>
<br/>


{% endblock %}