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

<body>
    <div class="container w-50 mt-5">
        @if(Session::has('item_created'))
        <div id="alert-box" class="alert alert-success" role="alert">
            {{ Session::get('item_created') }}
        </div>
        @endif
        <h2>상품 등록</h2>
        <form id="itemForm" method="POST" action="/items" enctype="multipart/form-data">
            @csrf
            <div class="mt-4 mb-3">
                <span class="h2"></span>
            </div>
            <div class="mb-3">
                <input type="text" id="product" name="product" class="form-control" placeholder="품명을 입력해 주세요.">
            </div>
            <div class="mb-3">
                <input type="text" id="price" name="price" class="form-control" placeholder="금액을 입력해 주세요.(숫자만 입력)">
            </div>
            <div class="mb-3">
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <div class="d-flex justify-content-between mt-2">
                <button type="submit" class="btn btn-primary">등록</button>
                <a href="{{ route('item.all') }}" class="btn btn-secondary">뒤로</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#alert-box').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 2000);

            $('#itemForm').on('submit', function(event) {
                const product = $('#product').val().trim();
                const price = $('#price').val().trim();
                const image = $('#image').val().trim();

                if (!product) {
                    alert('품명을 입력해 주세요.');
                    event.preventDefault();
                    return;
                }

                if (!price || isNaN(price)) {
                    alert('유효한 금액을 입력해 주세요.');
                    event.preventDefault();
                    return;
                }

                if (!image) {
                    alert('이미지를 선택해 주세요.');
                    event.preventDefault();
                    return;
                }
            });
        });
    </script>
</body>

</html>
