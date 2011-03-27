<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="{% viewurl /style.css %}" />
		
		<title>Awesome IRC Bot -> {% block pageTitle %}{% endblock %}</title>
	</head>
	
	<body>
		<div id="header">
			<h1>{{ircAddress}} {{channel}}</h1>
			<h2><a class="navbarlink" href="{% url /index.php %}">Home</a> | <a href="{% url /index.php/logs %}">Logs</a> | <a href="{% url /index.php/channel %}">Channel Right Now</a> | <a href="{% url /index.php/stats %}">Stats</a> | <a href="{% url /index.php/stats/leaderboards %}">Leaderboards</a> | <a href="{% url /index.php/help %}">Help</a> | <a href="{% url /index.php/chat %}">Chat!</a>
		</div>
		
		<div id="page">
			{% block content %}{% endblock %}
		</div>
	</body>
</html>