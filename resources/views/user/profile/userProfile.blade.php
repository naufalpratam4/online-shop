@extends('welcome')
@section('content')
    <div class="mt-36 mx-auto w-8/12 font-bold text-3xl pb-2">User Profile</div>
    <div class="flex mx-auto pt-2  w-8/12 border p-4 shadow-lg rounded-lg ">
        <div class="grid md:grid-cols-3  w-full pt-2">
            <div class=" p-3 rounded-lg border-2  md:ms-20 w-8/12">
                <div>
                    <img id="profile-image" src="https://picsum.photos/seed/picsum/300/300" width="200" height="200"
                        alt="">
                    <div class="relative mt-2">
                        <input type="file" name="foto_profil" id="file-upload" class="hidden" accept="image/*" />
                        <label for="file-upload"
                            class="border px-4 py-2 rounded-lg w-full cursor-pointer inline-flex items-center justify-center">
                            <span>Edit Foto</span>
                        </label>
                    </div>
                    <script>
                        document.getElementById('file-upload').addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('profile-image').src = e.target.result;
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                    </script>
                </div>

                <p class="text-sm">Ekstensi file yang diperbolehkan:
                    .JPG .JPEG .PNG
                </p>
            </div>

            {{-- kanan --}}
            <div class="col-span-2 rounded-lg p-3 ">
                <div class="font-semibold text-xl mb-3">Ubah Data Diri</div>
                <div class="flex items-center mb-3">
                    <div class="w-40">Nama</div>
                    <div>Nama Lengkap <a href="" class="text-green-500">Edit</a></div>
                </div>
                <div class="flex items-center mb-3">
                    <div class="w-40">Tanggal Lahir</div>
                    <div>Tanggal Lahir <a href="" class="text-green-500">Edit</a></div>
                </div>
                <div class="flex items-center mb-3">
                    <div class="w-40">Jenis Kelamin</div>
                    <div>Jenis Kelamin <a href="" class="text-green-500">Edit</a></div>
                </div>
                <div class="flex items-center mb-3">
                    <div class="w-40">Email</div>
                    <div>Email@gmail.com <a href="" class="text-green-500">Edit</a></div>
                </div>
                <div class="flex items-center mb-3">
                    <div class="w-40">Nomor HP</div>
                    <div>08888 <a href="" class="text-green-500">Edit</a></div>
                </div>
                <div class="flex items-center mb-3">
                    <div class="w-40">Password</div>
                    <div> <a href="" class="text-green-500">Ubah Kata Sandi</a></div>
                </div>

            </div>
        </div>
    </div>
@endsection
