<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Paripassu QR-Code</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID"
                aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarID">
                
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <h1 class="text-center">GERADOR DE QR-CODE PARIPASSU</h1>

        <form class="row g-3 needs-validation mt-5" novalidate>

            <div class="col-md-4">
                <label for="produto" class="form-label">Produto</label>
                <select class="form-select" id="produto" name='produto' required>
                    
                    @foreach ($produtos as $produto)
                    <option value='{{ $produto[0] }}'>{{ strtoupper($produto[1]) }}</option>  
                    @endforeach
                </select>
                <div class="invalid-feedback">

                </div>
            </div>

            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Código Paripassu</label>
                <input type="text" class="form-control" id="codigo" name='codigo' value="" required>
                <div class="invalid-feedback">
                    Looks good!
                </div>
            </div>

            <div class="col-md-4">
                <label for="validationCustom02" class="form-label">Validade</label>
                <input type="date" class="form-control" id="data" name="data" value="{{ $validade }}" required>
                <div class="invalid-feedback">

                </div>
            </div>
        </form>

    </div>
    <div class="container qrcode text-center mt-2"></div>
    <div class="container text-center mt-5"><small>{{ date('Y') }} - OCTIO TECNOLOGIA / ALFACITRUS</small></div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('input,select').on("keyup change",function() {
            $.ajax({
                    method: "POST",
                    url: "/qr-code",
                    data: {
                        produto: $('#produto').val(),
                        codigo: $('#codigo').val(),
                        data: $('#data').val()
                    }
                })
                .done(function(msg) {
                    $('.qrcode').html(msg)
                });

        });
    </script>

</body>

</html>
