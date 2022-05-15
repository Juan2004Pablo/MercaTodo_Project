@extends('template.admin')

@section('title','Generation of reports')

@section('breadcrumb')
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow-sn text-center flex-col ml-auto m-6">

        <div class="bg-dark rounded-lg text-white flex justify-content-center items-center ml-auto">

            <!-- icono de pfd -->
            <span class="display-4 font-italic"> Reports </span>

        </div>

        <div class="row justify-content-center">

            <div class="col-md-3">

                <br>

                <label class="font-weight-bold"> Type of reports </label>

                <br><br>
                    
                <a href="{{ route('products.report.index') }}" class="btn btn-success"> Products report </a>
                    
                <br><br>

                <a href="{{ route('dailySales.report.index') }}" class="btn btn-success"> Daily sales report </a>
                    
                <br><br>

                <a href="{{ route('salesByDays.report.index') }}" class="btn btn-success"> Sales by days report </a>
                    
                <br><br>

                <a href="" class="btn btn-success"> Monthly sales report </a>
                    
                <br><br>

                <a href="{{ route('users.report.index') }}" class="btn btn-success"> Users report </a>
                    
                <br>

            </div>

            <div class="col-md-3">
  
                <br>

                <label class="font-weight-bold"> Description of report </label>

                <div class="mt-3 flex flex-col gap-2">

                    <p>This report contains information about the products available</p>

                </div>

                <div class="mt-3 flex flex-col gap-2">

                    <p>This report contains information about daily sales</p>

                </div>

                <div class="mt-3 flex flex-col gap-2">

                    <p>This report contains information on sales by days</p>

                </div>

                <div class="mt-3 flex flex-col gap-2">

                    <p>This report contains information on monthly sales</p>

                </div>

                <div class="mt-3 flex flex-col gap-2">

                    <p>This report contains information about the users available</p>

                </div>
                
            </div>

            <div class="col-md-3">

                <br>

                <label class="font-weight-bold"> Fields of report </label>

                <br><br>

                <select name="fields_products_report" class="form-control select2" style="width: 100%" readonly>

                    <option selected>Fields...</option>
                    <option value="1">Id</option>
                    <option value="2">Name</option>
                    <option value="3">Description</option>
                    <option value="4">Category</option>
                    <option value="5">Price</option>
                    <option value="6">Quantity</option>
                    <option value="7">Created at</option>

                </select>

                <br>

                <select name="fields_daily_sales_report" class="form-control select2" style="width: 100%;" readonly>

                    <option selected>Fields...</option>
                    <option value="1">Date</option>
                    <option value="2">#</option>
                    <option value="3">Code</option>
                    <option value="4">Status</option>
                    <option value="5">Total</option>
                    <option value="6">Product name</option>
                    <option value="6">Accumulated</option>

                </select>

                <br>

                <select name="fields_sales_by_days_report" class="form-control select2" style="width: 100%;" readonly>

                    <option selected>Fields...</option>
                    <option value="1">Date</option>
                    <option value="2">Quantity</option>
                    <option value="3">Product name</option>
                    <option value="4">Total</option>
                    <option value="5">Growth</option>
                    <option value="6">% vs. previous week</option>

                </select>

                <br>

                <select name="fields_monthly_sales_report" class="form-control select2" style="width: 100%;" readonly>

                    <option selected>Fields...</option>
                    <option value="1">Date</option>
                    <option value="2">Quantity</option>
                    <option value="3">Product name</option>
                    <option value="4">Total</option>
                    <option value="5">Growth</option>
                    <option value="6">% vs. previous month</option>

                </select>

                <br>

                <select name="fields_users_report" class="form-control select2" style="width: 100%;" readonly>

                    <option selected>Fields...</option>
                    <option value="1">Id</option>
                    <option value="2">Role</option>
                    <option value="3">Name</option>
                    <option value="4">Surname</option>
                    <option value="5">Identification</option>
                    <option value="6">Address</option>
                    <option value="7">Phone</option>
                    <option value="8">Email</option>
                    <option value="9">Created at</option>

                </select>

            </div>
            
        </div>

    </div>
@endsection
