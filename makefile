.DEFAULT_GOAL := clean-then-compile
in-file = ./scss/all.scss
out-file = ./style.css

clean-then-compile: clean style
continuous: clean continuous-core

style:
	sass ${in-file} ${out-file}

clean:
	-rm ${out-file}*

continuous:
	sass --watch ${in-file}:${out-file}
