<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ trans('report.sales_by_days_report.title.title') }}</title>
</head>

<body>

    @if(count($salesByDays))

        <table class="table table-striped">

            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3">{{ trans('report.sales_by_days_report.fields.id') }}</th>
                    <th class="p-3">{{ trans('report.sales_by_days_report.fields.day') }}</th>
                    <th class="p-3">{{ trans('report.sales_by_days_report.fields.date') }}</th>
                    <th class="p-3">{{ trans('report.sales_by_days_report.fields.code') }}</th>
                    <th class="p-3">{{ trans('report.sales_by_days_report.fields.status') }}</th>
                    <th class="p-3">{{ trans('report.sales_by_days_report.fields.total') }}</th>
                    
                </tr>

                <br>

            </thead>

            <tbody>
            
                @foreach($salesByDays as $salesByDay)

                    <tr class="bg-primary my-3 rounded">

                        <th class="p-3">{{ $salesByDay->id }}</th>
                        <th class="p-3">{{ $day[$loop->index] }}</th>
                        <th class="p-3">{{ \Carbon\Carbon::parse($salesByDay->created_at)->format('d/m/Y') }}</th>
                        <th class="p-3">{{ $salesByDay->code }}</th>
                        <th class="p-3">{{ $salesByDay->status }}</th>
                        <th class="p-3">COP {{ number_format($salesByDay->total, 0) }}</th>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <table class="table table-striped">

            <br><br>

            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3">{{ trans('report.sales_by_days_report.fields.day_of_week') }}</th>
                    <th class="p-3">{{ trans('report.sales_by_days_report.fields.accumulated') }}</th>
                    <th class="p-3">{{ trans('report.sales_by_days_report.fields.growth') }}</th>
                    <th class="p-3">{{ trans('report.sales_by_days_report.fields.previus') }}</th>
                    
                </tr>

                <br>

            </thead>

            <tbody>

                @for($i=0; $i<7; $i++)
            
                        <tr class="bg-primary my-3 rounded">

                            <th class="p-3">{{ $daysOfWeek[$i] }}</th>
                            <th class="p-3">COP {{ number_format($subTotal[$i], 0) }}</th>
                            <th class="p-3">COP {{ number_format($growth[$i], 0) }}</th>
                            <th class="p-3">{{ number_format($growthRate[$i], 2) }}%</th>
                           

                        </tr>

                @endfor

            </tbody>

        </table>

    @endif

</body>
</html>