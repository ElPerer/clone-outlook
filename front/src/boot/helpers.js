import { Loading, Notify } from 'quasar';

export default ({ app }) => {
  app.config.globalProperties.$loading = (message = 'Cargando...') => {
    Loading.show({
      spinner: false,
      message: `<img style="width: 50%" alt="Logo Cima" src="https://solicitudes.cimalogistic.com/images/cima.png"><br/>${message}`,
      html: true,
      messageColor: 'white'
    });
  };
  app.config.globalProperties.$notify = (options, actions = null) => {
    Notify.create({
      ...options,
      actions
    });
  };
  app.config.globalProperties.$messageValidate = {
    message: 'Revisa las validaciones',
    color: 'warning',
    position: 'top-right',
    icon: 'warning',
    timeout: 5000
  };
};