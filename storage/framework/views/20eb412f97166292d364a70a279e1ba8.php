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
        <h2 class="font-semibold text-xl text-gray-800">Edit Buku</h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="<?php echo e(route('books.update', $book)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

                    <?php if($book->cover): ?>
                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Cover Saat Ini</label>
                            <img src="<?php echo e(asset('storage/' . $book->cover)); ?>"
                                 alt="<?php echo e($book->title); ?>"
                                 class="w-32 h-44 object-cover rounded shadow">
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block mb-1 font-medium">Judul Buku *</label>
                            <input type="text" name="title" value="<?php echo e(old('title', $book->title)); ?>"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Penulis *</label>
                            <input type="text" name="author" value="<?php echo e(old('author', $book->author)); ?>"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Penerbit</label>
                            <input type="text" name="publisher" value="<?php echo e(old('publisher', $book->publisher)); ?>"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">ISBN *</label>
                            <input type="text" name="isbn" value="<?php echo e(old('isbn', $book->isbn)); ?>"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Tahun</label>
                            <input type="number" name="year" value="<?php echo e(old('year', $book->year)); ?>"
                                   min="1900" max="<?php echo e(date('Y')); ?>"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Kategori *</label>
                            <select name="category_id"
                                    class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->id); ?>"
                                            <?php if(old('category_id', $book->category_id) == $cat->id): echo 'selected'; endif; ?>>
                                        <?php echo e($cat->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Stok *</label>
                            <input type="number" name="stock" value="<?php echo e(old('stock', $book->stock)); ?>" min="0"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-1 font-medium">Ganti Cover (opsional)</label>
                            <input type="file" name="cover" accept="image/*"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong kalau tidak ganti cover.</p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-1 font-medium">Deskripsi</label>
                            <textarea name="description" rows="4"
                                      class="w-full border-gray-300 rounded focus:border-indigo-500"><?php echo e(old('description', $book->description)); ?></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="<?php echo e(route('books.index')); ?>"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Update
                        </button>
                    </div>
                </form>
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
<?php endif; ?><?php /**PATH D:\Bank-Materi-Kuliah\S1\Semester-5\Praktikum Pemweb\Responsi 1\pustakaku\resources\views/books/edit.blade.php ENDPATH**/ ?>