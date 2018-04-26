import {$,jQuery} from "jquery"
import * as Frames from "./frames"

window.$ = $
window.jQuery = jQuery

Frames.forEach(function(frame){
  let f = frame()
  f.run()
})


// Additional code goes here.
