<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 변경</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="container w-50 mt-5">

    <div class="d-flex">
        <form method="post" class="w-100 mt-5 pt-5 m-auto" action="{{ route('pw.update') }}">
            @csrf
            <div class="mb-3">
                <label for="current_password" class="form-label">현재 비밀번호</label>
                <input type="password" name="current_password" class="form-control" required>
                @error('current_password')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">새 비밀번호</label>
                <input type="password" name="new_password" class="form-control" required>
                @error('new_password')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">새 비밀번호 확인</label>
                <input type="password" name="new_password_confirmation" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <button type="submit" class="btn btn-primary">비밀번호 변경</button>
                <a href="{{ route('item.all') }}" class="btn btn-secondary">뒤로</a>
            </div>
        </form>
    </div>

</body>

</html>