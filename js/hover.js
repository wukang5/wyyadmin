function Hover(el) {
	el.focus(function() {
			el.css("outline", "2px solid red")
		}).blur(function() {
			el.css("outline", "1px solid lightgray")
		});
		el.mouseover(function() {
			el.css("border", "1px solid gray")
		}).mouseout(function() {
			el.css("border", "1px solid lightgray")
		})
}