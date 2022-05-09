<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Products report</title>
</head>

<body>

    @if(count($products))

        <table class="table table-striped">

            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3">#</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Price</th>
                    <th class="p-3">Category</th>
                    <th class="p-3">Quantity</th>
                    <th class="p-3">Description</th>
                    <th class="p-3">Created at</th>
                    
                </tr>

                <br><br>

            </thead>

            <tbody>

                @foreach($products as $product)

                    <tr class="bg-primary my-3 rounded">

                        <th class="p-3">{{ $product->id }}</th>
                        <th class="p-3">{{ $product->name }}</th>
                        <th class="p-3">COP{{ number_format($product->price, 0) }}</th>
                        <th class="p-3">{{ $nameCategory[$loop->index] }}</th>
                        <th class="p-3">{{ $product->quantity }}</th>
                        <th class="p-3">{{ $product->description }}</th>
                        <th class="p-3">{{ \Carbon\Carbon::parse($product->created_at)->format('d/m/Y') }}</th>
                        
                    </tr>

                @endforeach

            </tbody>

        </table>

    @endif

</body>
</html>