<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
			{{channel}} -> {% block pageTitle %}{% endblock %}
		</title>
		<link href="{% viewurl /style.css %}" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
		<script type="text/javascript">
			var lpOnComplete = function(response) {
				var jsonObj = response;
				var html = '<tr><td><b><a href="{% url /index.php/stats/user %}/'+jsonObj.nickname+'">&lt;'+jsonObj.nickname+'&gt;</a></b></td><td>'+jsonObj.message+'</td></tr>';
			
				$(html).prependTo('#messagelist');
				$('#latestmessagets').val(jsonObj.timestamp);
				lpStart();
			};
			 
			var lpStart = function() {
				var timestamp = $('#latestmessagets').val();
				$.post('{% url /index.php/channel/ajax %}', {timestamp: timestamp}, lpOnComplete, 'json');
			};
			 
			var lpReady = function() {
				setTimeout("lpStart()", 1000);
			}
			
			$(window).load(lpReady);
		</script>
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
									<li><a style="color:green" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a></li>
								{% endif %}
								{% if user.privilege == "&" %}
									<li><a style="color:red" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a></li>
								{% endif %}
								{% if user.privilege == "@" %}
									<li><a style="color:brown" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a></li>
								{% endif %}
								{% if user.privilege == "%" %}
									<li><a style="color:blue" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a></li>
								{% endif %}
								{% if user.privilege == "+" %}
									<li><a style="color:purple" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a></li>
								{% endif %}
								{% if user.privilege == "" %}
									<li><a style="color:black" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a></li>
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

