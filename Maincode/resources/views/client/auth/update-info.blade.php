@extends('client.layouts.template')

@section('main')
<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if(Session::has('invalid'))
                    <div class="alert alert-danger alert-dismissible mt-2">
                         <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         {{Session::get('invalid')}}
                    </div>
                @endif
                @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible mt-2">
                            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{Session::get('success')}}
                        </div>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>CẬP NHẬT THÔNG TIN</h2>
                </div>
            </div>
        </div>
        <form action="{{ route('social.update-info') }}" method="POST">

            @csrf
            <input type="hidden" name="email" value="{{ $email }}" />
            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-6">
                    <input type="tel" placeholder="Số điện thoại" style="margin-bottom: 10px;" name="phone" pattern="[0-9]{10}" value="{{ old('phone') }}" required>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-6">
                    <input type="password" placeholder="Mật khẩu" style="margin-bottom: 10px;" name="password" required>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-6">
                    <input type="password" placeholder="Xác nhận mật khẩu" style="margin-bottom: 10px;" name="repassword" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="site-btn">Cập nhật thông tin</button>
                </div>
            </div>
        </form>        
    </div>
</div>
<!-- Contact Form End -->
@stop