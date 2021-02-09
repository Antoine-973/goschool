{% extends base.php %}
{% block title %}Welcome, home page {% endblock %}
{% block content %}
    <h1>Home page</h1>
    <p>{{ $message }}</p>
    <ul>

    {% foreach($fruits as $fruit):%}
        <li>{{ $fruit }}</li>
    {% endforeach %}
    </ul>

    {{ $query }}
{% endblock %}