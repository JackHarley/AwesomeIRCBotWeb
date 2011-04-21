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

<h3>
	Messages sent in the last hour: {{hourMessages}}<br />
	Messages sent in the last day: {{dayMessages}}<br />
	Messages sent in the last week: {{weekMessages}}
</h3>

<h3>
	Words sent in the last hour: {{hourWords}}<br />
	Words sent in the last day: {{dayWords}}<br />
	Words sent in the last week: {{weekWords}}
</h3>

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