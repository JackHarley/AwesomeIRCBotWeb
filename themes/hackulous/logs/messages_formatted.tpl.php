{% extends base %}

{% block pageTitle %}Logs{% endblock %}

{% block content %}

<h1>Logs for {{startTime|timetodate:"d M Y H:i:s"}} to {{endTime|timetodate:"d M Y H:i:s"}}</h1>
<p>
	<table id="messagelist" cellpadding="0" border="0">
		{% for message in messages %}
			<tr>
				<td>{{message.time|timetodate:"d M Y H:i:s"}}</td>
				<td><a href="{% url /index.php/stats/user %}/{{message.nickname}}"><b>&lt;{{message.nickname}}&gt;</b></a>&nbsp;&nbsp;</td>
				<td>{{message.message}}</td>
				<td>&nbsp;&nbsp;</td>
			</tr>
		{% endfor %}
	</table>
</p>

{% endblock %}