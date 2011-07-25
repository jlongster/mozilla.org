TOOLS=../tools
YUICOMPRESSOR=java -jar $(TOOLS)/yuicompressor.jar

SOURCES=$(wildcard *.js gs/*.js)
MINIFY_SOURCES=$(SOURCES:.js=.js.min)

all: $(MINIFY_SOURCES)

%.js.min: %.js Makefile
	$(YUICOMPRESSOR) --type js -o $@ $<

