@extends('template.admin')

@section('title','Generation of reports')

@section('breadcrumb')
<ul>
    <li class="breadcrumb-item active">@yield('title')</li>
</ul>
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow-sn text-center flex-col ml-auto m-6">

        <div class="bg-dark rounded-lg text-white flex justify-content-center items-center ml-auto">

            <!-- icono de pfd -->
            <span class="display-4 font-italic"> {{ trans('report.index.title.title') }} </span>

        </div>

        <div class="row justify-content-center">

            <div class="col-md-3">

                <br>

                <label class="font-weight-bold"> {{ trans('report.index.title.type') }} </label>

                <br><br>
                    
                <a href="{{ route('products.report.index') }}" class="btn btn-success"> {{ trans('report.index.title.products_report') }} </a>
                    
                <br><br>

                <a href="{{ route('dailySales.report.index') }}" class="btn btn-success"> {{ trans('report.index.title.daily_sales_report') }} </a>
                    
                <br><br>

                <a href="{{ route('salesByDays.report.index') }}" class="btn btn-success"> {{ trans('report.index.title.sales_by_days_report') }} </a>
                    
                <br><br>

                <a href="{{ route('monthlySales.report.index') }}" class="btn btn-success"> {{ trans('report.index.title.monthly_sales_report') }} </a>
                    
                <br><br>

                <a href="{{ route('users.report.index') }}" class="btn btn-success"> {{ trans('report.index.title.users_report') }} </a>
                    
                <br>

            </div>

            <div class="col-md-3">
  
                <br>

                <label class="font-weight-bold"> {{ trans('report.index.title.description_of_report') }} </label>

                <div class="mt-3 flex flex-col gap-2">

                    <p>{{ trans('report.index.description.description_products') }}</p>

                </div>

                <div class="mt-3 flex flex-col gap-2">

                    <p>{{ trans('report.index.description.description_daily') }}</p>

                </div>

                <div class="mt-3 flex flex-col gap-2">

                    <p>{{ trans('report.index.description.description_salesdays') }}</p>

                </div>

                <div class="mt-3 flex flex-col gap-2">

                    <p>{{ trans('report.index.description.description_monthly') }}</p>

                </div>

                <div class="mt-3 flex flex-col gap-2">

                    <p>{{ trans('report.index.description.description_users') }}</p>

                </div>
                
            </div>

            <div class="col-md-3">

                <br>

                <label class="font-weight-bold"> {{ trans('report.index.title.users_report') }} </label>

                <br><br>

                <select name="fields_products_report" class="form-control select2" style="width: 100%" readonly>

                    <option selected>{{ trans('report.index.fields.title') }}</option>
                    <option value="1">{{ trans('report.products_report.fields.id') }}</option>
                    <option value="2">{{ trans('report.products_report.fields.name') }}</option>
                    <option value="3">{{ trans('report.products_report.fields.price') }}</option>
                    <option value="4">{{ trans('report.products_report.fields.category') }}</option>
                    <option value="5">{{ trans('report.products_report.fields.quantity') }}</option>
                    <option value="6">{{ trans('report.products_report.fields.description') }}</option>
                    <option value="7">{{ trans('report.products_report.fields.date') }}</option>

                </select>

                <br>

                <select name="fields_daily_sales_report" class="form-control select2" style="width: 100%;" readonly>

                    <option selected>{{ trans('report.index.fields.title') }}</option>
                    <option value="1">{{ trans('report.daily_sales_report.fields.date') }}</option>
                    <option value="2">{{ trans('report.daily_sales_report.fields.id') }}</option>
                    <option value="3">{{ trans('report.daily_sales_report.fields.code') }}</option>
                    <option value="4">{{ trans('report.daily_sales_report.fields.status') }}</option>
                    <option value="5">{{ trans('report.daily_sales_report.fields.total') }}</option>
                    <option value="6">{{ trans('report.daily_sales_report.fields.product_name') }}</option>
                    <option value="6">{{ trans('report.daily_sales_report.fields.accumulated') }}</option>

                </select>

                <br>

                <select name="fields_sales_by_days_report" class="form-control select2" style="width: 100%;" readonly>

                    <option selected>{{ trans('report.index.fields.title') }}</option>
                    <option value="1">{{ trans('report.sales_by_days_report.fields.id') }}</option>
                    <option value="2">{{ trans('report.sales_by_days_report.fields.day') }}</option>
                    <option value="3">{{ trans('report.sales_by_days_report.fields.date') }}</option>
                    <option value="4">{{ trans('report.sales_by_days_report.fields.code') }}</option>
                    <option value="5">{{ trans('report.sales_by_days_report.fields.status') }}</option>
                    <option value="6">{{ trans('report.sales_by_days_report.fields.total') }}</option>
                
                </select>

                <br>

                <select name="fields_monthly_sales_report" class="form-control select2" style="width: 100%;" readonly>

                    <option selected>{{ trans('report.index.fields.title') }}</option>
                    <option value="1">{{ trans('report.monthly_sales_report.fields.date') }}</option>
                    <option value="2">{{ trans('report.monthly_sales_report.fields.quantity') }}</option>
                    <option value="4">{{ trans('report.monthly_sales_report.fields.total') }}</option>
                    <option value="5">{{ trans('report.monthly_sales_report.fields.growth') }}</option>
                    <option value="6">{{ trans('report.monthly_sales_report.fields.previous') }}</option>

                </select>

                <br>

                <select name="fields_users_report" class="form-control select2" style="width: 100%;" readonly>

                    <option selected>{{ trans('report.index.fields.title') }}</option>
                    <option value="1">{{ trans('report.users_report.fields.id') }}</option>
                    <option value="2">{{ trans('report.users_report.fields.role') }}</option>
                    <option value="3">{{ trans('report.users_report.fields.name') }}</option>
                    <option value="4">{{ trans('report.users_report.fields.surname') }}</option>
                    <option value="5">{{ trans('report.users_report.fields.identification') }}</option>
                    <option value="6">{{ trans('report.users_report.fields.address') }}</option>
                    <option value="7">{{ trans('report.users_report.fields.phone') }}</option>
                    <option value="8">{{ trans('report.users_report.fields.email') }}</option>
                    <option value="9">{{ trans('report.users_report.fields.date') }}</option>

                </select>

            </div>
            
        </div>

    </div>
@endsection
