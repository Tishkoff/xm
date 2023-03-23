<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>XM PHP Exercise - v21.0.5</title>
    </head>
    <body class="antialiased">
        <table>
            <thead>
            <tr>
                <th>Data</th>
                <th>Open</th>
                <th>High</th>
                <th>Low</th>
                <th>Close</th>
                <th>Volume</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($prices->all() as $price)
                <tr>
                    <td>{{ $price->getDateFormatted() }}</td>
                    <td>{{ $price->getOpen() }}</td>
                    <td>{{ $price->getHigh() }}</td>
                    <td>{{ $price->getLow() }}</td>
                    <td>{{ $price->getClose() }}</td>
                    <td>{{ $price->getVolume() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <canvas id="line-chart" width="800" height="450"></canvas>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
        <script>
            new Chart(document.getElementById("line-chart"), {
                type: "line",
                data: {
                    labels: [{{ implode(',', array_map(function ($price) { return $price->getDate(); }, array_reverse($prices->all(), true))) }}],
                    datasets: [
                        {
                            data: [{{ implode(',', array_map(function ($price) { return $price->getOpen(); }, array_reverse($prices->all(), true))) }}],
                            label: "Open",
                            borderColor: "#3e95cd",
                            fill: false
                        },
                        {
                            data: [{{ implode(',', array_map(function ($price) { return $price->getClose(); }, array_reverse($prices->all(), true))) }}],
                            label: "Close",
                            borderColor: "#8e5ea2",
                            fill: false
                        },
                    ]
                },
            });
        </script>
    </body>
</html>
