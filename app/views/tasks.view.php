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
                    <button id="dateTask" class="btn btn-outline-dark my-2 my-sm-0"><?php echo date("d F") ?></button>
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
            $('.ui-widget-content').draggable({
                stack: ".ui-widget-content",
                stop: function(event, ui) {
                    var arrayPosition=new Array();
                    $('.ui-widget-content').each(function(){
                        var position=$(this).position();
                        arrayPosition.push({id:$(this).attr('id'), position:position.top});
                    });
                    $.ajax({
                        url:'taskControllers.php',
                        method: "POST",
                        data:{'class':'updatePriorityAction','arrayPosition':arrayPosition}
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
            $('#dateTask').click(function (e) {
                $('#inputTask').show();
            });
            $('.fa-circle').click(function () {
                $(this).removeClass();
                $(this).addClass('fa fa-check-circle');
                $(this).closest('div').hide('slow');
                var id=$(this).closest('div').attr('id');
                $.ajax({
                    url:'taskControllers.php',
                    data:{'taskId':id},
                    method:'post'
                });
            });
            $('.fa-plus-circle').click(function () {
                $('#addtask').attr('style', 'display: none');
                $('#newTask').show();
            });
        }

    </script>
    <?php
}
?>
</body>
</html>