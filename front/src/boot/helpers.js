import { Loading, Notify } from 'quasar';
// COMPONENTES DE QUASAR GLOBALES SIN NECESIDAD DE IMPORTARLOS EN CADA COMPONENTE .vue
export default ({ app }) => {
  app.config.globalProperties.$loading = (message = 'Cargando...') => {
    Loading.show({
      spinner: false,
      message: `<img style="width: 50%" alt="Logo Cima" src="https://solicitudes.cimalogistic.com/images/cima.png"><br/>${message}`,
      html: true,
      messageColor: 'white'
    });
  };
  // EN EL NOTIFY SE DESESTRUCTURA LAS OPCIONES QUE RECIBE COMO PARÁMETRO, ESTAS OPCIONES VIENEN DEL BACKEND
  app.config.globalProperties.$notify = (options, actions = null) => {
    Notify.create({
      ...options,
      actions
    });
  };
};