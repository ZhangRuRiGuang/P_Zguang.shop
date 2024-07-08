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
                    <h2>ĐỔI MẬT KHẨU</h2>
                </div>
            </div>
        </div>
        <form action="{{ route('auth.updatepassword') }}" method="POST">

            @csrf
            <input type="hidden" name="email" value="{{ $email }}" />
            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-6">
                    <input type="password" placeholder="Mật khẩu" style="margin-bottom: 10px;" name="password">
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-6">
                    <input type="password" placeholder="Xác nhận mật khẩu" style="margin-bottom: 10px;" name="repassword">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="site-btn">Đổi mật khẩu</button>
                </div>
            </div>
        </form>        
    </div>
</div>
<!-- Contact Form End -->
@stop