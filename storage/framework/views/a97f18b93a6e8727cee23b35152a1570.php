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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500">
                    <div class="text-sm text-gray-500">Total Buku</div>
                    <div class="text-3xl font-bold text-gray-800"><?php echo e($stats['books']); ?></div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-sm text-gray-500">Total Anggota</div>
                    <div class="text-3xl font-bold text-gray-800"><?php echo e($stats['members']); ?></div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-sm text-gray-500">Peminjaman Aktif</div>
                    <div class="text-3xl font-bold text-gray-800"><?php echo e($stats['active_loans']); ?></div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-red-500">
                    <div class="text-sm text-gray-500">Terlambat</div>
                    <div class="text-3xl font-bold text-gray-800"><?php echo e($stats['late_loans']); ?></div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Peminjaman Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="px-4 py-2 text-left">Anggota</th>
                                <th class="px-4 py-2 text-left">Buku</th>
                                <th class="px-4 py-2 text-left">Tgl Pinjam</th>
                                <th class="px-4 py-2 text-left">Jatuh Tempo</th>
                                <th class="px-4 py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            <?php $__empty_1 = true; $__currentLoopData = $recentLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="px-4 py-2"><?php echo e($loan->member->name); ?></td>
                                    <td class="px-4 py-2"><?php echo e($loan->book->title); ?></td>
                                    <td class="px-4 py-2"><?php echo e($loan->loan_date->format('d M Y')); ?></td>
                                    <td class="px-4 py-2"><?php echo e($loan->due_date->format('d M Y')); ?></td>
                                    <td class="px-4 py-2">
                                        <?php if($loan->status === 'returned'): ?>
                                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Dikembalikan</span>
                                        <?php elseif($loan->isLate()): ?>
                                            <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Terlambat</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Dipinjam</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada data.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
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
<?php endif; ?>
<?php /**PATH D:\Bank-Materi-Kuliah\S1\Semester-5\Praktikum Pemweb\Responsi 1\pustakaku\resources\views/dashboard.blade.php ENDPATH**/ ?>