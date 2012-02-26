{% extends base %}

{% block pageTitle %}Stats for {{nickname}}{% endblock %}

{% block content %}
<h1>Stats for {{nickname}}</h1>

<h3>
	Online?
	{% if online != "" %}
		<span style="color:green">Yes</span>
	{% else %}
		<span style="color:red">No</span>
	{% endif %}
</h3>

<h3>Latest Known Details</h3>

<p>
	{% for message in latestUserMessages %}
		{% if forloop.first %}
			Host: {{message.host}}<br />
			Ident: {{message.ident}}
		{% endif %}
	{% endfor %}
</p>

<div id="user-stats">
	<h2>User Statistics</h2>
	
	<h3 id="user-stats">Past Hour</h3><br />
	<p id="user-stats">
		Messages sent: {{hour.messages}}<br />
		Words sent: {{hour.words}}<br />
		Average words per message: {{hour.wordsPerMessage|round:2}}<br />
	</p><br />
	
	<h3 id="user-stats">Past Day (24 hours)</h3><br />
	<p id="user-stats">
		Messages sent: {{day.messages}}<br />
		Words sent: {{day.words}}<br />
		Average words per message: {{day.wordsPerMessage|round:2}}<br />
	</p><br />
	
	<h3 id="user-stats">Past Week</h3><br />
	<p id="user-stats">
		Messages sent: {{week.messages}}<br />
		Words sent: {{week.words}}<br />
		Average words per message: {{week.wordsPerMessage|round:2}}<br />
	</p><br />
</div>

<h2>Latest Messages</h2>
	<table>
		{% for message in latestUserMessages %}
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