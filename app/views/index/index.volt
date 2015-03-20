<h1 class="text_align_center">List Courses</h1>
<div class="row">
    {% for course in courses %}
        <div class="col-md-3">
            <h4>{{ course.name }}</h4>
            <p>{{ link_to('enrollments/new/' ~ course.id, 'Training »', 'class': 'btn btn-default') }}</p>
        </div>
    {% endfor %}
</div>