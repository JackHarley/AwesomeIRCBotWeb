{% extends base %}

{% block pageTitle %}Stats for {{nickname}}{% endblock %}

{% block content %}
<h1>Stats for {{nickname}}</h1>

<h3>
	Online?
	{% if online != "" %}
		<span style="color:green">Yes</span>
	{% else %}
		<span style="color:red">No</span>
	{% endif %}
</h3>

<h3>
	Messages sent in the last hour: {{hourMessages}}<br />
	Messages sent in the last day: {{dayMessages}}<br />
	Messages sent in the last week: {{weekMessages}}<br />
</h3>
{% endblock %}