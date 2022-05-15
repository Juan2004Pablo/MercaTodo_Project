<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sales by days report</title>
</head>

<body>

    @if(count($salesByDays))

        <table class="table table-striped">

            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3">#</th>
                    <th class="p-3">Day</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Code</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Total</th>
                    
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

                    <th class="p-3">Day of week</th>
                    <th class="p-3">Accumulated</th>
                    <th class="p-3">Growth</th>
                    <th class="p-3">% vs. previous day</th>
                    
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