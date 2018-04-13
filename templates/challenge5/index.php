{% extends 'layout.php' %}

{% block content %}

<script src="/challenge5/js/Chart.min.js"></script>


<canvas id="myChart" width="3000" height="1070" style="display:block;height:200px;width:200px"></canvas>
<script>
var data = [
    {% for d in data %}{{ d }},{% endfor %}
];

var options = {
    scales: {
        yAxes: [{
            ticks: { beginAtZero: true }
        }]
    }
}

var ctx = document.getElementById("myChart").getContext('2d');
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        "labels": [
            {{ labels|raw }}
        ],
        "datasets": [
            {"label": "My Results", "data": data, "fill": false, "borderColor": "rgb(75,192,192)" }
        ]
    },
    options: options
})
</script>
<br/>
<div class="col-md-3">&nbsp;</div>
<div class="col-md-6">
<form action="/challenge5/" method="POST">
    <div class="form-group">
        <label for="data">Data:</label>
        <textarea name="data" id="data" class="form-control">{{ serialize(data) }}</textarea>
    </div>
    <button class="btn btn-success">Submit</button>
</form>
</div>
<div class="col-md-3">&nbsp;</div>

{% endblock %}