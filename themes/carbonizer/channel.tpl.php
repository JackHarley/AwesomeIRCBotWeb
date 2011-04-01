{% extends base %}

{% block pageTitle %}Channel Overview{% endblock %}

{% block content %}
	<h1>Latest Messages - {{channel}}</h1>
	<p>
		<table id="messagelist" cellpadding="0" border="0">
			<input type="hidden" id="latestmessagets" value="{{latestMessage.time}}" />
			{% for message in latestMessages %}
				<tr>
					<td>
						<a href="{% url /index.php/stats/user %}/{{message.nickname}}"><b>&lt;{{message.nickname}}&gt;</b></a>&nbsp;&nbsp;
					</td>
					<td>{{message.message}}</td>
					<td>&nbsp;&nbsp;</td>
				</tr>
			{% endfor %}
		</table>
	</p>
{% endblock %}