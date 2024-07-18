<style>
    .star {
        cursor: pointer;
        transition: color 0.3s;
    }

    .star:hover {
        color: #fbbf24;
    }

    .star.selected {
        color: #fbbf24;
    }
</style>
<!-- Main modal -->
<div id="defaultModal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-hidden   fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen">

    <div class="relative p-4 w-full max-w-2xl overflow-y-auto" style="height: 100%">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 max-h-[80vh]">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Beri komentar produk kami
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="defaultModal-{{ $item->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="uploadForm" action="{{ route('review') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @foreach ($item->orderItems as $orderItem)
                    <div class="font-bold text-xl">{{ $orderItem->product->nama_produk }}</div>
                    <input type="hidden" name="product_id[]" value="{{ $orderItem->product->id }}">

                    <!-- Star Rating (Example with Font Awesome) -->
                    <div class="flex items-center space-x-1 pt-3 text-xl">
                        <i class="star fas fa-star w-10 h-10"></i>
                        <i class="star fas fa-star w-10 h-10"></i>
                        <i class="star fas fa-star w-10 h-10"></i>
                        <i class="star fas fa-star w-10 h-10"></i>
                        <i class="star fas fa-star w-10 h-10"></i>
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input">Upload file</label>
                        <input name="uploaded_file" id="file_input" type="file" accept=".svg, .png, .jpg, .gif"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or
                            GIF (MAX. 800x400px).</p>
                    </div>

                    <!-- Comment -->
                    <div
                        class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                            <label for="comment" class="sr-only">Your comment</label>
                            <textarea id="comment" rows="4" name="comment"
                                class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                placeholder="Write a comment..." required></textarea>
                        </div>
                        <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                            <button type="submit"
                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">Post
                                comment</button>
                        </div>
                    </div>
                @endforeach
            </form>

        </div>
    </div>

</div>
<script>
    const stars = document.querySelectorAll('.star');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.add('selected');
                } else {
                    s.classList.remove('selected');
                }
            });
        });
    });
</script>
