<?php include $this->resolve("includes/_header.php"); ?>

<section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
    <form method="POST" class="grid grid-cols-1 gap-6">
        <?php include $this->resolve("includes/_csrf.php"); ?>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="message" id="successMessage">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php } ?>

        <label class="block">
            <span class="text-gray-700">Username</span>
            <input value="<?php echo e($user_detail['username']); ?>" name="username" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />

            <?php if (array_key_exists('username', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500">
                    <?php echo $errors['username'][0]; ?>
                </div>
            <?php endif; ?>
        </label>
        <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
            Submit
        </button>
    </form>
</section>

<script>
    // Remove the message after 5 seconds
    setTimeout(function() {
        var messageElement = document.getElementById('successMessage');
        if (messageElement) {
            messageElement.style.display = 'none';
        }
    }, 5000);
</script>
<?php include $this->resolve("includes/_footer.php"); ?>