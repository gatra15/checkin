@extends('layouts.app')

@section('content')
    <div class="container" style="height: 100vh;">
        <div class="row justify-content-center align-items-center" style="height: 100%;">
            <div class="col-md-5">
                <div class="card" id='card1'>
                    <div class="card-header">
                        <h5 class="card-title text-center">HUT DAPENBUN KE-48</h5>
                    </div>
                    <div class="card-body d-flex align-items-center">
                        <img src="{{ asset('img/logo_dapenbun.png') }}" class="me-4" style="max-width: 150px;"
                            alt="Logo">

                        <form action="{{ route('checkin') }}" method="POST" class="w-100">
                            @csrf
                            <div class="row">
                                <div class="col-md-11">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        placeholder="Masukkan NIK" value="{{ old('nik') }}">
                                    @error('nik')
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: 'Oops...',
                                                    text: '{{ $message }}'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        fetch('/session', {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/json',
                                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                                },
                                                                body: JSON.stringify({
                                                                    // Data yang ingin Anda kirim dalam permintaan POST
                                                                    nik: document.getElementById('nik').value,
                                                                })
                                                            })
                                                            .then(response => {
                                                                // Mendapatkan konten dari respons
                                                                return response.text(); // Ubah ke response.json() jika respons adalah JSON
                                                            })
                                                            .then(data => {
                                                                const newDiv = document.createElement('div');
                                                                newDiv.classList.add('container'); // Menambahkan class 'container' pada div

                                                                const newText = document.createElement('p');
                                                                newText.classList.add(
                                                                'text-danger'); // Menambahkan class 'text-red' pada elemen <p>
                                                                newText.textContent =
                                                                data; // Tambahkan konten ke dalam elemen <p>

                                                                newDiv.appendChild(newText); // Menambahkan elemen <p> ke dalam div

                                                                const card1 = document.getElementById('card1');
                                                                card1.insertAdjacentElement('afterend', newDiv);
                                                            })
                                                            .catch(error => {
                                                                console.error('Error:', error);
                                                            });
                                                    }
                                                })
                                            });
                                        </script>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-11">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukkan Nama" value="{{ old('name') }}">
                                    @error('name')
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: 'Oops...',
                                                    text: '{{ $message }}',
                                                    confirmButtonText: 'OK',
                                                })
                                            });
                                        </script>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="tz" id="tz" value="">
                            <div class="mt-3">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-success">Check In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if (session('data'))
                    <div class="container">
                        <p class='text-danger' id='err'>{{ session('data') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
        document.getElementById("tz").value = tz;
    });
</script>
