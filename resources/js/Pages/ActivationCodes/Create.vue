<template>
    <app-layout title="Aktivasyon Kodu Oluştur">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Aktivasyon Kodu Oluştur
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <jet-form-section @submitted="createCode">

                    <template #title>
                        Aktivasyon Kodu Oluştur
                    </template>

                    <template #description>
                        Güvende kalmak için hesabınızın uzun, rastgele bir şifre kullandığından emin olun.
                    </template>

                    <template #form>
                        <div class="col-span-12 sm:col-span-12">
                            <jet-label for="email" value="Email" />
                            <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" ref="email" autocomplete="email" />
                            <jet-input-error :message="form.errors.email" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                           Aktivasyon Kodu Oluşturuldu.
                        </jet-action-message>

                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                           Oluştur
                        </jet-button>
                    </template>
                </jet-form-section>

            </div>
        </div>
    </app-layout>
</template>

<script>

import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue'
import JetSectionBorder from '@/Jetstream/SectionBorder.vue'
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue'
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue'
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'

export default defineComponent({
    props: ['sessions'],

    components: {
        AppLayout,
        DeleteUserForm,
        JetSectionBorder,
        LogoutOtherBrowserSessionsForm,
        TwoFactorAuthenticationForm,
        UpdatePasswordForm,
        UpdateProfileInformationForm,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
    },

    data() {
        return {
            form: this.$inertia.form({
                code: '',
                email: '',
            }),
        }
    },

    methods: {
        createCode() {
            this.form.post(route('activation_codes.store'), {
                errorBag: 'createCode',
                preserveScroll: true,
                onSuccess: () => this.$inertia.replace(route('activation_codes.index'), {  }),
                onError: () => {
                    if (this.form.errors.email) {
                        this.form.reset('email')
                        this.$refs.password.focus()
                    }
                }
            })
        },
    },
})
</script>
