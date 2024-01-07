@extends('layouts.app')

@section('content')
    <div class="container" style="height: 100vh;">
        <div class="row justify-content-center align-items-center" style="height: 100%;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">HUT DAPENBUN KE-48</h5>
                    </div>
                    <div class="card-body d-flex align-items-center">
                        <img src="{{ asset('img/logo_dapenbun.png') }}" class="me-4" style="max-width: 100px;"
                            alt="Logo">

                        <form action="{{ route('checkin') }}" method="POST" class="w-100">
                            @csrf
                            <div class="row">
                                <div class="col-md-11">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        placeholder="Masukkan NIK" value="{{ old('nik') }}">
                                    @error('nik')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-11">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukkan Nama" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
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
