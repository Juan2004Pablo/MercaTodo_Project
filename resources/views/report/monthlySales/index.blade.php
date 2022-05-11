@extends('template.admin')

@section('title','Monthly sales report')

@section('breadcrumb')
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow-sn text-center flex-col ml-auto m-6">

        <div class="bg-dark rounded-lg text-white flex justify-content-center items-center ml-auto">

            <!-- icono de pfd -->
            <span class="display-4 font-italic"> Download report </span>

        </div>

        <form class="bg-secondary rounded-lg shadow-sn p-4 text-center flex flex-col gap-5" action="{{ route('monthlySales.report.generate') }}" method="post">

            @csrf

            <div class="row justify-content-center">

                <div class="col-md-3">

                    <div class="mt-3 flex flex-col gap-2">

                        <label for="datepicker" class="font-bold nb-1 block"> Inicial Date </label>

                        <div class="relative">

                        <input value="{{$initialDate}}" name="initial-date" type="date" required class= "w-full pl-4 py-3 leading-none-rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-center" placeholder="Select date">

                        @error('initial-date') {{ $message }} @enderror

                    </div>

                    <div class="mt-3 flex flex-col gap-2">

                        <label for="datepicker" class="font-bold nb-1 block"> End Date </label>

                        <div class="relative">

                        <input value="{{$initialDate}}" name="end-date" type="date" required class= "w-full pl-4 py-3 leading-none-rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-center" placeholder="Select date">

                        @error('end-date') {{ $message }} @enderror

                    </div>
                
                </div>

                <div class="mt-3 flex flex-col gap-2">

                    <br>
                    <button type="submit" class="rounded px-3 py-2 bg-danger text-white"> Download </button>
                
                </div>
            
            </div>

        </form>

    </div>
@endsection
