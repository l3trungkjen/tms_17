$.fn.subjects = {}

$.fn.subjects.init = ()->
    $ document
        .on 'click', '#add_subject', $.fn.subjects.addSubject

$.fn.subjects.addSubject = (e)->
    e.preventDefault()
    $.ajax
        url: '/tms_17/subjects/view'
        type: 'POST'
        success: (data)->
            $ '#subjects'
                .append data