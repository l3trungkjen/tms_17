<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TMS_17</title>
        {% block css %}
            {{ stylesheet_link('css/bootstrap.min.css') }}
            {{ stylesheet_link('css/bootstrap-theme.min.css') }}
            {{ stylesheet_link('css/style.css') }}
        {% endblock %}
        {% block javascript %}
            {{ javascript_include('js/jquery.min.js') }}
            {{ javascript_include('js/bootstrap.min.js') }}
        {% endblock %}
    </head>
    <body>
        {{ partial('layouts/header') }}
        <div class="container starter-template">
            {% block content %}
                {{ content() }}
            {% endblock %}
        </div>
    </body>
</html>