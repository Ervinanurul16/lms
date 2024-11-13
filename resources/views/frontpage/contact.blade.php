@extends('layouts.home-template')

@section('title')
    {{ __('menu-label.contact')}}
@endsection

@section('before-styles')
<!-- Treeview Gijgo CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/css/gijgo.min.css">
@endsection

@section('content')
<div id="main" class="content">
    <div class="container">
        <div class="row">
            <div id="course-side-nav" class="col-md-3 col-sm-12">
                <h4 class="font-weight-bold">{{ __('section-title.topic_index')}}</h4>
                @include('frontpage.topic-sidebar')
            </div>
            <div class="col-md-9 col-sm-12">
                <h2 class="title">{{ __('menu-label.contact')}}</h2>
                <div class="row">
                    <div class="col-md-6">
                        <table id="contact-table">
                            <tbody valign="top">
                                <tr>
                                    <td><i class="fas fa-map-marker-alt"></i></td>
                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut consequatur, nobis mollitia rem sapiente quo voluptatibus temporibus laudantium excepturi fuga, neque magni velit eius rerum? Exercitationem vel praesentium animi! Dolore?</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-phone"></i></td>
                                    <td><a href="tel:+62243544024">(024) 3544024</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <table id="contact-admin-table" class="mt-5">
                            <tr>
                                <td colspan="3" class="font-weight-bold">Admin</td>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>John Doe</td>
                                <td><a href="https://wa.me/">0821-2323-2332</a></td>
                            </tr>
                           
                        </table>
                    </div>
                    <div class="col-md-6">
                        <img class="rounded" src="{{ asset('img/favicon-web.png') }}" alt="Foto SMP N 6 Semarang">
                    </div>
                </div>
                <div class="mt-5">
                    <h2 class="title">{{ __('label.school_location') }}</h2>
                    <iframe src="" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Treeview Gijgo -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/js/gijgo.min.js"></script>
@endpush