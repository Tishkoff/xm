<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>XM PHP Exercise - v21.0.5</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script>
            $( function() {
                $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
                $( "#end_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
            } );
        </script>
    </head>
    <body>
        <h1>XM PHP Exercise - v21.0.5</h1>
        <form method="GET" action="/data">
            <label for="symbol" class="text-gray-500">Company Symbol</label>

            <select required="required" name="symbol" class="@error('symbol') is-invalid @enderror" value="{{ old('symbol') }}">
                @foreach ($companies->all() as $key => $company)
                    <option value="{{ $key }}">{{ $company->getName() }}</option>
                @endforeach
            </select>

            @error('symbol')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="start_date">Start Date</label>

            <input name="start_date"
                   type="text"
                   id="start_date"
                   class="@error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">

            @error('start_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="end_date">End Date</label>

            <input name="end_date"
                   type="text"
                   id="end_date"
                   class="@error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">

            @error('end_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="email">Email</label>

            <input name="email"
                   type="text"
                   class="@error('email') is-invalid @enderror" value="{{ old('email') }}">

            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Submit</button>
        </form>
        <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
    </body>
</html>
