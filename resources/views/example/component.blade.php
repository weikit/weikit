@extends('weikit::layouts.quasar')

@section('use_quasar', true)

@section('content')
    <div>123</div>
    <component :is="componentName" v-bind="componentOptions" />
@endsection

@push('script')
    <script type="text/javascript">
        const { defineComponent } = Weikit;

        defineComponent({
            setup() {
                const { useComponent } = Uses;

                const { componentName, ...componentOptions} = useComponent({!! $schema->toJson() !!});
                console.log(componentName, componentOptions)

                return {
                    componentName,
                    componentOptions,
                }
            }
        });
    </script>
@endpush
