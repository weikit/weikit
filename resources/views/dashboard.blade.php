@extends('weikit::layouts.main')

@section('use_quasar', true)

@section('content')
    <layout-main>
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
    </layout-main>
@endsection

@push('before_script')
<script type="text/javascript">
    G.appOptions = {
        setup() {
            const { onBeforeMount } = Vue;
            const { useUser } = Uses;

            const { user, loadUser } = useUser();

            onBeforeMount(async () => {
                loadUser();
            });

            return { user };
        }
    };
</script>
@endpush
