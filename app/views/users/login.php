<?php require APPROOT . '/views/inc/header.php'; ?>

    <div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-xl">
        <h2 class="text-2xl font-semibold mb-4">Create An Account</h2>
        <p class="text-gray-600 mb-6">Please fill out this form to register with us</p>

        <form action="<?php echo URLROOT; ?>/users/login" method="post">
            <div class="mb-4">
                <label for="email" class="block text-gray-600">Email: *</label>
                <input type="email" name="email" value="<?php echo $data['email'];?>" 
                    class="mt-1 p-2 w-full border rounded-md">
                <span class="text-red-500"> <?php echo $data['email_err']; ?> </span>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-600">Password: *</label>
                <input type="password" name="password" value="<?php echo $data['password'];?>" 
                    class="mt-1 p-2 w-full border rounded-md">
                <span class="text-red-500"> <?php echo $data['password_err']; ?> </span>
            </div>

            <button type="submit" value="Login"
                class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                Login
            </button>
            <a href="<?php echo URLROOT; ?>/users/register"
                class="block text-center mt-4 text-blue-500 hover:underline">No account? Register
            </a>
        </form>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>