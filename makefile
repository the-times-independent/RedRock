.DEFAULT_GOAL := clean-then-compile

clean-then-compile: clean style

style:
	sass ./scss/all.scss ./style.css

clean:
	rm ./style.css ./style.css.map

continuous:
	sass --watch ./scss/all.scss:./style.css
