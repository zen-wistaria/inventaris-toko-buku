const buttonAddBuku = document.querySelectorAll("#btn-edit-buku");
buttonAddBuku.forEach((btn) => {
    btn.addEventListener("click", () => {
        bukuId = btn.dataset.bukuId;
        editBuku = document.querySelector(".form-edit-buku");

        fetch("/books/" + bukuId)
            .then((response) => response.json())
            .then((data) => {
                editBuku.innerHTML = formEditBuku(data);
            });
    });

    function formEditBuku(data) {
        return `<div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Buku</label>
                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="${data.title}" required />
                </div>
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div>
                        <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis</label>
                        <input type="text" name="author" id="author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="${data.author}" required />
                    </div>
                    <div>
                        <label for="publisher" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerbit</label>
                        <input type="text" name="publisher" id="publisher" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="${data.publisher}" required />
                    </div>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                        <input type="text" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="${data.price}" required />
                    </div>
                    <div>
                        <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Rilis</label>
                        <input type="text" name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="${data.year}" required />
                    </div>
                    <input type="hidden" name="id" value="${data.id}">
                </div>`;
    }
});

const buttonAddBukuTransaction = document.querySelector("#add-book");
buttonAddBukuTransaction.addEventListener("click", function () {
    const bookDetails = document.querySelector("#book-details");
    const newDetail = document.querySelector(".book-detail").cloneNode(true);
    bookDetails.appendChild(newDetail);
    console.log(this);
});
