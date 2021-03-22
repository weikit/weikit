@extends('weikit::layouts.main')

@section('use_quasar', true)

@section('content')
    <component :is="componentName" v-bind="componentOptions" />
@endsection

@push('before_script')
    <script type="text/javascript">
        G.appOptions = {
            setup() {
                const { useComponent } = Uses;

                const { componentName, ...componentOptions} = useComponent({!! $schema->toJson() !!});
                console.log(componentName, componentOptions)

                return {
                    componentName,
                    componentOptions,
                }
            }
        };
    </script>
@endpush
