{% for message in messages %}
	{{message.time|timetodate:"d M Y H:i:s"}}
	{% if message.type == 4412 %}
		{% if message.nickname != " " %}
			&lt;{{message.nickname}}&gt;
		{% endif %}
		{{message.message|urlize}}
	{% else if message.type == 421 %}
		{{message.nickname}} joined the channel
	{% else if message.type == 422 %}
		{{message.nickname}} left the channel
	{% else if message.type == 412 %}
		{{message.nickname}} changed nickname to {{message.target_nick}}</td>
	{% endif %}
	<br />
{% endfor %}