<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
			{{channel}} -> {% block pageTitle %}{% endblock %}
		</title>
		<link href="{% viewurl /style.css %}" rel="stylesheet" type="text/css"/>
	</head>
	
	<body>
		<div id="container">
			<div id="header">
				<div id="slogan">Statistics for {{ircAddress}} {{channel}}</div>
				<div id="logo"><a href="{% url /index.php %}">{{channel}} Statistics</a></div>
			</div>
			
			<div id="menu">
				<ul>
					<li><a href="{% url /index.php %}">Home</a></li>
					<li><a href="{% url /index.php/channel %}">Channel Overview</a></li>
					<li><a href="{% url /index.php/stats %}">Stats</a></li>
					<li><a href="{% url /index.php/leaderboard %}">Leaderboards</a></li>
				</ul>
			</div>
			<div id="main">
				<div id="sidebar">
					{% block sidebar %}
						<h3>Connected User List</h3>
						<ul>
							{% for user in onlineUsers %}
								{% if user.privilege == "~" %}
									<li style="color:green">{{user.privilege}}{{user.nickname}}</li>
								{% endif %}
								{% if user.privilege == "&" %}
									<li style="color:red">{{user.privilege}}{{user.nickname}}</li>
								{% endif %}
								{% if user.privilege == "@" %}
									<li style="color:brown">{{user.privilege}}{{user.nickname}}</li>
								{% endif %}
								{% if user.privilege == "%" %}
									<li style="color:blue">{{user.privilege}}{{user.nickname}}</li>
								{% endif %}
								{% if user.privilege == "+" %}
									<li style="color:purple">{{user.privilege}}{{user.nickname}}</li>
								{% endif %}
								{% if user.privilege == "" %}
									<li style="color:black">{{user.privilege}}{{user.nickname}}</li>
								{% endif %}
							{% endfor %}
						</ul>
					{% endblock %}
				</div>
				
				<div id="text">
					{% block content %}
					{% endblock %}
				</div>
				
			</div>
			
			<div id="footer">
				
				<div id="footer_left">&copy; Copyright 2011 <a href="http://github.com/AwesomezGuy/AwesomeIRCBotWeb">AwesomeIRCBotWeb</a></div>
				<div id="footer_right">
					Design by <a href="http://www.designity.org/">Free Web Design Community</a>
				</div>
			</div>
		</div>
	</body>
</html>

