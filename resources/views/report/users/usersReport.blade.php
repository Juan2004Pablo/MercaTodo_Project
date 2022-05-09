<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Users Report</title>
</head>

<body>

    @if(count($users))

        <table class="table table-striped">

            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3">#</th>
                    <th class="p-3">Role</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Surname</th>
                    <th class="p-3">Identification</th>
                    <th class="p-3">Address</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Created at</th>
                        
                </tr>

                <br><br>

            </thead>

            <tbody>

                @foreach($users as $user)

                    <tr class="bg-primary my-3 rounded">

                        <th class="p-3">{{ $user->id }}</th>
                        <th class="p-3">{{ $roles[$loop->index] }}</th>
                        <th class="p-3">{{ $user->name }}</th>
                        <th class="p-3">{{ $user->surname }}</th>
                        <th class="p-3">{{ $user->identification }}</th>
                        <th class="p-3">{{ $user->address }}</th>
                        <th class="p-3">{{ $user->phone }}</th>
                        <th class="p-3">{{ $user->email }}</th>
                        <th class="p-3">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</th>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @endif

</body>
</html>