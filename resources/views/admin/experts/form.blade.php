@extends('admin.layouts.adminlte')
@section('title', $expert->exists ? 'Editing '.$expert->first_name. ' ' . $expert->last_name : 'Create Expert')
@section('style-vendor')
    @parent
@endsection
@section('style-plugin')
    @parent
{{--    <link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css">--}}

    @endsection
    @section('style-app')
        @parent
        @endsection
        @section('scripthead')
        @parent
    @endsection

    @section('scripts-vendor')
        <!-- Vendor Scripts that need to be loaded in the header before other plugin or app scripts -->
        @parent
    @endsection
    @section('scripts-plugin')
        <!-- Scripts  for code libraries and plugins that need to be loaded in the header -->
{{--        <script src="/themes/plugins/ckeditor/ckeditor.js"></script>--}}
        @parent
    @endsection
    @section('scripts-app')
        <!-- App related Scripts  that need to be loaded in the header -->
        @parent

    @endsection

@section('content')
    @if(Session::has('status'))
        <div class="row">
            <div class="col-sm-12">
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('status') }}</p>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-7">
            <div id="vue-experts">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">{{$expert->exists ? 'Edit Expert ' . $expert->getFullNameAttribute() : 'New Expert'}}</h3>
                    <div id="vue-box-tools">
                        <expert-box-tools
                                ref="expertboxtools"
                                viewtype="form"
                                current-user="{{$currentUser}}"
                                record-id="{{$expert->exists ? $expert->id : null}}"
                        ></expert-box-tools>
                    </div>
                  </div>	<!-- /.box-header -->
                  <div class="box-body">
                      <expert-form
                        errors="{{ json_encode($errors) }}"
                        framework="bootstrap"
                        :cuser-roles="{{$currentUser->roles}}"
                        recordid="{{$expert->exists ? $expert->id : null }}">
                          <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                      </expert-form>
                  </div><!-- /.box-body -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
      </div>
      <div class="col-md-5">
          @if($expert->exists)
              @if($currentRequiredImages !== null)
                  {{-- display the appropriate for for the required images --}}
                  @if ($currentRequiredImages->count() > 0)
                      {{-- there is at least 1 requireed image in the collection
                          so loop thru the required images collection and display form --}}
                      @foreach($currentRequiredImages as $currentRequiredImage)
                          @include('admin.experts.subviews.expertimage',['expertImage' => $currentRequiredImage, 'expert_id' => $expert->id ])
                      @endforeach
                  @endif
              @endif
              @if($currentOtherImages !== null)
                  @if($currentOtherImages->count() > 0)
                    @foreach($currentOtherImages as $currentOtherImage)
                        @include('admin.experts.subviews.expertimage',['expertImage' => $currentOtherImage, 'expert_id' => $expert->id ])
                    @endforeach
                  @endif
              @endif
              @if($stillNeedTheseImgs !== null)
                  @if($stillNeedTheseImgs->count() > 0)
                      @foreach($stillNeedTheseImgs as $stillNeedTheseImg)
                           @include('admin.experts.subviews.addexpertimage',['otherImage' => $stillNeedTheseImg, 'expert_id' => $expert->id ])
                      @endforeach
                  @endif
              @endif
          @endif
      </div><!-- /.md5 -->
    </div><!-- /.row -->

@endsection
@section('footer-vendor')
    @parent
    {{-- <script src="/js/admintools.js"></script> --}}
@endsection

@section('footer-app')
    @parent
    <script type="text/javascript" src="/js/vue-expert-form.js"></script>
@endsection


@section('footer-plugin')
        @parent

    <!-- Select2 -->
    <script src="/themes/admin-lte/plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>

@endsection
@section('scriptsfooter')
    @parent

@endsection
@section('footer-script')
    @parent

@endsection
