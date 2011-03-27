{% extends base %}

{% block content %}
<h2>{{channel}}</h2>

<div id="left">
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
</div>		
<div id="right">
	<p>
		{% for user in onlineUsers %}
			{% if user.privilege == "~" %}
				<span style="color:lime">{{user.privilege}}{{user.nickname}}</span><br />
			{% endif %}
			{% if user.privilege == "&" %}
				<span style="color:red">{{user.privilege}}{{user.nickname}}</span><br />
			{% endif %}
			{% if user.privilege == "@" %}
				<span style="color:orange">{{user.privilege}}{{user.nickname}}</span><br />
			{% endif %}
			{% if user.privilege == "%" %}
				<span style="color:aqua">{{user.privilege}}{{user.nickname}}</span><br />
			{% endif %}
			{% if user.privilege == "+" %}
				<span style="color:yellow">{{user.privilege}}{{user.nickname}}</span><br />
			{% endif %}
			{% if user.privilege == "" %}
				<span style="color:white">{{user.privilege}}{{user.nickname}}</span><br />
			{% endif %}
		{% endfor %}
	</p>
</div>
{% endblock %}