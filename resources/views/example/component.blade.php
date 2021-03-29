@extends('weikit::layouts.quasar')

@section('content')
    <q-layout>
        <q-page-container>
            <q-page padding>
                <component :is="componentName" v-bind="componentOptions" ></component>
                <remote></remote>
            </q-page>
        </q-page-container>
    </q-layout>
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

                const { componentName, ...componentOptions} = useComponent({!! $components->toJson() !!});

                return {
                    componentName,
                    componentOptions,
                }
            },
        });
    </script>
@endpush
