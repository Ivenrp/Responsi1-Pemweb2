<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Daftar Peminjaman</h2>
            <a href="<?php echo e(route('loans.create')); ?>"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                + Catat Peminjaman
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php if(session('success')): ?>
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <div class="bg-white shadow-sm sm:rounded-lg p-4 mb-4">
                <form action="<?php echo e(route('loans.index')); ?>" method="GET" class="flex flex-wrap gap-3 items-end">
                    <div class="min-w-[180px]">
                        <label class="block text-sm mb-1">Status</label>
                        <select name="status" class="w-full border-gray-300 rounded focus:border-indigo-500 text-sm">
                            <option value="">-- Semua --</option>
                            <option value="borrowed" <?php if(request('status') === 'borrowed'): echo 'selected'; endif; ?>>dipinjam</option>
                            <option value="returned" <?php if(request('status') === 'returned'): echo 'selected'; endif; ?>>Dikembalikan</option>
                        </select>
                    </div>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                        Filter
                    </button>
                </form>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Anggota</th>
                            <th class="px-4 py-3 text-left">Buku</th>
                            <th class="px-4 py-3 text-left">Tanggal Pinjam</th>
                            <th class="px-4 py-3 text-left">Jatuh Tempo</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Denda</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-4 py-3"><?php echo e($loop->iteration); ?></td>
                                <td class="px-4 py-3 font-medium"><?php echo e($loan->member->name ?? '-'); ?></td>
                                <td class="px-4 py-3"><?php echo e($loan->book->title ?? '-'); ?></td>
                                <td class="px-4 py-3"><?php echo e($loan->loan_date->format('d M Y')); ?></td>
                                <td class="px-4 py-3"><?php echo e($loan->due_date->format('d M Y')); ?></td>
                                <td class="px-4 py-3">
                                    <?php if($loan->status === 'returned'): ?>
                                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Dikembalikan</span>
                                    <?php elseif($loan->isLate()): ?>
                                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Terlambat</span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Dipinjam</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3">
                                    Rp <?php echo e(number_format($loan->fine, 0, ',', '.')); ?>

                                </td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <?php if($loan->status !== 'returned'): ?>
                                        <form action="<?php echo e(route('loans.return', $loan)); ?>"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Kembalikan buku ini?')">
                                            <?php echo csrf_field(); ?>
                                            <button class="text-green-600 hover:underline font-medium">
                                                Kembalikan
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('loans.show', $loan)); ?>"
                                       class="text-gray-600 hover:underline">Detail</a>
                                    <a href="<?php echo e(route('loans.edit', $loan)); ?>"
                                       class="text-indigo-600 hover:underline">Edit</a>
                                    <form action="<?php echo e(route('loans.destroy', $loan)); ?>"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Yakin hapus?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-gray-500">Belum ada peminjaman.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4"><?php echo e($loans->links()); ?></div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\Bank-Materi-Kuliah\S1\Semester-5\Praktikum Pemweb\Responsi 1\pustakaku\resources\views/loans/index.blade.php ENDPATH**/ ?>