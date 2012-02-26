<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="{% viewurl /style.css %}" />
		<link href="{% viewurl /images/chat.png %}" rel="shortcut icon" type="image/png"/>
		<link rel="apple-touch-icon" media="screen and (resolution: 163dpi)" href="{% viewurl /images/chat57.png %}" />
		<link rel="apple-touch-icon" media="screen and (resolution: 132dpi)" href="{% viewurl /images/chat72.png %}" />
		<link rel="apple-touch-icon" media="screen and (resolution: 326dpi)" href="{% viewurl /images/chat114.png %}" />
		
		<title>{{channel}} -> {% block pageTitle %}{% endblock %}</title>
		
		{% block jsOne %}
			<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
		{% endblock %}
		
		{% block jsTwo %}
		{% endblock %}
	</head>
	
	<body>
		<div id="wrapper">
		<div id="header">
			<h1 style="font-size:500%">{{channel}}</h1>
			<h2><a href="{% url /index.php %}">Home</a> | <a href="{% url /index.php/logs %}">Logs</a> | <a href="{% url /index.php/channel %}">Channel Right Now</a> | <a href="{% url /index.php/stats %}">Stats</a> | <a href="{% url /index.php/leaderboard %}">Leaderboards</a> | <a href="{% url /index.php/chat %}">Chat!</a> | {% if exists loggedInUser %}<a href="{% url /index.php/user/profile %}">{{loggedInUser}}</a>{% else %}<a href="{% url /index.php/user/login %}">Login</a>{% endif %}
		</div>
		
		<div id="page">
			{% block content %}{% endblock %}
		</div>
		</div>
	</body>
</html>