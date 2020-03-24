<?php include_once "nav.view.php" ?>
<!-- Page content -->
<div id="editor">
    <div id="agenda-view">
    <form method="post" action="/todayTasks">
        <h2 id="todaysDate"></h2> <br/>
        <div class="row" id="addtask" style="">
            <h4><i class="fa fa-plus-circle"></i>Add task</h4>
        </div>
        <div>
            <?php
            if(is_array($tasks) || is_object($tasks))
            {
                foreach ($tasks as $task) :?>
                    <p><i class="fa fa-circle">
                            <?= $task->description ?>
                        </i>
                    </p>
                <?php endforeach;
            }?>
        </div>
    </form>
    <form class="form-inline" method="post" action="/tasks" id="newTask" style="display: none">
        <div class="row">
            <input type="text" name="description" class="form-control mr-sm-2" placeholder="e.g. Conference meeting">
            <button id="dateTask" class="btn btn-outline-dark my-2 my-sm-0"><?php echo date("d F") ?></button>
            <button type="submit" class="btn btn-outline-dark my-2 my-sm-0">Add task</button>
        </div>
    </form> <br/>
    </div>
</div>
</div>
<script>
    $(document).ready(function () {
       displayDate();
       changeFonts();
    });
    function displayDate(){
        dlist=["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        mlist = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
        var d=new Date();
        var day=dlist[d.getDay()];
        var month=mlist[d.getMonth()];
        $("#todaysDate").html('Today '+day+' '+month+ ' '+ d.getDate());
    }
    function changeFonts(){
        $('#dateTask').click(function (e) {
            $('#inputTask').show();
        });
        $('.fa-circle').click(function () {
            $(this).removeClass();
            $(this).addClass('fa fa-check-circle');
            $(this).hide('slow');
            $('.completedTask').submit();
        });
        $('.fa-plus-circle').click(function () {
            $('#addtask').attr('style', 'display: none');
            $('#newTask').show();
        });
    }
</script>
</body>
</html>