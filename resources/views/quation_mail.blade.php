{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        table {
            border-collapse: collapse;
            width: 300px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th>Field</th>
        <th>Data</th>
    </tr>
    <tr>
        <td>Name</td>
        <td>{{$data['name']}}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{$data['email']}}</td>
    </tr>
    <tr>
        <td>Mobile Number</td>
        <td>{{$data['mobile_number']}}</td>
    </tr>
    <tr>
        <td>Service</td>
        <td>{{$data['service']}}</td>
    </tr>
    <tr>
        <td>Not</td>
        <td>{{$data['not']}}</td>
    </tr>
</table>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        table {
            border-collapse: collapse;
            width: 400px;
            margin: auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

<h2>Client Data</h2>
@php
    use Carbon\Carbon;
    $currentDate = Carbon::now()->format('d-m-y');
@endphp
<table>
    <tr>
        <th>Field</th>
        <th>Data</th>
    </tr>
    <tr>
        <td>Date</td>
        <td>
            {{$currentDate}}
        </td>
    </tr>
    <tr>
        <td>Name</td>
        <td>{{$data['name']}}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{$data['email']}}</td>
    </tr>
    <tr>
        <td>Mobile Number</td>
        <td>{{$data['mobile_number']}}</td>
    </tr>
    <tr>
        <td>Service</td>
        <td>{{$data['service']}}</td>
    </tr>
    <tr>
        <td>Running Bill Amount</td>
        <td>{{$data['running_bill']}}</td>
    </tr>
    <tr>
        <td>Customer Requirement KW</td>
        <td>{{$data['kilowatt']}} KW</td>
    </tr>
    <tr>
        <td>Address</td>
        <td>{{$data['address']}}</td>
    </tr>
</table>

</body>
</html>
