{% extends base %}

{% block pageTitle %}Webchat{% endblock %}

{% block content %}
<h1>Webchat</h1>
<iframe width="100%" height="85%" src="http://widget.mibbit.com/?settings=5f7ba721eda38af8b5cafb392ec80c84&server={{address}}&channel={{channel|hashtohtml}}"></iframe>
{% endblock %}