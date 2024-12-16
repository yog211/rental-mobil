@extends('layouts.main')
@section('title', 'Home Page')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Rental Mobil</h4>
              
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)"></a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0)"></a>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        @foreach ($mobils as $mobil)
        <div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6">
            <div class="card mb-3">
                <img
                    class="card-img-top img-fluid"
                    src="{{ asset('/storage/' . $mobil->foto) }}"
                    alt="Card image cap"
                />
                <div class="card-header">
                    <h5 class="card-title">{{ $mobil->merek }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-dark">
                        Alamat: {{ $mobil->rentalMobil->alamat }}
                    </p>
                    <p class="card-text text-dark">
                        Kontak Owner: {{ $mobil->rentalMobil->no_hp }}
                    </p>
                    <a href="#" class="btn btn-primary float-right">Check</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
