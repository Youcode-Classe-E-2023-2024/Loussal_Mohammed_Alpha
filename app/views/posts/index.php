<?php require APPROOT . '/views/inc/header.php'; ?>
    <section class="flex justify-between px-10 pt-4">
        <div>
            <h1 class="text-2xl font-bold">Posts</h1>
        </div>
        <a href="<?php echo URLROOT; ?>/posts/add" class="flex items-center bg-blue-500 text-white p-2 rounded-md">
            <ion-icon name="pencil-outline"></ion-icon>
            Add post
        </a>
    </section>
    <main class="p-4">
        <?php foreach($data['posts'] as $post): ?>
            <div class="border border-black mb-2 p-2">
                <h1 class="text-2xl"><?php echo $post->title ?></h1>
                <div>Written by <strong><?php echo $post->name ?></strong> on <?php echo $post->postCreatedAt ?></div>
                <p class="bg-gray-200 my-4 p-2"><?php echo $post->body ?></p>
                <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId ?>" class="bg-gray-800 block text-white text-center rounded-sm p-1">More</a>
            </div>
        <?php endforeach; ?>
    </main>
<?php require APPROOT . '/views/inc/footer.php'; ?>