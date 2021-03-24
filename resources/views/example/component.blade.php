@extends('weikit::layouts.quasar')

@section('content')
    111
    <test ></test>

    111

    <div>
        <component :is="componentName" v-bind="componentOptions" />
    </div>

@endsection

@push('script')
    <script type="module" type="text/javascript">
        const { defineComponent, resolveAsyncComponent } = Weikit;

        export default defineComponent({
            components: {
                'test': resolveAsyncComponent('http://weikit.com/admin/example/test.vue')
            },
            setup() {
                const { useComponent } = Uses;

                const { componentName, ...componentOptions} = useComponent({!! $schema->toJson() !!});
                console.log(componentName, componentOptions)

                return {
                    componentName,
                    componentOptions,
                }
            },
        });
    </script>
@endpush
