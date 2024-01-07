<?php require APPROOT . '/views/inc/header.php'; ?>

<main id="manageUsers_index" class="p-4">
    <section class="flex justify-between mb-4">
        <div class="text-2xl font-semibold">
            USERS LIST
        </div>
        <a href="<?php echo URLROOT; ?>/ManageUsers/addUser" class="flex items-center bg-blue-500 text-white p-2 rounded-md">
            <ion-icon name="pencil-outline" role="img" class="md:hydrated mr-2"></ion-icon>
            <p>Add user</p>
        </a>
    </section>
    <button id="downloadPdf" class="text-red-500 py-4">Download displayed list as PDF</button>

    <table id="usersTable" class="min-w-full bg-white border border-gray-300 shadow-md rounded-md overflow-hidden">
        <thead class="bg-gray-200 text-gray-700">
            <tr>
                <th class="py-2 px-4">Id</th>
                <th class="py-2 px-4">username</th>
                <th class="py-2 px-4">email</th>
                <th class="py-2 px-4">phone</th>
                <th class="py-2 px-4">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>