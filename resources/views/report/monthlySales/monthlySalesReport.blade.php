<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ trans('report.monthly_sales_report.title.title') }}</title>
</head>

<body>

    @if(count($monthlySales))

        <table class="table table-striped">

            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3">{{ trans('report.monthly_sales_report.fields.date') }}</th>
                    <th class="p-3">{{ trans('report.monthly_sales_report.fields.quantity') }}</th>
                    <th class="p-3">{{ trans('report.monthly_sales_report.fields.total') }}</th>
                    <th class="p-3">{{ trans('report.monthly_sales_report.fields.growth') }}</th>
                    <th class="p-3">{{ trans('report.monthly_sales_report.fields.previous') }}</th>
                    
                </tr>

                <br>

            </thead>

            <tbody>
            
                @foreach($monthlySales as $monthlySale)
                    
                    <tr class="bg-primary my-3 rounded">

                        <th class="p-3">{{ $months[$loop->index] }}</th>
                        <th class="p-3">{{ $count[$loop->index] }}</th>
                        <th class="p-3">COP {{ number_format($totalSales[$loop->index], 0) }}</th>
                        <th class="p-3">COP {{ number_format($growth[$loop->index], 0) }}</th>
                        <th class="p-3">{{ number_format($growthRate[$loop->index], 2) }}%</th>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @endif

</body>
</html>