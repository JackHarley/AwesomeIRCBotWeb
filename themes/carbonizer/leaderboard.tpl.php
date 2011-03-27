{% extends base %}

{% block content %}
<h1>Channel Leaderboards</h1>

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
		<td>{{leaderboardEntry.nickname}}&nbsp;</td>
		<td>{{leaderboardEntry.messageCount}}</td>
	</tr>
	{% endfor %}
</table>

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
		<td>{{leaderboardEntry.nickname}}&nbsp;</td>
		<td>{{leaderboardEntry.messageCount}}</td>
	</tr>
	{% endfor %}
</table>
{% endblock %}