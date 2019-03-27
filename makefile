.DEFAULT_GOAL := clean-then-make-style

clean-then-make-style: clean-style style

style:
	sass ./scss/all.scss ./style.css

clean-style:
	rm ./style.css ./style.css.map
