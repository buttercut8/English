@extends('master')
@section('Todo English')
@section('content')
<div id="app_english">
   <editmenu></editmenu>
   <section>
       <div class="row">
             <div class="col s12 m3 l3 menu_user">
                  @include('components.menu')
             </div>
             <div class="col s12 m9 l9 offset-l3 all_listtodo">
                <section class="section">
                    <div class="row">
                        <transition name="custom" enter-active-class="animated zoomIn" leave-active-class="animated fadeOutUp" mode="out-in">
                            <router-view></router-view>
                        </transition>
                        <button type="button" class="loadding btn_none" v-show="loadding"></button>
                    </div>
                </section>
            </div>
       </div>
   </section>
</div>
@endsection
@section('script')
    <script type="text/javascript" src="{{url('public/tinymce/tinymce.min.js')}}"></script>
    {{-- <script src="//cdn.tinymce.com/4.5/tinymce.min.js"></script> --}}
@endsection
