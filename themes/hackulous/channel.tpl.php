{% extends base %}

{% block pageTitle %}Channel{% endblock %}

{% block content %}

<div id="left">
	<h1>Latest Messages - {{channel}}</h1>
	<p>
		<table id="messagelist" cellpadding="0" border="0">
			<input type="hidden" id="latestmessagets" value="{{latestMessage.time}}" />
			{% for message in latestMessages %}
				<tr>
					{% if message.type == 4412 %}
						{% if message.nickname != " " %}
							<td><a href="{% url /index.php/stats/user %}/{{message.nickname}}"><b>&lt;{{message.nickname}}&gt;</b></a>&nbsp;&nbsp;</td>
						{% else %}
							<td></td>
						{% endif %}
						<td>{{message.message}}</td>
					{% else if message.type == 421 %}
						<td></td>
						<td>-> {{message.nickname}} joined the channel</td>
					{% else %}
						<td></td>
						<td>{{message.type}}</td>
					{% endif %}
					
					<td>&nbsp;&nbsp;</td>
				</tr>
			{% endfor %}
		</table>
	</p>
</div>		
<div id="right">
	<p>
		{% for user in onlineUsers %}
			{% if user.privilege == "~" %}
				<a style="color:green" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a><br />
			{% endif %}
			{% if user.privilege == "&" %}
				<a style="color:red" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a><br />
			{% endif %}
			{% if user.privilege == "@" %}
				<a style="color:orange" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a><br />
			{% endif %}
			{% if user.privilege == "%" %}
				<a style="color:blue" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a><br />
			{% endif %}
			{% if user.privilege == "+" %}
				<a style="color:purple" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a><br />
			{% endif %}
			{% if user.privilege == "" %}
				<a style="color:black" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a><br />
			{% endif %}
		{% endfor %}
	</p>
</div>
{% endblock %}