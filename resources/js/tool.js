import DefaultField from './components/DefaultField'
import PanelItem from './components/PanelItem'
import DetailHeadingField from './components/Detail/HeadingField'
import FormHeadingField from './components/Form/HeadingField'


Nova.booting((Vue, router, store) => {
  Vue.component('default-field', DefaultField)
  Vue.component('panel-item', PanelItem)
  Vue.component('detail-heading-field', DetailHeadingField)
  Vue.component('form-heading-field', FormHeadingField)
})
