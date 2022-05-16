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
        
            <caption>{{ trans('report.monthly_sales_report.title.title') }}</caption>

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
            
                @for($i=0; $i<12; $i++)
                
                    <tr class="bg-primary my-3 rounded">

                        <th class="p-3">{{ $monthsOfYear[$i] }}</th>
                        <th class="p-3">{{ $count[$i] }}</th>
                        <th class="p-3">COP {{ number_format($totalSales[$i], 0) }}</th>
                        <th class="p-3">COP {{ number_format($growth[$i], 0) }}</th>
                        <th class="p-3">{{ number_format($growthRate[$i], 2) }}%</th>
                    

                    </tr>

                @endfor

            

            </tbody>

        </table>

    @endif

</body>
</html>
