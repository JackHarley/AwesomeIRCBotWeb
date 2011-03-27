{% extends base %}

{% block pageTitle %}Channel Overview{% endblock %}

{% block content %}
	<h1>Latest Messages - {{channel}}</h1>
	<p>
		<table cellpadding="0" border="0">
			{% for message in latestMessages %}
				<tr>
					<td>
						<b>&lt;{{message.nickname}}&gt;</b>&nbsp;&nbsp;
					</td>
					<td>{{message.message}}</td>
					<td>&nbsp;&nbsp;</td>
				</tr>
			{% endfor %}
		</table>
	</p>
{% endblock %}