<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="text-center max-w-md mx-auto bg-white p-8 shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold mb-4"><?php echo $data['title']; ?></h1>
        <p class="text-gray-700"><?php echo $data['description'] ?></p>
        <p>Version: <strong><?php echo APPVERSION ?></strong></p>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>