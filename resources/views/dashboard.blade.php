@extends('weikit::layouts.quasar')

@section('content')
    <w-main>
        <template v-slot:toolbar-right>
            <q-btn-dropdown v-if="user" stretch flat :label="user.username">
                <q-list>
                    <q-item clickable v-ripple>
                        <q-item-section lay-event="edit_password">修改密码</q-item-section>
                    </q-item>
                    <q-item clickable v-ripple>
                        <q-item-section lay-event="logout">退出</q-item-section>
                    </q-item>
                </q-list>
            </q-btn-dropdown>
        </template>
    </w-main>
@endsection

@push('script')
    <script type="module" type="text/javascript">
        const { defineComponent } = Weikit;

        export default defineComponent({
            setup() {
                const { onBeforeMount } = Vue;
                const { useUser } = Uses;

                const { user, loadUser } = useUser();

                onBeforeMount(async () => {
                    loadUser();
                });

                return {
                    user
                };
            }
        });

    </script>
@endpush
