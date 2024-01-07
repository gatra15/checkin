@extends('layouts.app')

@section('content')
    <div class="container" style="height: 100vh;">
        <div class="row justify-content-center align-items-center" style="height: 100%;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">HUT DAPENBUN KE-48</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <img src="{{ asset('img/logo_dapenbun.png') }}" class="me-4" style="max-width: 100px;"
                            alt="Logo">


                        <form class="w-100" id="myForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-11">
                                    <p class="fs-4">Welcome! {{ $user->name }}</p>
                                </div>
                            </div>
                            <div class="mt-1">
                                <div class="col-auto">
                                    <p class="fs-6">Waktu Check in : {{ $user->checkin_human }}</p>
                                    <button type="submit" class="btn btn-danger">Check Out</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menangkap event submit form
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah default behavior submit form

            checkIn();
        });

        // Fungsi yang akan dipanggil saat form disubmit
        function checkIn() {
            fetch('/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    // Mendapatkan konten dari respons
                    return response.text(); // Ubah ke response.json() jika respons adalah JSON
                })
                .then(data => {
                    Swal.fire({
                        icon: 'info',
                        text: data,
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location.href = '/';
                        }
                    })
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
</script>
