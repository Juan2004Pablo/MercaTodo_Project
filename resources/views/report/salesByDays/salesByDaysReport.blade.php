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
        
            <caption>{{ trans('report.sales_by_days_report.title.title') }}</caption>

            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3" id="i">{{ trans('report.sales_by_days_report.fields.id') }}</th>
                    <th class="p-3" id="da">{{ trans('report.sales_by_days_report.fields.day') }}</th>
                    <th class="p-3" id="dat">{{ trans('report.sales_by_days_report.fields.date') }}</th>
                    <th class="p-3" id="cod">{{ trans('report.sales_by_days_report.fields.code') }}</th>
                    <th class="p-3" id="statu">{{ trans('report.sales_by_days_report.fields.status') }}</th>
                    <th class="p-3" id="tot">{{ trans('report.sales_by_days_report.fields.total') }}</th>
                    
                </tr>

                <br>

            </thead>

            <tbody>
            
                @foreach($salesByDays as $salesByDay)

                    <tr class="bg-primary my-3 rounded">

                        <th class="p-3" id="id">{{ $salesByDay->id }}</th>
                        <th class="p-3" id="day">{{ $day[$loop->index] }}</th>
                        <th class="p-3" id="date">{{ \Carbon\Carbon::parse($salesByDay->created_at)->format('d/m/Y') }}</th>
                        <th class="p-3" id="code">{{ $salesByDay->code }}</th>
                        <th class="p-3" id="status">{{ $salesByDay->status }}</th>
                        <th class="p-3" id="total">COP {{ number_format($salesByDay->total, 0) }}</th>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <table class="table table-striped">
        
            <caption>{{ trans('report.sales_by_days_report.title.title') }}</caption>

            <br><br>

            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3" id="dayweek">{{ trans('report.sales_by_days_report.fields.day_of_week') }}</th>
                    <th class="p-3" id="accumulated">{{ trans('report.sales_by_days_report.fields.accumulated') }}</th>
                    <th class="p-3" id="growth">{{ trans('report.sales_by_days_report.fields.growth') }}</th>
                    <th class="p-3" id="previus">{{ trans('report.sales_by_days_report.fields.previus') }}</th>
                    
                </tr>

                <br>

            </thead>

            <tbody>

                @for($i=0; $i<7; $i++)
            
                        <tr class="bg-primary my-3 rounded">

                            <th class="p-3" id="dayofweek">{{ $daysOfWeek[$i] }}</th>
                            <th class="p-3" id="subtotal">COP {{ number_format($subTotal[$i], 0) }}</th>
                            <th class="p-3" id="grow">COP {{ number_format($growth[$i], 0) }}</th>
                            <th class="p-3" id="previusgrowth">{{ number_format($growthRate[$i], 2) }}%</th>
                           

                        </tr>

                @endfor

            </tbody>

        </table>

    @endif

</body>
</html>
