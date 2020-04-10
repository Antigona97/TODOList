<?php
if(isset($_SESSION['account'])) {
    include_once "nav.view.php"; ?>
    <!-- Page content -->
    <div id="editor">
        <div id="agenda-view">
            <h2 id="todaysDate"></h2>
            <form class="form-inline" method="post" action="/tasks" id="newTask" style="display: none">
                <div class="row">
                    <input type="text" name="taskName" class="form-control mr-sm-2" placeholder="e.g. Conference meeting">
                    <select  class="form-control mr-sm-2" name="priority">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                    <input id="dateTask" class="btn btn-outline-dark my-2 my-sm-0" name="inputDate" value="<?php echo $date; ?>">
                    <button type="submit" class="btn btn-outline-dark my-2 my-sm-0">Add task</button>
                </div>
            </form> <br/>
            <form method="post">
                <div class="row" id="addtask" style="">
                    <h4><i class="fa fa-plus-circle"></i>Add task</h4>
                </div>
                <div>
                    <?php if (is_array($tasks) || is_object($tasks)) {
                        foreach ($tasks as $task) :?>
                            <div id="<?=$task->taskId?>"  class="ui-widget-content" style="border: none">
                                <i class="fa fa-circle"></i>
                                <a id="<?=$task->taskId?>" class="<?=$task->priority; ?>" type="submit" href="/openTask?taskId=<?= $task->taskId; ?>">
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
    <script src="app/public/scripts/jquery.js"></script>
    <?php
}
?>
</body>
</html>