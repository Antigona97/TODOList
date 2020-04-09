<?php
if(isset($_SESSION['account'])) {
include_once "nav.view.php"; ?>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                editable:true,

                plugins: [ 'interaction', 'dayGrid', 'list' ],

                events: '/events',

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listYear'
                },

                eventClick: function(info) {
                    // opens events in a dialog window
                    $('#modalTitle').html(info.event.title);
                    $('#modalBody').html(info.event.extendedProps.description);
                    $('#calendarModal').modal();
                    updateEvent(info.event.id);
                    deleteEvent(info.event.id);
                },
                dateClick:function(info){
                    var date=info.startStr;
                },
                selectable:true,
                selectHelper:true,
                select: function(date)
                {
                    var title = prompt("Enter Task Title");
                    myDate = date.start.getFullYear() + '-' + ('0' + (date.start.getMonth()+1)).slice(-2) + '-' + ('0' + date.start.getDate()).slice(-2);
                    if(title)
                    {
                        $.ajax({
                            url:"event",
                            type:"POST",
                            data:{taskName:title, date:myDate},
                            success: function () {
                                window.location.reload();
                            }
                        })
                    }
                },
                loading: function(bool) {
                    document.getElementById('loading').style.display =
                        bool ? 'block' : 'none';
                }

            });
            calendar.render();
        });
        function updateEvent(id) {
            $('#save').click(function(){
                var description =$('#modalBody').val();
                $.ajax({
                    url:"updateTask",
                    type:"POST",
                    data:{description:description, taskId:id, action:'Save'}
                });
            });
        }
        function deleteEvent(id) {
            $('#buttonDelete').click(function () {
                $.ajax({
                    url:"updateTask",
                    type:'POST',
                    data:{taskId:id, action:'Delete'},
                    success:function () {
                        window.location.reload();
                    }
                });
            });

        }
    </script>
    <style>
        #loading {
            display: none;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        #calendar {
            margin: 0 auto;
        }
    </style>
</head>
<body>
<?php
if(isset($_SESSION['account'])) {
    include_once "nav.view.php"; ?>
    <!-- Page content -->
    <div id="editor">
        <div id="agenda-view">
            <div id='loading'>loading...</div>
            <div id='calendar'>
                <div id="calendarModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 id="modalTitle" class="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                            </div>
                            <textarea id="modalBody" class="form-control" name="description"></textarea>
                            <div class="modal-footer">
                                <button type="button" id="buttonDelete" class="ui-icon ui-icon-trash" name="action" value="Delete"></button>
                                <button type="submit" id="save" class="btn btn-default" name="action" value="Save" data-dismiss="modal">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    </script>
    <?php
}
?>
</body>
    <?php
}
?>
</html>
</html>