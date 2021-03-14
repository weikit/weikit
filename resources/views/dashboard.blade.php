@extends('weikit::layouts.main')

@section('use_quasar', true)

@section('content')
    <layout-main>
        <template v-slot:toolbar-right>
            <q-btn-dropdown stretch flat>
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


