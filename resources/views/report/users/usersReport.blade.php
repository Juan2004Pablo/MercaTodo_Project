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

            <caption>{{ trans('report.users_report.title.title') }}</caption>
            
            <thead class="text-white bg-secondary">

                <tr>

                    <th class="p-3" id="id">{{ trans('report.users_report.fields.id') }}</th>
                    <th class="p-3" id="role">{{ trans('report.users_report.fields.role') }}</th>
                    <th class="p-3" id="name">{{ trans('report.users_report.fields.name') }}</th>
                    <th class="p-3" id="surname">{{ trans('report.users_report.fields.surname') }}</th>
                    <th class="p-3" id="identification">{{ trans('report.users_report.fields.identification') }}</th>
                    <th class="p-3" id="address">{{ trans('report.users_report.fields.address') }}</th>
                    <th class="p-3" id="phone">{{ trans('report.users_report.fields.phone') }}</th>
                    <th class="p-3" id="email">{{ trans('report.users_report.fields.email') }}</th>
                    <th class="p-3" id="date">{{ trans('report.users_report.fields.date') }}</th>
                        
                </tr>

                <br><br>

            </thead>

            <tbody>

                @foreach($users as $user)

                    <tr class="bg-primary my-3 rounded">

                        <th class="p-3" id="ids">>{{ $user->id }}</th>
                        <th class="p-3" id="roles">>{{ $roles[$loop->index] }}</th>
                        <th class="p-3" id="names">>{{ $user->name }}</th>
                        <th class="p-3" id="surnames">>{{ $user->surname }}</th>
                        <th class="p-3" id="identifications">>{{ $user->identification }}</th>
                        <th class="p-3" id="address">>{{ $user->address }}</th>
                        <th class="p-3" id="phone">>{{ $user->phone }}</th>
                        <th class="p-3" id="email">>{{ $user->email }}</th>
                        <th class="p-3" id="dates">>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</th>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @endif

</body>
</html>
