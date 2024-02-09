<!DOCTYPE html>
<html>

<head>
    <title>Generate PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>
    <p>report from {{ $previousDate }} to {{ $date }}</p>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>average rating</th>
            <th>number of reviews</th>

        </tr>
        @foreach ($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->received_reviews_avg_vote }}</td>
                <td>{{ $company->received_reviews_count }}</td>
            </tr>
        @endforeach
    </table>
    @foreach ($companies as $i => $company)
        <h3>{{ $i + 1 }}. Company {{ $company->name }} reviews </h3>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Vote</th>
                <th>text</th>
                <th>date</th>


            </tr>
            @foreach ($company->receivedReviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->vote }}</td>
                    <td>{!! $review->review !!}</td>
                    <td>{{ $review->created_at }}</td>
                </tr>
            @endforeach
        </table>
    @endforeach

</body>

</html>
