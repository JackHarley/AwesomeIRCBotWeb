{% extends base %}

{% block pageTitle %}Login{% endblock %}

{% block content %}
<h2>Login</h2>

<p>
	To login via this prompt, simply log on to a channel the bot is on and execute the identify command, followed by the generatepass command.<br />
	A password will be PM'd to you which you can then use to login here
</p>

<p>
	{% block alerts %}
		{% if exists alert %}
			{% if alert.type == "error" %}
				<span style="color:red">{{alert.message}}</span>
			{% else if alert.type == "info" %}
				<span style="color:aqua">{{alert.message}}</span>
			{% endif %}
		{% endif %}
	{% endblock %}
</p>

<p>
	<form action="" method="post">
		Username:<br />
		<input type="text" name="username" /><br />
		<br />
		Password:<br />
		<input type="password" name="password" /><br />
		<br />
		<input type="submit" name="submit" value="Login" />
	</form>
</p>
{% endblock %}