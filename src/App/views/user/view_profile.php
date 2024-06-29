<?php include $this->resolve("includes/_header.php"); ?>

<section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
    <form method="POST" class="grid grid-cols-1 gap-6">
        <div class="row">
            <div class="col-md-6">
                <h3>User Details</h3>

            </div>
            <div class="col-md-6" style="text-align: right;">
                <button id="edit_profile" type="button" style="background-color: blue;" class="btn btn-primary btn-small">Edit Profile</button>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Username</td>
                        <td><?php echo $user_detail['username']; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $user_detail['email']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
            Submit
        </button> -->
    </form>
</section>

<script>
    let getId = document.querySelector('#edit_profile');
    getId.addEventListener('click', () => {
        window.location.href = '/profile';
    })
    // Remove the message after 5 seconds
    setTimeout(function() {
        var messageElement = document.getElementById('successMessage');
        if (messageElement) {
            messageElement.style.display = 'none';
        }
    }, 5000);
</script>
<?php include $this->resolve("includes/_footer.php"); ?>