<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Monthly sales report</title>
</head>

<body>

    @if(count($monthlySales))

        <table class="table table-striped">

            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3">Date</th>
                    <th class="p-3">Quantity</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Growth</th>
                    <th class="p-3">% vs. previous month</th>
                    
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