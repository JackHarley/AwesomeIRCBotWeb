{% extends base %}

{% block pageTitle %}Channel{% endblock %}

{% block jsTwo %}
<script type="text/javascript">
	var lpOnComplete = function(response) {
		var jsonObj = response;
		if (jsonObj.type == 4412) {
			if (jsonObj.nickname != " ") {
				var html = '<tr><td><b><a href="{% url /index.php/stats/user %}/'+jsonObj.nickname+'">&lt;'+jsonObj.nickname+'&gt;</a></b></td><td>'+jsonObj.message+'</td></tr>';
			}
			else {
				var html = '<tr><td></td><td>'+jsonObj.message+'</td></tr>';
			}
		}
		else if (jsonObj.type == 421) {
			var html = '<tr><td></td><td>'+jsonObj.nickname+' joined the channel</td></tr>';
		}
		else if (jsonObj.type == 422) {
			var html = '<tr><td></td><td>'+jsonObj.nickname+' left the channel</td></tr>';
		}
		else if (jsonObj.type == 412) {
			var html = '<tr><td></td><td>'+jsonObj.nickname+' changed nickname to '+jsonObj.target_nick+'</td></tr>';
		}
	
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
{% endblock %}

{% block content %}

<div id="left">
	<h1>Latest Messages - {{channel}}</h1>
	<p>
		<table id="messagelist" cellpadding="0" border="0">
			<input type="hidden" id="latestmessagets" value="{{latestMessage.time}}" />
			{% for message in latestMessages %}
				<tr>
					{% if message.type == 4412 %}
						{% if message.nickname != " " %}
							<td><a href="{% url /index.php/stats/user %}/{{message.nickname}}"><b>&lt;{{message.nickname}}&gt;</b></a>&nbsp;&nbsp;</td>
						{% else %}
							<td></td>
						{% endif %}
						<td>{{message.message|urlize}}</td>
					{% else if message.type == 421 %}
						<td></td>
						<td>{{message.nickname}} joined the channel</td>
					{% else if message.type == 422 %}
						<td></td>
						<td>{{message.nickname}} left the channel</td>
					{% else if message.type == 412 %}
						<td></td>
						<td>{{message.nickname}} changed nickname to {{message.target_nick}}</td>
					{% endif %}
					
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
				<a style="color:green" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a><br />
			{% endif %}
			{% if user.privilege == "&" %}
				<a style="color:red" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a><br />
			{% endif %}
			{% if user.privilege == "@" %}
				<a style="color:orange" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a><br />
			{% endif %}
			{% if user.privilege == "%" %}
				<a style="color:blue" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a><br />
			{% endif %}
			{% if user.privilege == "+" %}
				<a style="color:purple" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a><br />
			{% endif %}
			{% if user.privilege == "" %}
				<a style="color:black" href="{% url /index.php/stats/user %}/{{user.nickname}}">{{user.privilege}}{{user.nickname}}</a><br />
			{% endif %}
		{% endfor %}
	</p>
</div>
{% endblock %}