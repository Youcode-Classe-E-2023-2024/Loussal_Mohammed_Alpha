<?php require APPROOT . '/views/inc/header.php'; ?>

    <main id="add_post_section" class="flex flex-col">
        <a href="<?php echo URLROOT; ?>/managePosts/index" class="flex items-center gap-1 bg-gray-200 p-2 rounded-md w-20 ">
            <ion-icon name="play-back"></ion-icon>
            <div>
                BACK 
            </div>
        </a>
        <section>
            <div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-xl">
                <h2 class="text-2xl font-semibold mb-4">Add Post</h2>
                <p class="text-gray-600 mb-6">Create a post with this form</p>
        
                <form id="add_post_form" action="<?php echo URLROOT; ?>/managePosts/addPost" method="post">
                    <div id="apsection">
                        <div class="mb-4">
                            <label for="title" class="block text-gray-600">Title: *</label>
                            <input id="title_input" type="text" name="title" class="mt-1 p-2 w-full border rounded-md" required>
                            <span class="text-red-500"> <?php echo $data['title_err']; ?> </span>
                        </div>
                        <div class="mb-4">
                            <label for="body" class="block text-gray-600">Body: *</label>
                            <textarea id="body_input" name="body"
                                class="mt-1 p-2 w-full border rounded-md" required></textarea>
                            <span class="text-red-500"> <?php echo $data['body_err']; ?> </span>
                        </div>
                    </div>
                    <input type="submit" value="Submit" class="bg-green-500 rounded-md p-2 text-white cursor-pointer font-bold">
                    <button id="add_button" class="bg-orange-500 rounded-md p-2 text-white cursor-pointer font-bold">Add more</button>
                </form>
            </div>
        </section>
    </main>

<?php require APPROOT . '/views/inc/footer.php'; ?>