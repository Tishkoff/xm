<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>XM PHP Exercise - v21.0.5</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script>
            jQuery.validator.addMethod("greaterOrEqualThan",
                function(value, element, params) {
                    if (!/Invalid|NaN/.test(new Date(value))) {
                        return new Date(value) >= new Date($(params).val());
                    }

                    return isNaN(value) && isNaN($(params).val())
                        || (Number(value) >= Number($(params).val()));
                },'Must be greater or equal than {0}.');

            jQuery.validator.addMethod("lessOrEqualThan",
                function(value, element, params) {
                    if (!/Invalid|NaN/.test(new Date(value))) {
                        return new Date(value) <= new Date($(params).val());
                    }

                    return isNaN(value) && isNaN($(params).val())
                        || (Number(value) <= Number($(params).val()));
                },'Must be less or equal than {0}.');

            $( function() {
                $("#start_date").datepicker({dateFormat: 'yy-mm-dd', maxDate: 0});
                $("#end_date").datepicker({dateFormat: 'yy-mm-dd', maxDate: 0});
                $("#history_request").validate({
                    rules: {
                        symbol: {
                            required: true,
                        },
                        start_date: {
                            required: true,
                            date: true,
                            lessOrEqualThan: "#end_date",
                        },
                        end_date: {
                            required: true,
                            date: true,
                            greaterOrEqualThan: "#start_date",
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                    }
                });
            } );
        </script>
    </head>
    <body>
        <h1>XM PHP Exercise - v21.0.5</h1>
        <form id="history_request" method="GET" action="/data">
            <p>
                <label for="symbol" class="text-gray-500">Company</label>
                <select id="symbol" required="required" name="symbol" class="@error('symbol') is-invalid @enderror" value="{{ old('symbol') }}">
                    <option value="">-</option>
                @foreach ($companies->all() as $key => $company)
                        <option value="{{ $key }}">{{ $company->getName() }}</option>
                    @endforeach
                </select>
                @error('symbol')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </p>
            <p>
                <label for="start_date">Start Date</label>
                <input name="start_date"
                       type="text"
                       id="start_date"
                       class="@error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                @error('start_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </p>
            <p>
                <label for="end_date">End Date</label>
                <input name="end_date"
                       type="text"
                       id="end_date"
                       class="@error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                @error('end_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </p>
            <p>
                <label for="email">Email</label>
                <input name="email"
                       type="email"
                       class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </p>
            <button type="submit">Submit</button>
        </form>
        <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
    </body>
</html>
