<div class="main-w3layouts wrapper">
    <div class="main-agileinfo">
        <div class="agileits-top">
            <!-- form -->
            <form method="POST" class="form-class" action="/account/register" id="register">
                <p class="response"></p>
                <input class="text" type="text" name="username" placeholder="Username" required>
                <?php if(isset($_GET['field']) && $_GET['field']==='username'){
                    echo '<p>'.$_GET['message'].'</p>';
                } ?>
                <input class="text email" type="email" name="email" placeholder="Email" required>
                <?php if(isset($_GET['field']) && $_GET['field']==='email'){
                    echo '<p>'.$_GET['message'].'</p>';
                } ?>
                <input class="text" type="password" name="password" placeholder="Password" required>
                <input class="text w3lpass" type="password" name="cpassword" placeholder="Confirm Password" required>
                <div class="wthree-text">
                    <label class="anim">
                        <input type="checkbox" class="checkbox" required="">
                        <span>I Agree To The Terms & Conditions</span>
                    </label>
                    <div class="clear"> </div>
                    <?php if(isset($_GET['field']) && $_GET['field']==='button'){
                        echo '<p>'.$_GET['message'].'</p>';
                    } ?>
                </div>
                <button name="button" type="submit">Register</button>
                <p class="message">Already have an Account? <a href="/"> Login Now!</a></p>
            </form>
        </div>
    </div>
</div>