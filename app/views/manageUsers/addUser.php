<?php require APPROOT . '/views/inc/header.php'; ?>

    <main id="add_user_section" class="flex flex-col">
        <a href="<?php echo URLROOT; ?>/manageUsers/index" class="flex items-center gap-1 bg-gray-200 p-2 rounded-md w-20 ">
            <ion-icon name="play-back"></ion-icon>
            <div>
                BACK 
            </div>
        </a>
        <section>
            <div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-xl">
                <h2 class="text-2xl font-semibold mb-4">Add User</h2>
                <p class="text-gray-600 mb-6">Add a user with this form</p>

                <form id="add_user_form" action="<?php echo URLROOT; ?>/manageUsers/addUser" method="post">
                    <div id="apsection">
                        <div class="mb-4">
                            <label for="username" class="block text-gray-600">username: *</label>
                            <input type="text" name="username" value="<?php echo $data['username'];?>" 
                                class="mt-1 p-2 w-full border rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-600">email: *</label>
                            <input type="text" name="email" value="<?php echo $data['email'];?>" 
                                class="mt-1 p-2 w-full border rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-600">phone: *</label>
                            <input type="number" name="phone" value="<?php echo $data['phone'];?>" 
                                class="mt-1 p-2 w-full border rounded-md" required>
                        </div>
                    </div>
                    <input type="submit" value="Submit" class="bg-green-500 rounded-md p-2 text-white cursor-pointer font-bold">
                    <button id="add_button" class="bg-orange-500 rounded-md p-2 text-white cursor-pointer font-bold">Add more</button>
                </form>
            </div>
        </section>
    </main>

<?php require APPROOT . '/views/inc/footer.php'; ?>