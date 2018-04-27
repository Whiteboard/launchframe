import {$,jQuery} from "jquery"
import * as Frames from "./frames"

window.$ = $
window.jQuery = jQuery

Object.keys(Frames).forEach(function(frame){
  let fclass = Frames[frame]
  let f = new fclass()
  f.test() && f.run()
})


// Additional code goes here.
