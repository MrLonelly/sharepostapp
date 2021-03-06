<?php require APPROOT . '/views/include/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts/show/<?php echo $data['id']; ?>" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Edit post</h2>
    <p>Edit a post with this form</p>
    <form action="/posts/edit/<?php echo $data['id']; ?>" method="post">

        <div class="form-group">
            <label for="title">Title* : </label>
            <input class="form-control form-control-lg <?php if(!empty($data['errors']['post_title']))
            {
                echo 'is-invalid';
            }?>" type="text" name="post_title" value="<?php echo $data['post_title']; ?>">
            <span class="invalid-feedback"><?php echo $data['errors']['post_title']; ?></span>
        </div>

        <div class="form-group">
            <label for="post_body">Post body* : </label>
            <textarea class="form-control form-control-lg <?php if(!empty($data['errors']['post_body']))
            {
                echo 'is-invalid';
            }?>" name="post_body" value="<?php echo $data['post_body']; ?>"><?php echo $data['post_body']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['errors']['post_body']; ?></span>
        </div>
        <input type="submit" class="btn btn-success" value="Edit">
    </form>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>