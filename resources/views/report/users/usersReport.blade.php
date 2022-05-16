<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ trans('report.users_report.title.title') }}</title>
</head>

<body>

    @if(count($users))

        <table class="table table-striped">

            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3">{{ trans('report.users_report.fields.id') }}</th>
                    <th class="p-3">{{ trans('report.users_report.fields.role') }}</th>
                    <th class="p-3">{{ trans('report.users_report.fields.name') }}</th>
                    <th class="p-3">{{ trans('report.users_report.fields.surname') }}</th>
                    <th class="p-3">{{ trans('report.users_report.fields.identification') }}</th>
                    <th class="p-3">{{ trans('report.users_report.fields.address') }}</th>
                    <th class="p-3">{{ trans('report.users_report.fields.phone') }}</th>
                    <th class="p-3">{{ trans('report.users_report.fields.email') }}</th>
                    <th class="p-3">{{ trans('report.users_report.fields.date') }}</th>
                        
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