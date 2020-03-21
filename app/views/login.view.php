<div class="container">
    <h1 class="mt-4 mb-3">LOGIN</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/account/login" method="post">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Username:</label>
                        <input type="text" class="form-control" name="username" required>
                        <?php if(isset($_GET['field']) && $_GET['field']==='username'){
                            echo '<p>'.$_GET['message'].'</p>';
                        } ?>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" required>
                        <?php if(isset($_GET['field']) && $_GET['field']==='password'){
                            echo '<p>'.$_GET['message'].'</p>';
                        } ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <p class="message">Not registered? <a href="/register">Create an account</a></p>
            </form>
        </div>
    </div>
</div>