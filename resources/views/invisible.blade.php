<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <style>
        [hidden], [hidden="true"] {
            display: none;
        }

        #error {
            color: red;
        }
    </style>
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post">
    @csrf
    <input type="name">
    <br>
    <p id="error" hidden>name is too short (minimum is 3 characters)</p>
    {!! app('captcha')->display(['data-size' => 'invisible']) !!}
    <button type="submit">Submit</button>
</form>
<button id="reset">Reset</button>
<script>
    var inputName = document.querySelector('input[type="name"]');
    var reset = document.querySelector('#reset');
    var error = document.querySelector('#error');

    inputName.addEventListener('keyup', event => {
        event.preventDefault();
        if (inputName.value.length > 3) {
            error.setAttribute('hidden', true);
            grecaptcha.execute();
        } else {
            error.removeAttribute('hidden');
        }
    });

    if (reset) {
        reset.addEventListener('click', () => {
            grecaptcha.reset();
        });
    }
</script>
</body>
</html>
