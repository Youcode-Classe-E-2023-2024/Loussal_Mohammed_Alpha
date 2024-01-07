<?php require APPROOT . '/views/inc/header.php'; ?>
    <main>
        <a href="<?php echo URLROOT; ?>/manageUsers/index" class="flex items-center gap-1 bg-gray-200 p-2 rounded-md w-20 ">
            <ion-icon name="play-back"></ion-icon>
            <div>
                BACK 
            </div>
        </a>

        <div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-xl">
            <h2 class="text-2xl font-semibold mb-4">Edit User <?php echo $data['userId']; ?></h2>
            <p class="text-gray-600 mb-6">Edit User with this form</p>
    
            <form id="edit_user_form" action="<?php echo URLROOT; ?>/manageUsers/editUser/<?php echo $data['userId']; ?>" method="post">
                <div class="mb-4">
                    <label for="username" class="block text-gray-600">username: *</label>
                    <input type="text" name="username" value="<?php echo $data['username'];?>" 
                        class="mt-1 p-2 w-full border rounded-md">
                    <span class="text-red-500"> <?php echo $data['username_err']; ?> </span>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-600">email: *</label>
                    <input type="text" name="email" value="<?php echo $data['email'];?>" 
                        class="mt-1 p-2 w-full border rounded-md">
                    <span class="text-red-500"> <?php echo $data['email_err']; ?> </span>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-600">phone: *</label>
                    <input type="text" name="phone" value="<?php echo $data['phone'];?>" 
                        class="mt-1 p-2 w-full border rounded-md">
                    <span class="text-red-500"> <?php echo $data['phone_err']; ?> </span>
                </div>
                <input type="submit" value="Submit" class="bg-green-500 rounded-md p-2 text-white cursor-pointer font-bold">
            </form>
        </div>
    </main>

<?php require APPROOT . '/views/inc/footer.php'; ?>