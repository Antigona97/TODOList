<?php include_once "nav.view.php" ?>
<!-- Page content -->
<div id="editor">
    <div id="agenda-view">
        <?php foreach ($tasks as $task) :
            if ($task->taskId == $_GET['task']){?>
            <form method="post" action="/saveTask?taskId=<?= $task->taskId; ?>">
                <div class="row">
                    <h4><?= $task->taskName; ?></h4>
                    <button class="ui-icon ui-icon-pencil" type="submit" id="editTask"></button>
                    <button class="ui-icon ui-icon-trash" type="submit" id="deleteTask"></button>
                </div>
                <br/>
                <textarea class="form-control" name="description" rows="16"><?= $task->description; ?></textarea> <br/>
                <button type="submit" class="btn btn-outline-dark my-2 my-sm-0">Save</button>
                </form><?php } endforeach;?>
        <div class="dialogBoxes" id="editName" title="Edit Image" class="ui-icon ui-icon-circlesmall-close" >
            <fieldset>
                <input type="text" class="text ui-widget-content ui-corner-all" id="changeName"/>
                <button id="save">Save</button>
            </fieldset>
        </div>
    </div>
</div>
</div>
<script>

</script>
</body>
</html>