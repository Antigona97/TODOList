$(document).ready(function () {
    displayDate();
    changeFonts();
    $('#dateTask').datepicker();
    sorting();
    priority();
});

function displayDate() {
    dlist = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    mlist = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var d = new Date();
    var day = dlist[d.getDay()];
    var month = mlist[d.getMonth()];
    $("#todaysDate").html('Today ' + day + ' ' + month + ' ' + d.getDate());
}

function changeFonts() {
    $('.fa-circle').click(function () {
        $(this).removeClass();
        $(this).addClass('fa fa-check-circle');
        $(this).closest('div').hide('slow');
        var id=$(this).closest('div').attr('id');
        $.ajax({
            url:'completed',
            data:{'taskId':id, 'completed':'1'},
            method:'post',
            success: function (data) {
                console.log(data);
            }
        });
    });
    $('.fa-plus-circle').click(function () {
        $('#addtask').attr('style', 'display: none');
        $('#newTask').show();
    });
}

function sorting() {
    var arrayPosition=new Array();
    $('.ui-widget-content').draggable({
        stack: ".ui-widget-content",
        stop: function(event, ui) {
            $('.ui-widget-content').each(function(){
                var position=$(this).position();
                arrayPosition.push({id:$(this).attr('id'), position:position.top});
            });
            var position=JSON.stringify(arrayPosition);
            $.ajax({
                type: "POST",
                url: 'today',
                data: {'arrayPosition': position}
            });
        }
    });
}

function priority() {
    $('.ui-widget-content').each(function() {
        if ($(this).find('a').attr('class') == 'low') {
            $(this).find('a').removeClass();
            $(this).find('a').addClass('btn btn-outline-success');
        } else if ($(this).find('a').attr('class') == 'medium') {
            $(this).find('a').removeClass();
            $(this).find('a').addClass('btn btn-outline-warning');
        } else {
            $(this).find('a').removeClass();
            $(this).find('a').addClass('btn btn-outline-danger');
        }
    });

}

