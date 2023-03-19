import { createI18n } from 'vue-i18n'

export default createI18n({
    locale: 'en',
    messages: {
        en: {
            email: 'Email address',
            login: 'Login',
            password: 'Password',
            signin: 'Sign in',
        },
        fr: {
            email: 'Adresse email',
            login: 'Connexion',
            password: 'Mot de passe',
            signin: 'Se connecter',
        }
    }
})
