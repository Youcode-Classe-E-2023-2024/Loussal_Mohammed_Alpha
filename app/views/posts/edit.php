<?php require APPROOT . '/views/inc/header.php'; ?>

    <a href="<?php echo URLROOT; ?>/posts/index" class="flex items-center gap-1 bg-gray-200 p-2 rounded-md w-20 ">
        <ion-icon name="play-back"></ion-icon>
        <div>
            Back
        </div>
    </a>
    <div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-xl">
        <h2 class="text-2xl font-semibold mb-4">Edit Post</h2>
        <p class="text-gray-600 mb-6">Create a post with this form</p>

        <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
            <div class="mb-4">
                <label for="title" class="block text-gray-600">Title: *</label>
                <input type="text" name="title" value="<?php echo $data['title'];?>" 
                    class="mt-1 p-2 w-full border rounded-md">
                <span class="text-red-500"> <?php echo $data['title_err']; ?> </span>
            </div>
            <div class="mb-4">
                <label for="body" class="block text-gray-600">Body: *</label>
                <textarea name="body"
                    class="mt-1 p-2 w-full border rounded-md"><?php echo $data['body'];?></textarea>
                <span class="text-red-500"> <?php echo $data['body_err']; ?> </span>
            </div>
            <input type="submit" value="Submit" class="bg-green-500 rounded-md p-2 text-white cursor-pointer font-bold">
        </form>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>