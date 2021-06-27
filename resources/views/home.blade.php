@extends('master')
@section('title', env('APP_NAME').' - Dashboard')

@section('content')
    <div class="wrapper wrapper-content">

    </div>
@endsection
@section('page-script')
    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('You login successfully', 'Welcome to Gym');
            }, 100);
        });
    </script>
@endsection
