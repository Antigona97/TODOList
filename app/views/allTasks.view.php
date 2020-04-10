<?php
if(isset($_SESSION['account'])) {
    include_once "nav.view.php"; ?>
    <!-- Page content -->
    <div id="editor">
        <div id="agenda-view">
            <h4>All tasks</h4> <br/>
            <form method="post">
                <div>
                    <?php if (is_array($tasks) || is_object($tasks)) {
                        foreach ($tasks as $task) :?>
                            <div id="<?=$task->taskId?>"  class="ui-widget-content" style="border: none">
                                <i class="fa fa-circle"></i>
                                <a id="<?=$task->taskId?>"  type="submit" class="<?=$task->priority; ?>" href="/task?taskId=<?=$task->taskId; ?>"><?= $task->taskName; ?></a>
                            </div> <br/>
                        <?php endforeach;
                    }?>
                </div>
            </form>
        </div>
    </div>
    </div> <script src="app/public/scripts/jquery.js"></script>
    <?php
}
?>
</body>
</html>