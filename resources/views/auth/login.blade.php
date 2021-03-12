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
                                @{{ t('auth.login.title') }}
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
                            <div v-if="captchaShow">
                                <q-input filled v-model="form.captcha_code" label="Captcha" :dense="true" maxlength="2">
                                    <template v-slot:after>
                                        <img width="133" @click.stop="updateCaptchaUrl" :src="captchaUrl">
                                    </template>
                                </q-input>
                            </div>
                            <div>
                                <q-toggle v-model="form.remember" :label="t('auth.login.remember')" />
                            </div>
                            <div>
                                <q-btn class="full-width" label="Login" type="button" color="primary"
                                    @click.stop="handleLogin" />
                            </div>
                        </q-form>
                    </q-card-section>
                </q-card>
            </q-page>
        </q-page-container>
    </q-layout>
@endsection

@push('before_script')
    <script type="text/javascript">
        G.appOptions = {
            setup() {
                const {
                    reactive,
                    ref,
                    watch,
                } = Vue;
                const {
                    useCaptcha,
                    useLogin,
                } = Uses;

                const {
                    useQuasar
                } = Quasar;
                const $q = useQuasar();

                const {
                    useI18n
                } = VueI18n;
                const {
                    t
                } = useI18n();

                const form = reactive({
                    username: '',
                    password: '',
                    captcha_code: '',
                    remember: false,
                });

                const {
                    captchaUrl,
                    updateCaptchaUrl
                } = useCaptcha({
                    url: "{{ captcha_src('math') }}"
                });
                const captchaShow = ref(0);
                watch(() => form.password, () => captchaShow.value = 1);


                const {
                    login
                } = useLogin();
                const handleLogin = async () => {
                    const user = await login(form);

                    $q.notify({
                        message: t('auth.login.successed'),
                        position: 'top'
                    });
                };


                return {
                    t,
                    $q,
                    form,
                    captchaShow,
                    handleLogin,
                    captchaUrl,
                    updateCaptchaUrl
                }
            }
        }

    </script>
@endpush
