<nav class="bg-gray-800 p-4">
    <a href="<?php echo URLROOT; ?>" class="text-white text-lg font-bold">Logo</a>

    <div class="flex">
        <ul class="flex space-x-4">
            <li>
                <a href="<?php echo URLROOT; ?>/pages/index" class="text-white hover:text-gray-300">Home</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/pages/about" class="text-white hover:text-gray-300">About</a>
            </li>
        </ul>

        <!-- if the user have been login -->
        <?php if(isset($_SESSION['user_id'])): ?>
            <ul class="flex space-x-4 ml-4">
                <li>
                    <a href="<?php echo URLROOT; ?>/dashboard/index" class="text-white hover:text-gray-300">Dashboard</a>
                </li>
            </ul>
            <ul class="flex space-x-4 ml-4">
                <li>
                    <a href="<?php echo URLROOT; ?>/users/logout" class="text-white hover:text-gray-300">Logout</a>
                </li>
            </ul>
        <?php endif ?>

        <!-- if not -->
        <?php if(!isset($_SESSION['user_id'])):?>
            <ul class="flex space-x-4 ml-4">
                <li>
                    <a href="<?php echo URLROOT; ?>/users/register" class="text-white hover:text-gray-300">Register</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/users/login" class="text-white hover:text-gray-300">Login</a>
                </li>
            </ul>
        <?php endif ?>
    </div>
</nav>
