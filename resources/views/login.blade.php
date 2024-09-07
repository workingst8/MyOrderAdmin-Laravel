<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOrderAdmin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="container w-50 mt-5">

    @if(Session::has('status'))
    <div id="alert-box" class="alert alert-success" role="alert">
        {{ Session::get('status') }}
    </div>
    @endif

    <div class="d-block">
        <h1 style="text-align:center">MY ORDER ADMIN</h1>
        <form method="post" class="w-100 mt-5 pt-5 m-auto" action="{{route('login')}}">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">관리자 ID</label>
                <input type="input" name="login_id" class="form-control" required>
                @error('login_id')
                <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">관리자 비밀번호</label>
                <input type="password" name="password" class="form-control" required>
                @error('password')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3
            ">로그인</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#alert-box').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 2000);
        });
    </script>
</body>

</html>