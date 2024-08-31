<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyOrderAdmin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .pagination .page-link {
            color: #565e64;
            border-color: #565e64;
        }

        .pagination .page-item.active .page-link {
            color: #fff;
            background-color: #565e64;
            border-color: #565e64;
        }
    </style>
</head>

<body>
    <div class="container w-50 mt-5">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>상품 목록</h2>
            <a href="{{ route('item.create') }}" class="btn btn-secondary">상품 등록</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>품명</th>
                    <th>금액</th>
                    <th>이미지</th>
                    <th>관리</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr data-id="{{ $item->id }}">
                    <td class="editable">
                        <input type="text" name="product" value="{{ $item->product }}" class="form-control">
                    </td>
                    <td class="editable">
                        <input type="text" name="price" value="{{ $item->price }}" class="form-control">
                    </td>
                    <td class="editable">
                        <label>현재 이미지</label>
                        <img src="{{ Storage::url($item->image) }}" alt="이미지" style="width: 100px;">
                        <input type="file" name="image" class="form-control mt-2">
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-success btn-save text-nowrap">수정</button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-success btn-delete text-nowrap">삭제</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $items->links() }}
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('.btn-save').click(function() {
                var row = $(this).closest('tr');
                var id = row.data('id');
                var product = row.find('input[name="product"]').val();
                var price = row.find('input[name="price"]').val();
                var image = row.find('input[name="image"]')[0].files[0];

                var formData = new FormData();
                formData.append('product', product);
                formData.append('price', price);
                if (image) {
                    formData.append('image', image);
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/items/" + id,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        alert('수정되었습니다.');
                        location.reload();
                    },
                    error: function(request, status, error) {
                        console.log('code: ' + request.status);
                        console.log('message: ' + request.responseText);
                        console.log('error: ' + error);
                    }
                });
            });

            $('.btn-delete').click(function() {
                if (!confirm('정말로 삭제하시겠습니까?')) {
                    return;
                }

                var row = $(this).closest('tr');
                var id = row.data('id');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/items/" + id,
                    method: "DELETE",
                    success: function(response) {
                        console.log(response);
                        alert('삭제되었습니다.');
                        location.reload();
                    },
                    error: function(request, status, error) {
                        console.log('code: ' + request.status);
                        console.log('message: ' + request.responseText);
                        console.log('error: ' + error);
                    }
                });
            });
        });
    </script>
</body>

</html>