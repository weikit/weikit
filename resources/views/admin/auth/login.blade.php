@extends('weikit::layouts.main')

@section('body_class', 'login')
@section('use_quasar', true)

@section('content')
    <q-layout>
        <q-page-container>
            <q-page class="flex flex-center">
                <q-card :style="$q.screen.lt.sm?{'width': '90%'}:{'width':'30%'}">
                    <q-card-section>
                        <div class="text-center q-pt-lg">
                            <div class="col text-h6 ellipsis">
                                @{{ $t('admin.auth.login.title') }}
                            </div>
                        </div>
                    </q-card-section>
                    <q-card-section>
                        <q-form class="q-gutter-md">
                            <div>
                                <q-input filled v-model="form.username" label="Username" :dense="true" lazy-rules />
                            </div>
                            <div>
                                <q-input filled v-model="form.password" label="Password" lazy-rules :dense="true"
                                    type="password" />
                            </div>
                            <div>
                                <q-input filled v-model="form.captcha_code" label="Captcha" :dense="true" maxlength="2">
                                    <template v-slot:after>
                                        <img width="133" @click.stop="updateCaptchaUrl" :src="captchaUrl">
                                    </template>
                                </q-input>
                            </div>
                            <div>
                                <q-toggle v-model="form.remember" :label="$t('admin.auth.login.remember')" />
                            </div>
                            <div>
                                <q-btn class="full-width" label="Login" type="button" color="primary" />
                            </div>
                        </q-form>
                    </q-card-section>
                </q-card>
            </q-page>
        </q-page-container>
    </q-layout>
@endsection

@push('before_script')
    <script>
        G.appOptions = {
            setup() {
                const {
                    reactive,
                    toRefs,
                    ref,
                } = Vue;
                const {
                    useQuasar
                } = Quasar;
                const {
                    useCaptcha
                } = Uses;

                const {
                    captchaUrl,
                    updateCaptchaUrl
                } = useCaptcha({
                    url: "{{ captcha_src('math') }}"
                });

                const $q = useQuasar();

                const state = reactive({
                    form: {
                        username: '',
                        password: '',
                        captcha_code: '',
                        remember: false,
                    }
                });

                return {
                    $q,
                    ...toRefs(state),
                    captchaUrl,
                    updateCaptchaUrl
                }
            }
        }

    </script>
@endpush
