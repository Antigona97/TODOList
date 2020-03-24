<?php include_once "nav.view.php" ?>
<!-- Page content -->
<div id="editor">
    <div id="agenda-view">
        <form method="post" action="/saveTask?taskName=<?=$_GET['task']?>">
            <div class="row">
                <h4><?= $_GET['task']; ?></h4>
                <button class="ui-icon ui-icon-pencil"  type="submit" name="editTask"></button>
                <button class="ui-icon ui-icon-trash" type="submit" name="deleteTask"></button>
            </div>
            <br/>
            <textarea class="form-control" name="description" rows="16"></textarea> <br/>
            <button type="submit" class="btn btn-outline-dark my-2 my-sm-0">Save</button>
        </form>
    </div>
</div>
</div>
<script>
    $(document).ready(function () {
    });
</script>
</body>
</html>