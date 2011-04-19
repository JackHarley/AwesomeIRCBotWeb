{% extends base %}

{% block pageTitle %}Leaderboards{% endblock %}

{% block content %}
<h1>Channel Leaderboards</h1>

<div id="leaderboards">
	<div id="left-leaderboard">
		<h3>Past Week</h3>
		<table cellpadding="0" border="0">
			<tr>
				<th></th>
				<th>Nickname</th>
				<th>Message Count</th>
			</tr>
			
			{% for leaderboardEntry in leaderboardWeekEntries %}
			<tr>
				<td>{{leaderboardEntry.position}},&nbsp;</td>
				<td><a href="{% url /index.php/stats/user %}/{{leaderboardEntry.nickname}}">{{leaderboardEntry.nickname}}</a>&nbsp;</td>
				<td>{{leaderboardEntry.messageCount}}</td>
			</tr>
			{% endfor %}
		</table>
	</div>
	<div id="right-leaderboard">
		<h3>Past Hour</h3>
		<table cellpadding="0" border="0">
			<tr>
				<th></th>
				<th>Nickname</th>
				<th>Message Count</th>
			</tr>
			
			{% for leaderboardEntry in leaderboardHourEntries %}
			<tr>
				<td>{{leaderboardEntry.position}},&nbsp;</td>
				<td><a href="{% url /index.php/stats/user %}/{{leaderboardEntry.nickname}}">{{leaderboardEntry.nickname}}</a>&nbsp;</td>
				<td>{{leaderboardEntry.messageCount}}</td>
			</tr>
			{% endfor %}
		</table>
	</div>
	<div id="center-leaderboard">
		<h3>Past Day</h3>
		<table cellpadding="0" border="0">
			<tr>
				<th></th>
				<th>Nickname</th>
				<th>Message Count</th>
			</tr>
			
			{% for leaderboardEntry in leaderboardDayEntries %}
			<tr>
				<td>{{leaderboardEntry.position}},&nbsp;</td>
				<td><a href="{% url /index.php/stats/user %}/{{leaderboardEntry.nickname}}">{{leaderboardEntry.nickname}}</a>&nbsp;</td>
				<td>{{leaderboardEntry.messageCount}}</td>
			</tr>
			{% endfor %}
		</table>
	</div>
</div>
{% endblock %}