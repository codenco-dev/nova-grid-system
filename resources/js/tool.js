// import DefaultField from './components/DefaultField'
// import PanelItem from './components/PanelItem'
// import DetailHeadingField from './components/Detail/HeadingField'
// import FormHeadingField from './components/Form/HeadingField'

const Vue = require("@vue/compat/dist/vue.cjs.prod");

// Nova.booting((app, store) => {
//   app.component('default-field', DefaultField)
//   app.component('panel-item', PanelItem)
//   app.component('detail-heading-field', DetailHeadingField)
//   app.component('form-heading-field', FormHeadingField)
// })



// Nova.booting((Vue, router, store) => {
//   Vue.component('default-field', DefaultField)
//   Vue.component('panel-item', PanelItem)
//   Vue.component('detail-heading-field', DetailHeadingField)
//   Vue.component('form-heading-field', FormHeadingField)
// })

Nova.booting((Vue) => {
  Vue.component("DefaultField", require("./components/DefaultField").default);
  Vue.component("PanelItem", require("./components/PanelItem").default);
  Vue.component("DetailHeadingField", require("./components/Detail/HeadingField").default);
  Vue.component("FormHeadingField", require("./components/Form/HeadingField").default);
  Vue.component("FieldWrapper", require("./components/FieldWrapper").default);
});

