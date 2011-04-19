{% for message in messages %}
	{{message.time|timetodate:"d M Y H:i:s"}} &lt;{{message.nickname}}&gt; {{message.message}}<br />
{% endfor %}