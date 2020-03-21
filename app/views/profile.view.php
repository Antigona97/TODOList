<?php include_once "nav.php" ?>

<div class="content">
    <h1>Edit Profile</h1>
    <div class="row">
        <!-- edit form column -->
        <div class="col-md-9 personal-info">
            <h3>Personal info</h3>
            <form class="form-horizontal" name="updateProfile" id="profileForm" method="POST">
                <p class="response"></p>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" name="email" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Username:</label>
                    <div class="col-md-8">
                        <input class="form-control" name="username" type="text" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Current password:</label>
                    <div class="col-md-8">
                        <input class="form-control" name="currentPassword" type="password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">New password:</label>
                    <div class="col-md-8">
                        <input class="form-control" name="newPassword" type="password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Confirm password:</label>
                    <div class="col-md-8">
                        <input class="form-control" name="confirmPassword" type="password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input type="submit" id="submitButton" class="btn btn-success" value="Save Changes">
                        <span></span>
                        <input type="reset" class="btn btn-default" value="Cancel">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
