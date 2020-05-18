import DefaultField from './components/DefaultField'
import PanelItem from './components/PanelItem'

Nova.booting((Vue, router, store) => {
  Vue.component('default-field', DefaultField)
  Vue.component('panel-item', PanelItem)
})
