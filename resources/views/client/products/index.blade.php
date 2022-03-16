@extends('layouts.app')

@section('template_title')
    Products
@endsection

@section('content')
    <div class="container mt-5">
        <div id="app">
            <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <img src="https://dev.placetopay.com/web/wp-content/uploads/2020/08/LOGO-P2P-blanco-developers-1.png" class="attachment-0x0 size-0x0" alt="" loading="lazy" style="height: 30px;">
                </div>
            </nav>
        </div>
        <div class="card card-default">
            <div class="card-header">{{ trans('Client.products.titles.products') }}
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <a class="navbar-brand">To list</a>
                                <select class="custom-select" id="limit" name="limit" aria-label="Default select example">
                                    @foreach([10,20,50,100] as $limit)
                                    <option value=" {{ $limit }}" @if(isset($_GET['limit']))
                                        {{($_GET['limit']==$limit)?'select': ''}}@endif>{{ $limit }}</option>
                                    @endforeach
                                </select>
                    
                                <?php
                                if(isset($_GET['page'])){
                                    $pag=$_GET['page'];
                                }else{
                                    $pag=1;
                                }
                                if(isset($_GET['limit'])){
                                    $limit=$_GET['limit'];
                                }else{
                                    $limit=10;
                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-8">
                                <div class="form-group">
                                    <a class="navbar-brand">Search</a>
                                    <input class="form-control mr.sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
                                </div>
                            </div>
                        </div>
                    </thead>
                    <br>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                        <div class="productos">
                            <div class="col-xs-10 col-sm-6 col-md-4 product">
                                <div class="card">
                                    <img src="" alt="This is an image">
                                    <h5>{{ $product->name }}</h5>
                                    <p>${{ $product->price }}</p>
                                    <p>{{ $product->description }}</p>
                                </div>
                                <br>
                            </div>
                        </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection