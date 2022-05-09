<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Daily sales report</title>
</head>

<body>

    @if(count($dailySales))

        <table class="table table-striped">

            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3">Date</th>
                    <th class="p-3">#</th>
                    <th class="p-3">Code</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Product name</th>
                    <th class="p-3">Accumulated</th>
                    
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