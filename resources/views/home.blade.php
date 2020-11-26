@extends('layouts.frontend')

@section('title') Welcome @stop

@section('intro')

  <section id="intro">

    <div class="intro-content">
      <h2><span>Task Manager Laravel App </span></h2>
      <div>
        <a href="{{ route('usersList.frontend.index') }}" class="btn-get-started scrollto">Get Started</a>
      </div>
    </div>

    <div id="intro-carousel" class="owl-carousel" >
      <div class="item" style="background-image: url('{{ asset('frontend/images/intro-carousel/1.jpg') }}');"></div>
      <div class="item" style="background-image: url('{{ asset('frontend/images/intro-carousel/2.jpg') }}');"></div>
    </div>

  </section>

@stop
