<?php include_once "nav.view.php" ?>
<!-- Page content -->
<div class="content">
    <form method="post">
        <div class="row">
            <i class="fa fa-circle"></i>
        </div>
    </form>
</div>
<script>
    $('.fa-circle').click(function () {
        $(this).removeClass();
        $(this).addClass('fa fa-check-circle');
        $(this).hide('slow');
    });
</script>
</body>
</html>