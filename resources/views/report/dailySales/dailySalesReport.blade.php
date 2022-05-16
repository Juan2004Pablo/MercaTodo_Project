<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ trans('report.daily_sales_report.title.title') }}</title>
</head>

<body>

    @if(count($dailySales))

        <table class="table table-striped">
        
            <caption>{{ trans('report.daily_sales_report.title.title') }}</caption>

            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3">{{ trans('report.daily_sales_report.fields.date') }}</th>
                    <th class="p-3">{{ trans('report.daily_sales_report.fields.id') }}</th>
                    <th class="p-3">{{ trans('report.daily_sales_report.fields.code') }}</th>
                    <th class="p-3">{{ trans('report.daily_sales_report.fields.status') }}</th>
                    <th class="p-3">{{ trans('report.daily_sales_report.fields.total') }}</th>
                    <th class="p-3">{{ trans('report.daily_sales_report.fields.product_name') }}</th>
                    <th class="p-3">{{ trans('report.daily_sales_report.fields.accumulated') }}</th>
                    
                </tr>

                <br>

            </thead>

            <tbody>
            
                @foreach($dailySales as $dailySale)

                    <tr class="bg-primary my-3 rounded">

                        <th class="p-3">{{ \Carbon\Carbon::parse($dailySale->created_at)->format('d/m/Y') }}</th>
                        <th class="p-3">{{ $dailySale->id }}</th>
                        <th class="p-3">{{ $dailySale->code }}</th>
                        <th class="p-3">{{ $dailySale->status }}</th>
                        <th class="p-3">COP {{ number_format($dailySale->total, 0) }}</th>
                        <th class="p-3">{{ $productName[$loop->index] }}</th>
                        <th>----> COP {{ number_format($totalSales[$loop->iteration], 0) }}</th>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @endif

</body>
</html>
