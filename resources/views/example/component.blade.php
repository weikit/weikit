@extends('weikit::layouts.quasar')

@section('content')
    <remote></remote>

    <div>
        <component :is="componentName" v-bind="componentOptions" />
    </div>

@endsection

@push('script')
    <script type="module" type="text/javascript">
        const { defineComponent, resolveAsyncComponent } = Weikit;

        export default defineComponent({
            components: {
                'remote': resolveAsyncComponent('{{route('admin.example.remote')}}')
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
