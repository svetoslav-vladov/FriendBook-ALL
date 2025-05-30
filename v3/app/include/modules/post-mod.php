<div data-toggle="modal" data-target="#exampleModalCenter">

    <!-- div to Open the Modal -->
    <div id="post_input_fake">
        <p id="post-panel" class="mb-0">What's on your mind, <?php echo $_SESSION['logged']->getFirstName() . ' ' . $_SESSION['logged']->getLastName();?>?</p>
        <i class="fas fa-pencil-alt"></i>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href="<?php echo URL_ROOT;?>/index/profile">
                    <img class="img-thumbnail img-fluid" src="
                                <?php if(is_null($_SESSION["logged"]->getThumbsProfile()))
                    { echo URL_ROOT . $_SESSION["logged"]->getProfilePic(); } else{ echo URL_ROOT .
                        $_SESSION["logged"]->getThumbsProfile();} ?>"
                         alt="<?php echo $_SESSION['logged']->getFullName();?> profile picture">
                </a>
                <h5 class="mb-0">What's on your mind, <?php echo $_SESSION['logged']->getFirstName() . ' ' . $_SESSION['logged']->getLastName();?>?</h5>
            </div>
            <div class="modal-body">
                <form method="post" class="post_form" action="<?php echo URL_ROOT?>/post/addPost">
                    <textarea class="form-control" rows="5" id="comment" name="desc"></textarea>
                    <input type="submit" class="btn btn-success mb-2" name="add_post" value="POST">
                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="CANCEL">
                </form>
            </div>
        </div>
    </div>
</div>
