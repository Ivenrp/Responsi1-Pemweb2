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
            <h2 class="font-semibold text-xl text-gray-800">Daftar Buku</h2>
            <a href="<?php echo e(route('books.create')); ?>"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                + Tambah Buku
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

            <div class="bg-white shadow-sm sm:rounded-lg p-4 mb-4">
                <form action="<?php echo e(route('books.index')); ?>" method="GET" class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm mb-1">Cari</label>
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                               placeholder="Judul / Penulis / ISBN"
                               class="w-full border-gray-300 rounded focus:border-indigo-500 text-sm">
                    </div>
                    <div class="min-w-[180px]">
                        <label class="block text-sm mb-1">Kategori</label>
                        <select name="category_id" class="w-full border-gray-300 rounded focus:border-indigo-500 text-sm">
                            <option value="">-- Semua --</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>" <?php if(request('category_id') == $cat->id): echo 'selected'; endif; ?>>
                                    <?php echo e($cat->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                        Filter
                    </button>
                    <?php if(request('search') || request('category_id')): ?>
                        <a href="<?php echo e(route('books.index')); ?>"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-sm">
                            Reset
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden flex flex-col">
                        <div class="aspect-[3/4] bg-gray-100 flex items-center justify-center overflow-hidden">
                            <?php if($book->cover): ?>
                                <img src="<?php echo e(asset('storage/' . $book->cover)); ?>"
                                     alt="<?php echo e($book->title); ?>"
                                     class="w-full h-kfull object-cover">
                            <?php else: ?>
                                <div class="text-gray-400 text-sm">No Cover</div>
                            <?php endif; ?>
                        </div>

                        <div class="p-4 flex-1 flex flex-col">
                            <h3 class="font-semibold text-gray-800 line-clamp-2"><?php echo e($book->title); ?></h3>
                            <p class="text-sm text-gray-500 mt-1"><?php echo e($book->author); ?></p>
                            <p class="text-xs text-gray-400 mt-1">
                                <?php echo e($book->category->name ?? '-'); ?> •  <?php echo e($book->year ?? '-'); ?>

                            </p>

                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-xs px-2 py-1 rounded
                                    <?php echo e($book->availableStock() > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>">
                                    Stok: <?php echo e($book->availableStock()); ?> / <?php echo e($book->stock); ?>

                                </span>
                            </div>

                            <div class="mt-4 pt-3 border-t flex justify-between items-center text-sm">
                                <a href="<?php echo e(route('books.show', $book)); ?>"
                                   class="text-gray-600 hover:underline">Detail</a>
                                <div class="space-x-2">
                                    <a href="<?php echo e(route('books.edit', $book)); ?>"
                                       class="text-indigo-600 hover:underline">Edit</a>
                                    <form action="<?php echo e(route('books.destroy', $book)); ?>"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Yakin hapus?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full bg-white shadow-sm sm:rounded-lg p-8 text-center text-gray-500">
                        Belum ada buku. <a href="<?php echo e(route('books.create')); ?>" class="text-indigo-600 hover:underline">Tambah sekarang</a>.
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-6"><?php echo e($books->links()); ?></div>
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
<?php endif; ?><?php /**PATH D:\Bank-Materi-Kuliah\S1\Semester-5\Praktikum Pemweb\Responsi 1\pustakaku\resources\views/books/index.blade.php ENDPATH**/ ?>