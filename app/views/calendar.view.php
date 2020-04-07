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

                eventClick: function(event, jsEvent, view) {
                    console.log(event.title);
                    // opens events in a dialog window
                    $('#modalTitle').html(event.title);
                    $('#modalBody').html(event.description);
                    $('#calendarModal').modal();
                },

                loading: function(bool) {
                    document.getElementById('loading').style.display =
                        bool ? 'block' : 'none';
                }

            });

            calendar.render();
        });

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
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                                <h4 id="modalTitle" class="modal-title"></h4>
                            </div>
                            <div id="modalBody" class="modal-body"> </div>
                            <div class="modal-footer">
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