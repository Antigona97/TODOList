<?php include_once "nav.view.php" ?>
<!-- Page content -->
<div id="editor">
    <div id="agenda-view">
        <?php foreach ($tasks as $task) :
            if ($task->taskId === $_GET['taskId']){?>
        <form method="post" action="/updateTask?taskId=<?= $task->taskId; ?>">
            <div class="row">
                <h4><?= $task->taskName; ?></h4>
                <button class="ui-icon ui-icon-trash" onclick="return confirm('Are you sure you want to delete this item')" name="action" value="Delete"></button>
            </div>
            <br/>
            <textarea class="form-control" name="description" rows="16"><?= $task->description; ?></textarea> <br/>
            <button type="submit" class="btn btn-outline-dark my-2 my-sm-0" name="action" value="Save">Save</button>
        </form><?php } endforeach;?>
    </div>
</div>
</div>
<script>
</script>
</body>
</html>