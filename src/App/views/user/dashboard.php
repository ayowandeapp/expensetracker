<?php include $this->resolve("includes/_header.php"); ?>

<!-- Start Main Content Area -->
<section class="container mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
    <div class="flex items-center justify-between border-b border-gray-200 pb-4">
        <h4 class="font-medium">Google Calendar display Nigeria's public holidays </h4>
    </div>
    <!-- Transaction List -->
    <table class="table-auto min-w-full divide-y divide-gray-300 mt-6">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-4 text-left text-sm font-semibold text-gray-900">
                    Name
                </th>
                <th class="p-4 text-left text-sm font-semibold text-gray-900">
                    Date
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($holidays as $holiday) : ?>
                <tr>
                    <td class="p-4 text-sm text-gray-600"><?php echo e($holiday['name']); ?></td>

                    <!-- Date -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($holiday['date']); ?></td>

                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>
<!-- End Main Content Area -->

<?php include $this->resolve("includes/_footer.php"); ?>