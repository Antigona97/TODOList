<?php
if(isset($_SESSION['account'])) {
    include_once "nav.view.php"; ?>
    <!-- Page content -->
    <div id="editor">
        <div id="agenda-view">
            <h2 id="todaysDate"></h2>
            <form class="form-inline" method="post" action="/tasks" id="newTask" style="display: none">
                <div class="row">
                    <input type="text" name="taskName" class="form-control mr-sm-2"
                           placeholder="e.g. Conference meeting">
                    <button id="dateTask" class="btn btn-outline-dark my-2 my-sm-0"><?php echo $date; ?></button>
                    <div class="scheduler" style="display: none;" data-placement="top">
                        <input id="scheduler-input"  class="form-control mr-sm-2" placeholder="Type a date" spellcheck="false">
                    </div>
                    <button type="submit" class="btn btn-outline-dark my-2 my-sm-0">Add task</button>
                </div>
            </form> <br/>
            <form method="post" action="/todayTasks">
                <div class="row" id="addtask" style="">
                    <h4><i class="fa fa-plus-circle"></i>Add task</h4>
                </div>
                <div>
                    <?php if (is_array($tasks) || is_object($tasks)) {
                        foreach ($tasks as $task) :?>
                            <div id="<?=$task->taskId?>"  class="ui-widget-content">
                                <i class="fa fa-circle"></i>
                                <a id="<?=$task->taskId?>" type="submit" href="/openTask?task=<?= $task->taskId; ?>">
                                    <?= $task->taskName; ?>
                                </a>
                            </div> <br/>
                        <?php endforeach;
                    }?>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function () {
            displayDate();
            changeFonts();
            changeDate();
            var arrayPosition=new Array();
            $('.ui-widget-content').draggable({
                stack: ".ui-widget-content",
                stop: function(event, ui) {
                    $('.ui-widget-content').each(function(){
                        var position=$(this).position();
                        arrayPosition.push({id:$(this).attr('id'), position:position.top});
                    });
                    var position=JSON.stringify(arrayPosition);
                    var request=$.ajax({
                        type: "POST",
                        url: 'today',
                        data: {'arrayPosition': position}
                    });
                }
            });
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
                var request=$.ajax({
                    url:'completed',
                    data:{'taskId':id, 'completed':'1'},
                    method:'post'
                });
            });
            $('.fa-plus-circle').click(function () {
                $('#addtask').attr('style', 'display: none');
                $('#newTask').show();
            });
        }

        function changeDate() {
            $('#dateTask').click(function (e) {
                e.preventDefault();
                $('.scheduler').show();
                $('#scheduler-input').datepicker();
            });
            $(document).on('change','#scheduler-input', function () {
                var date=$('scheduler-input').val();
                $.ajax({
                   url:'today',
                   method:'POST',
                   data:{'date':date}
                });
            })
        }


    </script>
    <?php
}
?>
</body>
</html>