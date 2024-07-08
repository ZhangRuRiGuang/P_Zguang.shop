<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trở thành người bán</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        /* Image preview */
        .image-preview {
            width: 300px;
            min-height: 150px;
            border: 2px solid #dddddd;
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #cccccc;
        }

        .image-preview__image {
            display: none;
            width: 100%;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Trở thành người bán</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('admin.handle.register') }}" enctype="multipart/form-data">

                                        @csrf

                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control form-control-user"
                                                id="exampleInputName" aria-describedby="nameHelp" placeholder="Họ tên"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Mật khẩu" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="shop" class="form-control form-control-user"
                                                id="exampleInputShop" aria-describedby="shopHelp"
                                                placeholder="Tên cửa hàng" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" name="phone" class="form-control form-control-user"
                                                id="exampleInputPhone" aria-describedby="phoneHelp"
                                                placeholder="Số điện thoại" pattern="[0-9]{10}" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="address" class="form-control form-control-user"
                                                id="exampleInputAddress" aria-describedby="addressHelp"
                                                placeholder="Địa chỉ" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Mô tả cửa hàng" name="des" id="content" cols="10" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Chọn hình ảnh: <span
                                                    class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" id="image" name="image"
                                                    accept=".png,.gif,.jpg,.jpeg" required />
                                            </div>
                                        </div>
                                        <div class="image-preview mb-4" id="imagePreview">
                                            <img src="" alt="Image Preview" class="image-preview__image" />
                                            <span class="image-preview__default-text">Hình ảnh</span>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Đăng ký
                                        </button>
                                    </form>
                                    <hr class="my-4">
                                    <a href="{{ route('admin.form.login') }}" class="btn btn-success btn-block">Đăng
                                        nhập</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('content')
    </script>
    <script>
        // Image Preview
        const thumbnail = document.getElementById("image");
        const previewContainer = document.getElementById("imagePreview");
        const previewImage = previewContainer.querySelector(".image-preview__image");
        const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

        thumbnail.addEventListener("change", function() {
            const file = this.files[0];

            const reader = new FileReader();
            previewDefaultText.style.display = "none";
            previewImage.style.display = "block";
            reader.addEventListener("load", function() {
                previewImage.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>
