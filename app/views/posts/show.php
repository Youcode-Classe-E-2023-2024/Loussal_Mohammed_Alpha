<?php require APPROOT . '/views/inc/header.php'; ?>
    <a href="<?php echo URLROOT; ?>/posts/index" class="flex items-center gap-1 bg-gray-200 p-2 rounded-md w-20 ">
        <ion-icon name="play-back"></ion-icon>
        <div>
            Back
        </div>
    </a>
    <br>
    <h1><?php echo $data['post']->title; ?></h1>
    <div>
        Writen by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at ?>
    </div>
    <p><?php echo $data['post']->body ?></p>

    <?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
        <hr>
        <section class="flex gap-2">
            <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id ?>" class="bg-gray-900 rounded-md px-2 py-1 text-white">Edit</a>
    
            <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id ?>" method="post">
                <input type="submit" value="Delete" class="bg-red-500 text-white px-2 py-1 rounded-md cursor-pointer">
            </form>
        </section>
    <?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>