{% extends base %}

{% block content %}
<h1>{{channel}} Statistics</h1>

<h3>
	Messages in the Last Hour: {{hourMessageCount}}<br />
	Messages in the Last Day: {{dayMessageCount}}
</h3>

<h3>
	Users Connected to Channel: {{numberUsers}}<br />
	<br />
	Number of Owners (~): {{numberOwners}}<br />
	Number of Protected Users (&): {{numberProtected}}<br />
	Number of Ops (@): {{numberOps}}<br />
	Number of HalfOps (%): {{numberHalfOps}}<br />
	Number of Voiced Users (+): {{numberVoiced}}<br />
	Number of Unprivileged Users: {{numberUnprivileged}}
</h3>
{% endblock %}