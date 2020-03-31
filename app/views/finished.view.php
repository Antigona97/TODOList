<?php
if(isset($_SESSION['account'])) {
    include_once "nav.view.php"; ?>
    <!-- Page content -->
    <div id="editor">
        <div id="agenda-view">
            <form method="post" action="/todayTasks">
                <h1>Completed Tasks</h1><br/>
                <div>
                    <?php if (is_array($tasks) || is_object($tasks)) {
                        foreach ($tasks as $task) :?>
                            <div id="<?=$task->taskId?>"  class="ui-widget-content">
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
   </script>
    <?php
}
?>
</body>
</html>