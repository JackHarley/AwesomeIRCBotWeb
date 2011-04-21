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
<p>
	<table id="messagelist" cellpadding="0" border="0">
		{% for message in latestUserMessages %}
			<tr>
				<td>
					{{message.time|timetodate:"d M Y H:i:s"}} <a href="{% url /index.php/stats/user %}/{{message.nickname}}"><b>&lt;{{message.nickname}}&gt;</b></a>&nbsp;&nbsp;
				</td>
				<td>{{message.message}}</td>
				<td>&nbsp;&nbsp;</td>
			</tr>
		{% endfor %}
	</table>
</p>
{% endblock %}