{% extends base %}

{% block pageTitle %}Logs{% endblock %}

{% block content %}

<h1>Logs for {{startTime|timetodate:"d M Y H:i:s"}} to {{endTime|timetodate:"d M Y H:i:s"}}</h1>
	<table style="border:1px; width:100%">
		{% for message in messages %}
			<tr>
				<td style="width:170px">{{message.time|timetodate:"d M Y H:i:s"}}</td>
				{% if message.type == 4412 %}
					{% if message.nickname != " " %}
						<td><a href="{% url /index.php/stats/user %}/{{message.nickname}}"><b>&lt;{{message.nickname}}&gt;</b></a></td>
					{% else %}
						<td></td>
					{% endif %}
					<td style="word-break:break-all">{{message.message|urlize}}</td>
				{% else if message.type == 421 %}
					<td></td>
					<td>{{message.nickname}} joined the channel</td>
				{% else if message.type == 422 %}
					<td></td>
					<td>{{message.nickname}} left the channel</td>
				{% else if message.type == 412 %}
					<td></td>
					<td>{{message.nickname}} changed nickname to {{message.target_nick}}</td>
				{% endif %}
			</tr>
		{% endfor %}
	</table>

{% endblock %}