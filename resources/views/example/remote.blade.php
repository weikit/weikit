@extends('weikit::layouts.quasar')

@section('content')
    <div>I'm a remote component</div>
@endsection

@push('script')
    <script type="module" type="text/javascript">
        const { defineComponent } = Weikit;

        export default defineComponent({
           setup() {
               console.log(123)
           }
        });
    </script>
@endpush
